$(document).ready(function () {
    
    $(document).on('click', '#closeSession', function (e) {
        Swal.fire({
            icon: "info",
            title: "¿Estas seguro de cerrar sesión?",
            showCancelButton: true,
            confirmButtonText: "Confirmar",
            cancelButtonText: "Cancelar",
          }).then((result) => {
            if (result.isConfirmed) {
                $('#logout-form').submit();
            }
          });
    });
});