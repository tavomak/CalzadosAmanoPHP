<?php session_start(); ?>
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Calzados A'mano</title>
	<meta name="description" content="Calzados A'mano es una empresa ubicada en la ciudad de Caracas con más de 15 años en el mercado de calzados en Venezuela." />
	<meta name="keywords" content="Calzados a'mano" />
	<link rel="shortcut icon" href="favicon.ico">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/basic.css" />
  	<link rel="stylesheet" type="text/css" href="css/menu.css">
  	<style type="text/css">
		#resultado { position: fixed; left:0; top:0; z-index:300;width:100%; margin-top:0% ; margin-left:0%; height:100%; background-color:#000;filter: alpha(opacity=70); opacity: .7; font-size:12px; padding-top:100px; display:none;}
	</style>
  <script type="text/javascript" src="js/jquery.js"></script>
<script>
function vv() {
	document.getElementById('ventanaRegistro').style.display="block";
	document.getElementById('videoYoutube').style.display="block";
}
function cerrar(){
 window.location.href="index.php";
}

function ocultar(){
document.getElementById('resultado').style.display="none";
document.getElementById('toma').style.display="none";
}


</script>
</head>


<body>
	<div id="wrapper">

   	<div id="intwrapper"> <a href="javascript: ocultar();"><div id="resultado" align="center" ></div></a>

      	<header>
        	<div id="logo"><a href="index.php"><img src="images/logo.png" width="207" height="66"></a></div>
           	<nav id="redes">
                <a href="pages/registrarse.php" class="boton btn_registrarse"></a>
                <a href="pages/iniciar.php" class="boton btn_sesion"></a>
               <a href="https://www.facebook.com/pages/Calzados-A-Mano/496423987087853" class="boton btn_facebook" target="_blank"></a>
               <a href="https://twitter.com/amanocalzados" class="boton btn_twitter" target="_blank"></a>
               <a href="http://instagram.com/calzadosamano" class="boton btn_instagram" target="_blank"></a>
               <a href="pages/mispedidos.php" class="boton btn_carrito" ></a> <span style="color: #009999; margin-left:10px; font-weight:bold;"><?php echo $_SESSION['articulos'];?></span>
            </nav>

               <div class="separador" style="margin-top:10px; margin-bottom:10px;"></div>
                <nav id="menu">
<ul class="menu" >
<?php if ($pages=="/pages/nosotros.php")  { $class='btn_nuestrashover'; } else { $class='btn_nuestras'; } ?>
	<li><a href="pages/nosotros.php" class="opcion <?php echo $class;?>"></a></li>
    <?php if (($pages=="/pages/cintillosb.php")||($pages=="/pages/bebes.php")||($pages=="/pages/lazosb.php")||($pages=="/pages/pijamasb.php")) { $class='btn_bebeshover'; } else { $class='btn_bebes'; } ?>
    <li><a href="#" class="opcion <?php echo $class;?>"></a>
        <ul class="menu2">
            <li><a href="pages/bebes.php" class="btn_menu btn_zapatos"></a></li>
            <li><a href="pages/lazosb.php" class="btn_menu btn_lazos"></a></li>
            <li><a href="pages/cintillosb.php" class="btn_menu btn_cintillos"></a></li>
            <li><a href="pages/pijamasb.php" class="btn_menu btn_pijamas"></a></li>
        </ul>
    </li>

    <?php if (($pages=="/pages/cintillosg.php")||($pages=="/pages/girls.php")||($pages=="/pages/lazosg.php")||($pages=="/pages/pijamasg.php")) { $class='btn_girlshover'; } else { $class='btn_girls'; } ?>
   	<li><a href="#" class="opcion <?php echo $class;?>" ></a>
        <ul class="menu2">
            <li><a href="pages/girls.php" class="btn_menu btn_zapatos"></a></li>
            <li><a href="pages/lazosg.php" class="btn_menu btn_lazos"></a></li>
            <li><a href="pages/cintillosg.php" class="btn_menu btn_cintillos"></a></li>
            <li><a href="pages/pijamasg.php" class="btn_menu btn_pijamas"></a></li>
         </ul>
    </li>
    <?php if (($pages=="/pages/boys.php")||($pages=="/pages/pijamaso.php")) { $class='btn_boyshover'; } else { $class='btn_boys'; } ?>
    <li><a href="#" class="opcion <?php echo $class;?>" ></a>
         <ul class="menu2">
             <li><a href="pages/boys.php" class="btn_menu btn_zapatos"></a></li>
              <li><a href="pages/pijamaso.php" class="btn_menu btn_pijamas"></a></li>
         </ul>

    </li>
    <?php if ($pages=="/pages/colegial.php")  { $class='btn_colegialhover'; } else { $class='btn_colegial'; } ?>
    <li><a href="pages/colegial.php" class="opcion <?php echo $class;?>"></a></li>

    <?php if ($pages=="/pages/mispedidos.php")  { $class='btn_pedidoshover'; } else { $class='btn_pedidos'; } ?>
    <li><a href="pages/mispedidos.php" class="opcion <?php echo $class;?>"></a></li>

    <?php if ($pages=="/pages/contacto.php")  { $class='btn_contactohover'; } else { $class='btn_contacto'; } ?>
    <li> <a href="pages/contacto.php" class="opcion <?php echo $class;?>"></a></li>
</ul>
           </nav>
           </header>

 <!--

<a href="javascript:alertSize();" > mostrar Height / Width </a>

<p id="resultado"></p>  -->
<div id="ventanaRegistro" name="ventanaRegistro" class="ventanaRegistro" onClick="cerrar()"></div>
<div id="videoYoutube" name="videoYoutube" class="videoYoutube centrado-porcentual"><iframe width="560" height="315" src="https://www.youtube.com/embed/qTYa9rySwK0?rel=0&showinfo=0&modestbranding=1" frameborder="0" allowfullscreen style="margin-left:0"></iframe></div>


  		<div class="container" style="background-image:url(images/home/fachada.jpg); background-repeat:no-repeat; background-position:center; min-width:1100px;">
         <div id="toma" style="position:absolute;  z-index:301;  margin-top:0px;  width:60%; margin-left:-5%;  min-width:600px; display:none; ">   <a href="javascript: ocultar();"> <img src="images/home/bannernavidad.png" width="100%" border="0"></a>    </div>
        <section id="derecha">  <a href="javascript: vv();" class="btn_ver" ></a><br>
           </section>

		</div> <!--fin container -->

        </div>  <!-- fin intwrapper -->


<?php include "pages/footer.php"; ?>
	</div>       <!-- fin wrapper -->
<script>
$('#toma').css({
left: ($(window).width() - $('#toma').outerWidth()) / 2
});

$(document).ready(function(){

     $(window).resize(function(){

          // aquí le pasamos la clase o id de nuestro div a centrar (en este caso "caja")
          $('#toma').css({
left: ($(window).width() - $('#toma').outerWidth()) / 2
});

	});

// Ejecutamos la función
$(window).resize();

});
</script>
</body>
</html>
