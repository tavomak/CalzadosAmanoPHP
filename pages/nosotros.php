<?php session_start(); ?><!DOCTYPE html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Calzados A'mano</title>
	<meta name="description" content="Calzados A'mano" />
	<meta name="keywords" content="Calzados A'mano" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css'>
	<link rel="shortcut icon" href="../favicon.ico">
	<link rel="stylesheet" type="text/css" href="../css/basic.css" />
    <link rel="stylesheet" type="text/css" href="../css/menu.css">
<script>
function vv() {
	document.getElementById('ventanaRegistro').style.display="block";
	document.getElementById('videoYoutube').style.display="block";
}
function cerrar(){
 window.location.href="nosotros.php";
}
</script>
</head>
<body>
	<div id="wrapper">
    	<div id="intwrapper">
	       	<header>
				 <div id="logo"><a href="../index.php"><img src="../images/logo.png" width="207" height="66"></a></div>
            	<?php include "redes.php"; ?>
                <div class="separador"></div>
                <nav id="menu">
                <?php $pages=$_SERVER['PHP_SELF'];
				include "menu.php"; ?>

               </nav>
            </header>
<div id="ventanaRegistro" name="ventanaRegistro" class="ventanaRegistro" onClick="cerrar()"></div>
<div id="videoYoutube" name="videoYoutube" class="videoYoutube centrado-porcentual"><iframe width="560" height="315" src="https://www.youtube.com/embed/qTYa9rySwK0?rel=0&showinfo=0&modestbranding=1" frameborder="0" allowfullscreen style="margin-left:0"></iframe></div>
		<div class="container">
        	<div id="izquierda" style="margin-left:5%">
       	  <p class="textohome">Calzados A'mano es una empresa ubicada en la ciudad de Caracas con más de 15 años en el mercado de calzados en Venezuela.<br><br>
        	    Nuestros zapatos son de alta calidad y manufacturados por artesanos con pieles de primera. <br><br>
        	    Nos caracterizamos por confeccionar modelos clásicos tipo bailarina, siempre innovando en colores y accesorios de acuerdo a la moda y temporada del año.<br><br>
        	    Nos especializamos en zapatos para niños para ocasiones especiales, tales como: bautizos, cortejos, primera comunión, piñatas, bar mitzvah, entre otros.<br><br>
        	    También contamos con nuestra línea casual de zapatillas para mujeres que buscan lucir modernas y a la vez disfrutar de un cómodo calzado.<br><br>
       	    Confeccionamos modelos escolares para varones y niñas adaptándonos a las reglas de cada colegio.</p>
            </div>
			<div id="derecha" style="width:40%;margin-right:5%; padding-top:40px;">
            	<img src="../images/home/nuestras.jpg" width="60%" style="position:relative;  z-index:2">
                <a href="javascript: vv();" class="btn_ver" ></a>
                </div>
		</div> <!--fin container -->

        </div>  <!-- fin intwrapper -->
<?php include "footer.php"; ?>
	</div>       <!-- fin wrapper -->
</body>
</html>
