let drinks = [];

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
            <button data-bs-toggle="tooltip" data-bs-placement="top" title="Ver detalle de este cóctel" class="btn btn-primary btn-sm"> <i class="bi bi-eye"></i></button>
            <button data-bs-toggle="tooltip" data-bs-placement="top" title="Agregar a favoritos este cóctel" class="btn btn-warning btn-sm"><i class="bi bi-heart"></i></button>
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
  