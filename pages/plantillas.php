<?php
session_start();
	include "../include/configure.php";
	include "../include/database_tables.php";
	include "../include/functions/database.php";
	include "../include/class/producto.php";

	settype($_GET['id_categoria'],'integer')	;
	$id_categoria=$_GET['id_categoria'];
	$obj = new producto();
	$obj->loadCategoria($id_categoria);
	$id=$obj->info[0]['id'];
	settype($_GET['id_zapato'],'integer')	;
	$id_zapato=$_GET['id_zapato'];
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
  <link rel="stylesheet" type="text/css" href="../css/producto.css" />
  <link rel="stylesheet" type="text/css" href="../css/galeria.css" />
  <link rel="stylesheet" type="text/css" href="../css/menu.css">
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

  		<div class="container">

       <iframe frameborder="0" height="100%" width="100%" scrolling="no" src="detaplantilla.php?id=<?php echo $id;?>&id_zapato=<?php echo $id_zapato; ?>"></iframe>

		</div> <!--fin container -->

       </div>  <!-- fin intwrapper -->
<?php include "footer.php"; ?>
	</div>       <!-- fin wrapper -->

</body>

</html>
