const Toast = Swal.mixin({ toast: true, position: "top-end", showConfirmButton: false, timer: 4000, timerProgressBar: true, didOpen: (toast) => { toast.onmouseenter = Swal.stopTimer; toast.onmouseleave = Swal.resumeTimer; } });

$(document).ready(function () {
    cargarFavoritos();    

        // Evento editar
    $(document).on('click', '.btn-editar', function () {
        const id = $(this).data('id');
        const iddri = $(this).data('iddri');
        editarCoctel(id,iddri);
    });

    // Evento eliminar
    $(document).on('click', '.btn-eliminar', function () {
        const id = $(this).data('id');

        Swal.fire({
            icon: "info",
            title: "¿Estás seguro de que deseas eliminar este cóctel favorito?",
            showCancelButton: true,
            confirmButtonText: "Confirmar",
            cancelButtonText: "Cancelar",
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/cocteles-favoritos/${id}`,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        
                        Toast.fire({
                            icon: "success",
                            title: response.message
                        });
                        setTimeout(() => {
                            location.reload();
                        }, 500);
                    },
                    error: function (xhr) {
                        console.error('Error al eliminar:', xhr.responseText);
                    }
                });
            }
          });
    });
    // Evento para editar
    $('#formEditarCoctel').on('submit', function (e) {
        e.preventDefault();
    
        const id = $('#idLine').val();
        const nombre = $('#editarNombre').val();
        const instrucciones = $('#editarInstrucciones').val();                
        const ingredientes = $('#editarIngredientes').val().split(',').map(i => {
            const [nombre, medida] = i.trim().split('(');
            return {
                nombre: nombre.trim(),
                medida: medida ? medida.replace(')', '').trim() : ''
            };
        });

        $.ajax({
            url: `/cocteles-favoritos/${id}`,
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            contentType: 'application/json',
            data: JSON.stringify({
                nombre: nombre,
                instrucciones: instrucciones,
                ingredientes: ingredientes
            }),
            success: function (response) {
                Toast.fire({
                    icon: "success",
                    title: response.message
                });
                $('#editarCoctelModal').modal('hide');
                setTimeout(() => {
                    location.reload();
                }, 500);
            },
            error: function (xhr) {
                console.error('Error al editar:', xhr.responseText);
            }
        });
    });
    
});


function cargarFavoritos() {
    $.ajax({
        url: '/cocteles/favoritos',
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            console.log(data);
            
            let tbody = $('#coctelesFavoritosList tbody');
            tbody.empty();  // Limpiar la tabla antes de cargar los nuevos datos

            // Iterar sobre los cocteles favoritos y agregarlos a la tabla
            $.each(data, function (index, coctel) {
                console.log(coctel);
                
                let ingredientes = JSON.parse(coctel.ingredientes);
                let ingredientesHtml = '';
                $.each(ingredientes, function (i, ing) {
                    ingredientesHtml += `<li>${ing.nombre} (${ing.medida})</li>`;
                });

                let row = `
                    <tr>
                        <td>${coctel.idDrink}</td>
                        <td>${coctel.nombre}</td>
                        <td>${coctel.instrucciones}</td>
                        <td><ul>${ingredientesHtml}</ul></td>
                        <td>
                            <div class="d-flex gap-2">
                                <button class="btn btn-warning btn-sm btn-editar" data-id="${coctel.id}" data-iddri="${coctel.idDrink}" title="Editar">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button class="btn btn-danger btn-sm btn-eliminar" data-id="${coctel.id}" title="Eliminar">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
                tbody.append(row);
            });
        },
        error: function (xhr, status, error) {
            console.log('Error al cargar los favoritos:', error);
        }
    });
}

function editarCoctel(id,iddri) {
    // Buscar la fila con ese ID
    const fila = $(`#coctelesFavoritosList tbody tr`).filter(function () {
        return $(this).find('td:first').text() == iddri;
    });

    const nombre = fila.find('td:nth-child(2)').text();
    const instrucciones = fila.find('td:nth-child(3)').text();
    const ingredientesLi = fila.find('td:nth-child(4) li');

    let ingredientesTexto = '';
    ingredientesLi.each(function () {
        let texto = $(this).text(); // ej: "Vodka (1 oz)"
        let nombreIng = texto.substring(0, texto.lastIndexOf('(')).trim();
        let medida = texto.substring(texto.lastIndexOf('(') + 1, texto.lastIndexOf(')')).trim();
        ingredientesTexto += `${nombreIng}, ${medida}\n`;
    });

    // Rellenar el formulario
    $('#idLine').val(id);
    $('#editarId').val(iddri);
    $('#editarNombre').val(nombre);
    $('#editarInstrucciones').val(instrucciones.trim());
    $('#editarIngredientes').val(ingredientesTexto.trim());

    // Mostrar el modal
    const modal = new bootstrap.Modal(document.getElementById('modalEditarCoctel'));
    modal.show();
}
