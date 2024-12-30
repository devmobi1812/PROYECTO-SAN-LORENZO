window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki
    const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
        let table = new simpleDatatables.DataTable(datatablesSimple);

        table.on("datatable.init", loadButtons);
        
        table.on("datatable.page", loadButtons);
            
        table.on("datatable.search",loadButtons);
    }

    function loadButtons(){
        document.querySelectorAll('#datatablesSimple .btn-danger').forEach( function(button){
            console.log("añadido evento para el botón con el href: "+ button.href)
            button.addEventListener('click', function(event) {
                // Previene la acción predeterminada (navegar al enlace)
                event.preventDefault();
    
                // Obtiene la URL del enlace
                let url = this.getAttribute('href');
    
                // Llama a la función para mostrar la alerta de confirmación
                confirmarEliminacion(event, url);
            });
        });
    }

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
