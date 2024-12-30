document.addEventListener('DOMContentLoaded', function () {
    //  FUNCION QUE EJECUTA LA ELIMINACION
    document.querySelectorAll('.btn-danger').forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            let url = this.getAttribute('href');
            confirmarEliminacion(event, url);
        });
    });
    //  FUNCION QUE EJECUTA EL POP-UP DE ELIMINACION
    function confirmarEliminacion(event, url) {
        event.preventDefault();
        Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás revertir esto",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0c9a9c',
            cancelButtonColor: '#e74c3c',
            cancelButtonText: "Cancelar",
            confirmButtonText: 'Eliminar',
            customClass: {
                confirmButton: 'btnConfirmar',
                cancelButton: 'btnCancelar'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
});