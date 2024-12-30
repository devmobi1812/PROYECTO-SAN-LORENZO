document.addEventListener('DOMContentLoaded', function () {
    //  FUNCION QUE EJECUTA LA IMPRESION
    document.querySelectorAll('.imprimir').forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            imprimirPagina();
        });
    });
    //  FUNCION QUE EJECUTA EL POP-UP DE IMPRESION
    function imprimirPagina() { 
        window.print();
    }
});
