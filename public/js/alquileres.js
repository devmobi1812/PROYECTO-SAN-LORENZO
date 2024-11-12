document.addEventListener('DOMContentLoaded', function () {
    const quinchoCheckbox = document.getElementById('quincho-checkbox');
    const quinchoSelectContainer = document.getElementById('quincho-select-container');
    
    const piletaCheckbox = document.getElementById('pileta-checkbox');
    const piletaSelectContainer = document.getElementById('pileta-select-container');
    
    const vajillaCheckbox = document.getElementById('vajilla-checkbox');
    const vajillaInputContainer = document.getElementById('vajilla-input-container');

    const señaCheckbox = document.getElementById('seña-checkbox');
    const señaSelectContainer = document.getElementById('seña-select-container');

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
    // Función para mostrar/ocultar el contenedor de la seña
    function toggleSeñaSelect() {
        if (señaCheckbox.checked) {
            señaSelectContainer.style.visibility = 'visible';
            señaSelectContainer.style.height = 'auto'; // Asegura que el contenedor tenga altura
        } else {
            señaSelectContainer.style.visibility = 'hidden';
            señaSelectContainer.style.height = '0';
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
    toggleSeñaSelect();
    toggleVajillaInput();

    // Añadir eventos a los checkboxes
    quinchoCheckbox.addEventListener('change', toggleQuinchoSelect);
    señaCheckbox.addEventListener('change', toggleSeñaSelect);
    piletaCheckbox.addEventListener('change', togglePiletaSelect);
    vajillaCheckbox.addEventListener('change', toggleVajillaInput);
});
