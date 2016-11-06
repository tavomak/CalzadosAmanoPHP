<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Calzados A'mano</title>
	<meta name="description" content="Calzados A'mano" />
	<meta name="keywords" content="Calzados A'mano" />
	<link rel="shortcut icon" href="../favicon.ico">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="../css/basic.css" />
    <link rel="stylesheet" type="text/css" href="../css/contacto.css" />
  	<link rel="stylesheet" type="text/css" href="../css/menu.css">
</head>

<body>
<div id="resultado" style="padding-bottom:60px; padding-top:40px; color:#FFF; display:block; font-size:72px; ">&iquest;Eres nuevo? <a href="registrarse.php">Reg&iacute;strate</a> o <a href="iniciar.php">Inicia sesi&oacute;n</a></div>

	<div id="wrapper">
    	<div id="intwrapper">
        	<header>
         <div id="logo"><a href="../index.php"><img src="../images/logo.png" width="207" height="66"></a></div>
        	<nav id="redes">
                <a href="registrarse.php" class="boton btn_registrarsehover" ></a>
                <a href="iniciar.php" class="boton btn_sesion"></a>
                <a href="https://www.facebook.com/pages/Calzados-A-Mano/496423987087853" class="boton btn_facebook" target="_blank"></a>
                <a href="https://twitter.com/Calzados_Amano" class="boton btn_twitter" target="_blank"></a>
               <a href="https://instagram.com/calzadosamano/" class="boton btn_instagram" target="_blank"></a>
               <a href="mispedidos.php" class="boton btn_carrito" ></a> <span style="color: #009999; margin-left:10px; font-weight:bold;"><?php echo $_SESSION['articulos'];?></span>
                </nav>

                <div class="separador"></div>
                <nav id="menu">
                <?php $pages=$_SERVER['PHP_SELF'];
				include "menu.php"; ?>


               </nav>
            </header>
 <!--
<a href="javascript:alertSize();" > mostrar Height / Width </a>
<p id="resultado"></p>  -->

		 <!--fin container -->

        </div>  <!-- fin intwrapper -->
        <div id='footer'>
        	Todos los derechos reservados. <a href="http://www.instintocreativo.net.ve/" target="_blank">IC Estudio de Desarrollo Creativo</a>. 2014.
        </div>
	</div>       <!-- fin wrapper -->

</body>
</html>
