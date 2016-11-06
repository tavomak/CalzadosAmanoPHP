<?php session_start();

	if (!isset($_SESSION['user'])){
		header('location: iniciar.php');
		exit();
	}

	$cantidad=$_SESSION['cantidad'];

	settype($_POST['id'],'integer');
	settype($_POST['cantidad'],'integer');
	$id=$_POST['id'];
	$_SESSION['articulos']=$_SESSION['articulos']-$cantidad[$id]+$_POST['cantidad'];
	$cantidad[$id]=$_POST['cantidad'];

	$_SESSION['cantidad']=$cantidad;

	header('location: mispedidos.php');
?>
