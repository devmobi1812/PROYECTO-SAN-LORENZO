document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll(".checkbox-servicio").forEach( checkbox => {
        checkbox.addEventListener("change", toggleCheckbox)
    })

    function toggleCheckbox(e) {
        const checkbox = e instanceof Event ? e.currentTarget : e;
    
        if (checkbox.checked) {
            checkbox.nextElementSibling.style.visibility = 'visible';
            checkbox.nextElementSibling.style.height = 'auto'; 
        } else {
            checkbox.nextElementSibling.style.visibility = 'hidden';
            checkbox.nextElementSibling.style.height = '0';
        }
    }
    
    document.querySelectorAll(".checkbox-servicio").forEach(checkbox => {
        toggleCheckbox(checkbox);
    });
    
});
