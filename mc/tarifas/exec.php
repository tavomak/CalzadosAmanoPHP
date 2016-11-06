<?php
	include "../../include/configure.php";
	include "../../include/database_tables.php";
	include "../../include/functions/database.php";
	include "../../include/class/tarifa.php";


	$action = $_REQUEST['action'];

	$obj = new tarifa();
	switch ($action) {
	case 'add':

		$obj->add($_POST["desde"],$_POST["hasta"],$_POST["precio"],$_POST["franqueo"],$_POST["iva"],$_POST["local"],$_POST["ruta"]);

		break;

	case 'mod':

		$obj->mod($_POST["id"],$_POST["desde"],$_POST["hasta"],$_POST["precio"],$_POST["franqueo"],$_POST["iva"],$_POST["local"],$_POST["ruta"]);

		break;

	case 'del':

		$obj->del($_REQUEST["id"]);
	}

	header('Location: index.php');


	?>
