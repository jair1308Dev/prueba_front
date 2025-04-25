let drinks = [];
const Toast = Swal.mixin({ toast: true, position: "top-end", showConfirmButton: false, timer: 4000, timerProgressBar: true, didOpen: (toast) => { toast.onmouseenter = Swal.stopTimer; toast.onmouseleave = Swal.resumeTimer; } });

$(document).ready(function () {

    $.ajax({
        type: "get",
        url: "https://www.thecocktaildb.com/api/json/v1/1/filter.php?c=Cocktail",
        dataType: "json",
        success: function (response) {
            drinks = response.drinks;
            renderTabla(drinks);
        },
        error: function (error) {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Hubo un problema al obtener los cócteles. Intenta nuevamente."
            });
            console.error(error);
        }
    });

    $(document).on('click', '.btn-detalle', function () {
        const id = $(this).data('id');

        // Mostrar la modal
        const modal = new bootstrap.Modal(document.getElementById('detalleModal'));
        modal.show();

        // Mostrar cargando mientras llega la respuesta
        $('#detalleModalBody').html('Cargando detalle...');

        // Hacer consulta AJAX
        $.ajax({
            url: `https://www.thecocktaildb.com/api/json/v1/1/lookup.php?i=${id}`,
            method: 'GET',
            success: function (data) {
                if (data.drinks && data.drinks.length > 0) {
                    const d = data.drinks[0];
                    const htmlDetalle = `
                <h5>${d.strDrink}</h5>
                <p><strong>Categoría:</strong> ${d.strCategory}</p>
                <p><strong>Instrucciones:</strong> ${d.strInstructions}</p>
                <img src="${d.strDrinkThumb}" class="img-fluid rounded" alt="${d.strDrink}">
              `;
                    $('#detalleModalBody').html(htmlDetalle);
                } else {
                    $('#detalleModalBody').html('No se encontró información del cóctel.');
                }
            },
            error: function () {
                $('#detalleModalBody').html('Error al cargar el detalle.');
            }
        });
    });

    $(document).on('click', '.btn-agregar-favorito', function () {
        const id = $(this).data('id');
      
        $.ajax({
          url: `/coctel/guardar/${id}`,
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // importante para Laravel
          },
          success: function (response) {
            let tipoAlerta = "success";
            if (response.estado == 1) {
                tipoAlerta = "error";
            }
            Toast.fire({
                icon: tipoAlerta,
                title: response.message
            });
          },
          error: function (xhr) {
            Toast.fire({
                icon: "error",
                title: "Error al guardar el cóctel."
            });
          }
        });
      });
});

// Función para renderizar la tabla
function renderTabla(lista) {
    $('#coctelesList tbody').empty();
    lista.forEach(function (drink) {
        const row = `
        <tr>
          <td>${drink.idDrink}</td>
          <td>${drink.strDrink}</td>
          <td>
            <button data-bs-toggle="tooltip" data-bs-placement="top" data-id="${drink.idDrink}"  title="Ver detalle de este cóctel" class="btn btn-primary btn-sm btn-detalle"> <i class="bi bi-eye"></i></button>
            <button data-bs-toggle="tooltip" data-bs-placement="top" data-id="${drink.idDrink}" title="Agregar a favoritos este cóctel" class="btn btn-warning btn-sm btn-agregar-favorito"><i class="bi bi-heart"></i></button>
          </td>
        </tr>
      `;
        $('#coctelesList tbody').append(row);
    });

    // Activar tooltips después de renderizar
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltipTriggerList.forEach(el => new bootstrap.Tooltip(el));
}


// Evento para el buscador
$('#buscador').on('input', function () {
    const texto = $(this).val().toLowerCase();
    const filtrados = drinks.filter(drink =>
        drink.idDrink.toLowerCase().includes(texto) ||
        drink.strDrink.toLowerCase().includes(texto)
    );
    renderTabla(filtrados);
});
