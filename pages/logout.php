<?php session_start();
$_SESSION = array();
session_destroy();
?>
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

	<div id="resultado" style="display:block">
     Sesi&oacute;n cerrada exitosamente
     </div>

	<div id="wrapper">
    	<div id="intwrapper">
        	<header>
         <a href="../index.php"><div id="logo"></div></a>
<?php include "redes.php"; ?>

                <div class="separador"></div>
                <nav id="menu">
                 <?php $pages=$_SERVER['PHP_SELF'];
				include "menu.php"; ?>

               </nav>
            </header>
 <!--
<a href="javascript:alertSize();" > mostrar Height / Width </a>
<p id="resultado"></p>  -->

		<div class="container" align="center">


		</div> <!--fin container -->

        </div>  <!-- fin intwrapper -->
  <?php include "footer.php"; ?>
	</div>       <!-- fin wrapper -->
</body>
</html>
