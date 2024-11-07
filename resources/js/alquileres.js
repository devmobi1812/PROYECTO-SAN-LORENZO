document.addEventListener('DOMContentLoaded', function () {
    // Obtener el checkbox y el contenedor del select
    const quinchoCheckbox = document.getElementById('quincho-checkbox');
    const quinchoSelectContainer = document.getElementById('quincho-select-container');

    // Función que muestra/oculta el contenedor del select
    function toggleQuinchoSelect() {
        if (quinchoCheckbox.checked) {
            quinchoSelectContainer.style.display = 'block'; // Muestra el div
        } else {
            quinchoSelectContainer.style.display = 'none'; // Oculta el div
        }
    }

    // Llamamos a la función al cargar la página para ver si el checkbox debe estar marcado
    toggleQuinchoSelect();

    // Añadir el evento de cambio al checkbox
    quinchoCheckbox.addEventListener('change', toggleQuinchoSelect);
});