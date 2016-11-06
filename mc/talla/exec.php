<?php
	include "../../include/configure.php";
	include "../../include/database_tables.php";
	include "../../include/functions/database.php";
	include "../../include/class/talla.php";


	$action = $_REQUEST['action'];

	$obj = new talla();
	switch ($action) {
	case 'add':

				$obj->add($_POST["name"],$_POST["precio"],$_POST["peso"]);

		break;

	case 'mod':

		$obj->mod($_POST["id"],$_POST['name'],$_POST["precio"],$_POST["peso"]);

		break;

	case 'del':

		$obj->del($_REQUEST["id"]);
	}

	header('Location: index.php');


	?>
