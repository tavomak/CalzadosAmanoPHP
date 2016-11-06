<?php
	include "../../include/configure.php";
	include "../../include/database_tables.php";
	include "../../include/functions/database.php";
	include "../../include/class/agencia.php";


	$action = $_REQUEST['action'];

	$obj = new agencia();
	switch ($action) {
	case 'add':

				$obj->add($_POST['id_ruta'],$_POST['nombre'],$_POST['direccion']);

		break;

	case 'mod':

		$obj->mod($_POST["id"],$_POST['id_ruta'],$_POST['nombre'],$_POST['direccion']);

		break;

	case 'del':

		$obj->del($_REQUEST["id"]);
	}

	header('Location: index.php');


	?>
