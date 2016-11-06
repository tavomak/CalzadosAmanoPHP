<?php	include "zsession.php";
	include "../../include/configure.php";
	include "../../include/database_tables.php";
	include "../../include/functions/database.php";
	include "../../include/class/usuario.php";

	$action = $_REQUEST['action'];
	$obj = new usuario();

	switch ($action) {
	case 'add':
		$obj->add($_POST['usuario'],$_POST['nombre'],$_POST['birth'],$_POST['sexo'],$_POST['empleado'],$_POST['profesion'],$_POST['ciudad'],$_POST['telefono'],$_POST['email'],$_POST['clave']);
		break;
	case 'mod':
			$obj->mod($_POST['usuario'],$_POST['nombre'],$_POST['birth'],$_POST['sexo'],$_POST['empleado'],$_POST['profesion'],$_POST['ciudad'],$_POST['telefono'],$_POST['email']);
		break;

	case 'modClave':
			$obj->mod_clave($_POST['usuario'],$_POST['clave']);

		break;
	case 'del':
			$obj->del($_GET['id']);
			break;
	case 'act':
			$obj->activar($_GET['id']);
	break;
	}

	header('Location: index.php');
		?>
