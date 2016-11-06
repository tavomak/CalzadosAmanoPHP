<?php
	include "../../include/configure.php";
	include "../../include/database_tables.php";
	include "../../include/functions/database.php";
	include "../../include/class/color.php";


	$action = $_REQUEST['action'];

	$obj = new color();
	switch ($action) {
	case 'add':

		$obj->add($_POST["name"],$_POST["posicion"],$_POST["activado"]);

		break;

	case 'mod':

		$obj->mod($_POST["id"],$_POST['name'],$_POST["posicion"],$_POST["activado"]);

		break;

	case 'del':

		$obj->del($_REQUEST["id"]);break;

	case 'act':
		if (is_numeric($_REQUEST["id"])):
			$obj->act($_GET['id']);
		endif;	break;
	}
	header('Location: index.php');

	?>
