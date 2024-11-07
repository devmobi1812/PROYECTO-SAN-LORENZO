document.addEventListener('DOMContentLoaded', function () {
    const quinchoCheckbox = document.getElementById('quincho-checkbox');
    const quinchoSelectContainer = document.getElementById('quincho-select-container');
    
    const piletaCheckbox = document.getElementById('pileta-checkbox');
    const piletaSelectContainer = document.getElementById('pileta-select-container');
    
    const vajillaCheckbox = document.getElementById('vajilla-checkbox');
    const vajillaInputContainer = document.getElementById('vajilla-input-container');

    // Función para mostrar/ocultar el contenedor del quincho
    function toggleQuinchoSelect() {
        if (quinchoCheckbox.checked) {
            quinchoSelectContainer.style.visibility = 'visible';
            quinchoSelectContainer.style.height = 'auto'; // Asegura que el contenedor tenga altura
        } else {
            quinchoSelectContainer.style.visibility = 'hidden';
            quinchoSelectContainer.style.height = '0';
        }
    }

    // Función para mostrar/ocultar el contenedor de la pileta
    function togglePiletaSelect() {
        if (piletaCheckbox.checked) {
            piletaSelectContainer.style.visibility = 'visible';
            piletaSelectContainer.style.height = 'auto'; // Asegura que el contenedor tenga altura
        } else {
            piletaSelectContainer.style.visibility = 'hidden';
            piletaSelectContainer.style.height = '0';
        }
    }

    // Función para mostrar/ocultar el input de vajilla
    function toggleVajillaInput() {
        if (vajillaCheckbox.checked) {
            vajillaInputContainer.style.visibility = 'visible';
            vajillaInputContainer.style.height = 'auto'; // Asegura que el contenedor tenga altura
        } else {
            vajillaInputContainer.style.visibility = 'hidden';
            vajillaInputContainer.style.height = '0';
        }
    }

    // Inicializamos la visibilidad de los elementos según su estado
    toggleQuinchoSelect();
    togglePiletaSelect();
    toggleVajillaInput();

    // Añadir eventos a los checkboxes
    quinchoCheckbox.addEventListener('change', toggleQuinchoSelect);
    piletaCheckbox.addEventListener('change', togglePiletaSelect);
    vajillaCheckbox.addEventListener('change', toggleVajillaInput);
});
