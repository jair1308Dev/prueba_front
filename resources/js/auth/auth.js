const Toast = Swal.mixin({ toast: true, position: "top-end", showConfirmButton: false, timer: 4000, timerProgressBar: true, didOpen: (toast) => { toast.onmouseenter = Swal.stopTimer; toast.onmouseleave = Swal.resumeTimer; } });
var tableLocal;
var tableCloud;

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