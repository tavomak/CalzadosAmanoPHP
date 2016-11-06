<?php
	include "../../include/configure.php";
	include "../../include/database_tables.php";
	include "../../include/functions/database.php";
	include "../../include/class/ruta.php";


	$action = $_REQUEST['action'];

	$obj = new ruta();
	switch ($action) {
	case 'add':

				$obj->add($_POST['id_city'],$_POST['ciudad'],$_POST['ruta'],$_POST['local']);

		break;

	case 'mod':

		$obj->mod($_POST["id"],$_POST['id_city'],$_POST['ciudad'],$_POST['ruta'],$_POST['local']);

		break;

	case 'del':

		$obj->del($_REQUEST["id"]);
	}

	header('Location: index.php');


	?>
