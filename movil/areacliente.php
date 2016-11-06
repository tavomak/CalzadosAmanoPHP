<?php session_start();
	if (!isset($_SESSION['user'])){
		header('location: nouser.php');
		exit();
	}
    if ((strlen($_POST['cantidad'])==0)||(strlen($_POST['talla'])==0)) {
		header('location: mispedidos.php');
		exit();
	}
	$newzapato=$_SESSION['zapato'];
	$newtalla=$_SESSION['talla'];
	$cantidad=$_SESSION['cantidad'];
	$precio=$_SESSION['precio'];
	$colores=$_SESSION['colores'];

	$i=count($_SESSION['zapato']);

	//Verificar que el zapato no ha sido ingresado previamente
	$ok=true;
	for ($j=0;$j<count($newzapato);$j++) {
		if (($_POST['id_zapato']==$newzapato[$j])&&($_POST['talla']==$newtalla[$j])){
			$ok=false;
		}
	}

	if ($ok) {
	$newzapato[$i]=$_POST['id_zapato'];
	$newtalla[$i]=$_POST['talla'];
	$precio[$i]=$_POST['precio'];
	$colores[$i]=$_POST['id_color'];
	$cantidad[$i]=$_POST['cantidad'];

	$_SESSION['zapato']=$newzapato;
	$_SESSION['talla']=$newtalla;
	$_SESSION['cantidad']=$cantidad;
	$_SESSION['precio']=$precio;
	$_SESSION['colores']=$colores;
	$_SESSION['articulos']+=$_POST['cantidad'];
	}
	header('location: mispedidos.php');

?>
