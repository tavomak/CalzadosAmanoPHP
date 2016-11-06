<?php
session_start();
	include "../include/configure.php";
	include "../include/database_tables.php";
	include "../include/functions/database.php";
	include "../include/class/producto.php";
	settype($_POST['id'],'integer')	;
	$id=$_POST['id'];
	$obj = new producto();
	$obj->load($id);
	settype($_POST['id_zapato'],'integer')	;
	$id_zapato=$_POST['id'];
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

       <?php if (($obj->info[0]['categoria']>='5') || ($obj->info[0]['categoria']=='10')|| ($obj->info[0]['categoria']=='11')|| ($obj->info[0]['categoria']=='12')|| ($obj->info[0]['categoria']=='13')|| ($obj->info[0]['categoria']=='14')) :
	   	if (($obj->info[0]['categoria']=='5') || ($obj->info[0]['categoria']=='9')|| ($obj->info[0]['categoria']=='8')) : ?>
       <iframe frameborder="0" height="100%" width="100%" scrolling="no" src="detaplantilla.php?id=<?php echo $id;?>&id_zapato=<?php echo $id_zapato; ?>"></iframe>
       <?php else: ?>
 		<iframe frameborder="0" height="100%" width="100%" scrolling="no" src="detaccesorio.php?id=<?php echo $id;?>"></iframe>
         <?php endif; ?>
  <?php else: ?>
        <iframe frameborder="0" height="100%" width="100%" scrolling="no" src="detalle.php?id=<?php echo $id;?>"></iframe>
         <?php endif; ?>
		</div> <!--fin container -->

       </div>  <!-- fin intwrapper -->
<?php include "footer.php"; ?>
	</div>       <!-- fin wrapper -->

</body>

</html>
