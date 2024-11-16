document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll(".checkbox-servicio").forEach( checkbox => {
        checkbox.addEventListener("change", e => {
        checkboxEvt = e.currentTarget;
        if(checkboxEvt.checked){
            checkboxEvt.nextElementSibling.style.visibility = 'visible';
            checkboxEvt.nextElementSibling.style.height = 'auto'; // Asegura que el contenedor tenga altura
        } else {
            checkboxEvt.nextElementSibling.style.visibility = 'hidden';
            checkboxEvt.nextElementSibling.style.height = '0';
        }
        })
    })

});
