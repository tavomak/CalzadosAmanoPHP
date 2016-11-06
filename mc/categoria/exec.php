<?php include "zsession.php";
	include "../../include/configure.php";
	include "../../include/database_tables.php";
	include "../../include/functions/database.php";
	include "../../include/class/categoria.php";
	$action = $_REQUEST['action'];

	$obj = new categoria();

	switch ($action) {

	case 'add':
		if (strlen( $_FILES['image_off']['name'])>0):
			$obj->uploadFile( $_FILES['image_off']['name'],$_FILES['image_off']['type'], $_FILES['image_off']['size'],$_FILES['image_off']['tmp_name'],"big");
		endif;
		if (strlen($_FILES['image_on']['name'])>0):
			$obj->uploadFile( $_FILES['image_on']['name'],$_FILES['image_on']['type'], $_FILES['image_on']['size'],$_FILES['image_on']['tmp_name'],"big");
		endif;
		$obj->add($_POST['nombre'],$_FILES['image_off']['name'],$_FILES['image_on']['name'],$_POST['posicion'],$_POST['preview'],$_POST["activado"]);

		break;

	case 'mod':
		if (strlen( $_FILES['image_off']['name'])>0):
			$obj->uploadFile( $_FILES['image_off']['name'],$_FILES['image_off']['type'], $_FILES['image_off']['size'],$_FILES['image_off']['tmp_name'],"big");
		endif;
		if (strlen($_FILES['image_on']['name'])>0):
			$obj->uploadFile( $_FILES['image_on']['name'],$_FILES['image_on']['type'], $_FILES['image_on']['size'],$_FILES['image_on']['tmp_name'],"big");
		endif;

		$obj->mod($_POST['id'],$_POST['nombre'],$_FILES['image_off']['name'],$_FILES['image_on']['name'],$_POST['posicion'],$_POST['preview'],$_POST["activado"]);

		break;

		case 'del':
		if (is_numeric($_REQUEST["id"])):
			$obj->del($_REQUEST["id"]);
		endif;

		break;

	case 'act':
		if (is_numeric($_REQUEST["id"])):
			$obj->act($_GET['id']);
		endif;

		break;
	}

		header('Location: index.php');
	?>
