<?php include "zsession.php";
	include "../../include/configure.php";
	include "../../include/database_tables.php";
	include "../../include/functions/database.php";
	include "../../include/class/banner.php";
	$action = $_REQUEST['action'];

	$obj = new banner();

	switch ($action) {
	case 'add':

		if (strlen( $_FILES['imagen']['name'])>0) :
		if ($obj->uploadFile( $_FILES['imagen']['name'],$_FILES['imagen']['type'], $_FILES['imagen']['size'],$_FILES['imagen']['tmp_name'],"imagen")):
		endif;
		endif;

		$obj->add($_POST['titulo'],$_FILES['imagen']['name'],$_POST['enlace'],$_POST['posicion'],$_POST['activado']);
		break;

	case 'mod':

		if (strlen( $_FILES['imagen']['name'])>0) :
		if ($obj->uploadFile( $_FILES['imagen']['name'],$_FILES['imagen']['type'], $_FILES['imagen']['size'],$_FILES['imagen']['tmp_name'],"imagen")):
		endif;
		endif;

		$obj->mod($_POST['titulo'],$_FILES['imagen']['name'],$_POST['enlace'],$_POST['posicion'],$_POST['activado']);

		break;

		case 'del':
		if (is_numeric($_REQUEST["id"])):
			$obj->del($_REQUEST["id"]);
		endif;

		break;

		case 'delt':
		if (is_numeric($_REQUEST["id"])):
			$obj->delt($_REQUEST["id"]);
		endif;
		header('Location: mod.php?action=mod&id='.$_REQUEST["id"]);
		exit();
		break;


	case 'act':
		if (is_numeric($_REQUEST["id"])):
			$obj->act($_GET['id']);
		endif;

		break;

	}
		header('Location: index.php');
	?>
