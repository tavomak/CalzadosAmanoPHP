<?php
	include "../../include/configure.php";
	include "../../include/database_tables.php";
	include "../../include/functions/database.php";
	include "../../include/class/producto.php";


	$action = $_REQUEST['action'];

	$obj = new producto();
	switch ($action) {
	case 'add':

		$id=$obj->addProducto();
		header('Location: mod.php?id='.$id . '&action=mod');
		break;

	case 'mod':

		if (strlen( $_FILES['big']['name'])>0) :
			$obj->uploadFile( $_FILES['big']['name'],$_FILES['big']['type'], $_FILES['big']['size'],$_FILES['big']['tmp_name'],"big");
		endif;
		if (strlen( $_FILES['thumb']['name'])>0) :
			$obj->uploadFile( $_FILES['thumb']['name'],$_FILES['thumb']['type'], $_FILES['thumb']['size'],$_FILES['thumb']['tmp_name'],"thumb");
		endif;
		if (strlen( $_FILES['zoom']['name'])>0) :
			$obj->uploadFile( $_FILES['zoom']['name'],$_FILES['zoom']['type'], $_FILES['zoom']['size'],$_FILES['zoom']['tmp_name'],"zoom");
		endif;
		if (strlen( $_FILES['color']['name'])>0) :
			$obj->uploadFile( $_FILES['color']['name'],$_FILES['color']['type'], $_FILES['color']['size'],$_FILES['color']['tmp_name'],"color");
		endif;

		$obj->mod($_POST['id'],$_POST['categoria'],$_POST['nombre'],$_FILES['big']['name'],$_FILES['thumb']['name'],$_POST['suela'],$_POST['material'],$_POST['posicion'],$_POST['preview'],$_POST['activado'],$_FILES['zoom']['name'],$_FILES['color']['name'],$_POST['precio']);

		header('Location: index.php?cat='.$_POST['categoria']);
		break;

	case 'del':

		$obj->del($_REQUEST["id"]);
		header('Location: index.php');

		break;

	case 'act':

		$obj->act($_REQUEST["id"]);
		header('Location: index.php');

		break;

	case 'del_b':
		$obj->del_b($_REQUEST["id"]);
		header('Location: mod.php?id='.$_REQUEST["id"] . '&action=mod');
		break;

	case 'del_t':
		$obj->del_t($_REQUEST["id"]);
		header('Location: mod.php?id='.$_REQUEST["id"] . '&action=mod');
		break;

	case 'del_z':
		$obj->del_z($_REQUEST["id"]);
		header('Location: mod.php?id='.$_REQUEST["id"] . '&action=mod');
		break;

	case 'del_c':
		$obj->del_c($_REQUEST["id"]);
		header('Location: mod.php?id='.$_REQUEST["id"] . '&action=mod');
		break;

	case 'addcolor':
		$obj->addcolor($_POST['id_producto'],$_POST['id_color']);
		header('Location: colores.php?id='.$_POST['id_producto']);
	break;

	case 'modposi':
		$obj->modposi($_REQUEST['id_producto'],$_POST['posicion'],$_POST['precio']);
		header('Location: colores.php?id='.$_POST['id_producto']);
	break;

	case 'actcolor':

		$obj->actcolor($_REQUEST["id"]);
		header('Location: colores.php?id='.$_REQUEST['id_producto']);

		break;
	case 'del_color':
		$obj->del_color($_REQUEST["id"]);
		header('Location: colores.php?id='.$_GET['id_producto']);
		break;

	case 'addtalla':
		$obj->addtalla($_POST['id_producto'],$_POST['id_talla']);
		header('Location: tallas.php?id='.$_POST['id_producto']);
	break;

	case 'modposit':
		$obj->modposit($_REQUEST['id'],$_POST['posicion'],$_POST['precio'],$_POST['cantidad'],$_POST['peso']);
		header('Location: tallas.php?id='.$_POST['id_producto']);
	break;

	case 'acttalla':

		$obj->acttalla($_REQUEST["id"]);
		header('Location: tallas.php?id='.$_REQUEST['id_producto']);

		break;
	case 'del_talla':
		$obj->del_talla($_REQUEST["id"]);
		header('Location: tallas.php?id='.$_GET['id_producto']);
		break;

	case 'addc':
		$id=$obj->addCatalogo($_GET['id_producto']);
		header('Location: modc.php?id='.$id . '&action=modc');
		break;
	case 'modc':
	if (strlen( $_FILES['big']['name'])>0) :
			$obj->uploadFile( $_FILES['big']['name'],$_FILES['big']['type'], $_FILES['big']['size'],$_FILES['big']['tmp_name'],"vistas/big");
		endif;
		if (strlen( $_FILES['thumb']['name'])>0) :
			$obj->uploadFile( $_FILES['thumb']['name'],$_FILES['thumb']['type'], $_FILES['thumb']['size'],$_FILES['thumb']['tmp_name'],"vistas/thumb");
		endif;
		$obj->modc($_POST['id'],$_FILES['big']['name'],$_FILES['thumb']['name'],$_POST['posicion'],$_POST['mostrar']);
		header('Location: catalogo.php?id='.$_POST['id_producto'] );
		break;
	case 'actc':
	$obj->actc($_REQUEST["id"]);
		header('Location: catalogo.php?id='.$_REQUEST['id_producto']);
		break;
	case 'del_ic':
	$obj->del_ic($_REQUEST["id"]);
		header('Location: catalogo.php?id='.$_GET['id_producto']);
		break;
	}

	?>
