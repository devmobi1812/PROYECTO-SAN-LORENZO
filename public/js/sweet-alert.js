document.addEventListener('DOMContentLoaded', function () {
    // Selecciona todos los botones con la clase 'btn-danger'
    document.querySelectorAll('.btn-danger').forEach(function(button) {
        button.addEventListener('click', function(event) {
            // Previene la acción predeterminada (navegar al enlace)
            event.preventDefault();

            // Obtiene la URL del enlace
            let url = this.getAttribute('href');

            // Llama a la función para mostrar la alerta de confirmación
            confirmarEliminacion(event, url);
        });
    });

    // Función que muestra el pop-up de SweetAlert2
    function confirmarEliminacion(event, url) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás revertir esto",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0c9a9c',
            cancelButtonColor: '#e74c3c',
            cancelButtonText: "Cancelar",
            confirmButtonText: 'Eliminar'
        }).then((result) => {
            // Si el usuario confirma, se redirige a la URL
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
});
