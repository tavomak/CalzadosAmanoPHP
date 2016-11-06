function vv() {
    document.getElementById('ventanaRegistro').style.display = "block";
    document.getElementById('videoYoutube').style.display = "block";
}

function cerrar() {
    window.location.href = "index.php";
}

function ocultar() {
    document.getElementById('resultado').style.display = "none";
    document.getElementById('toma').style.display = "none";
}

$('#toma').css({
    left: ($(window).width() - $('#toma').outerWidth()) / 2
});
$(document).ready(function () {
    $(window).resize(function () {
        // aquí le pasamos la clase o id de nuestro div a centrar (en este caso "caja")
        $('#toma').css({
            left: ($(window).width() - $('#toma').outerWidth()) / 2
        });
    });
    // Ejecutamos la función
    $(window).resize();
});
