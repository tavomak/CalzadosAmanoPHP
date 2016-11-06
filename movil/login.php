<?php session_start();
	include "../include/configure.php";
	include "../include/database_tables.php";
	include "../include/functions/database.php";
	include "../include/class/usuario.php";



	$obj = new usuario();
	$obj->load_usuario($_POST['usuario']);

	if (count($obj->info)==0){
		header('location: iniciar.php?e=1');
		exit();
	}

	if ($obj->info[0]['clave']==md5($_POST['clave'])) {
			$_SESSION['user']=$obj->info[0]['id'];
			$_SESSION['zapato']=array();
			$_SESSION['talla']=array();
			$_SESSION['cantidad']=array();
			$_SESSION['precio']=array();
			$_SESSION['colores']=array();
			$_SESSION['articulos']=0;
			header('location: mispedidos.php');
			exit();
			}

	//La clave no coincide
	header('location: iniciar.php?e=1');

?>
