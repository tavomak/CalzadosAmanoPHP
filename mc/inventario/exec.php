<?php
	include "../../include/configure.php";
	include "../../include/database_tables.php";
	include "../../include/functions/database.php";
	include "../../include/class/producto.php";


	$action = $_REQUEST['action'];

	$obj = new producto();
	switch ($action) {

	case 'act':

		$obj->act($_REQUEST["id"]);
		header('Location: index.php');

		break;

	case 'modestado':
		$obj->modestado($_REQUEST['id'],$_POST['nuevo'],$_POST['descuento'],$_POST['plantilla']);
		header('Location: mod.php?action=mod&id='.$_REQUEST['id']);
		break;

	case 'modposit':
		$obj->modposit($_REQUEST['id'],$_POST['posicion'],$_POST['precio'],$_POST['cantidad'],$_POST['peso']);
		header('Location: tallas.php?id='.$_POST['id_producto']);
	break;

	case 'modaccess':
	$obj->modposit($_REQUEST['id'],$_POST['posicion'],$_POST['precio'],$_POST['cantidad'],$_POST['peso'],$_POST['id_color'],$_POST['dimensiones']);
	header('Location: tallasaccess.php?id='.$_POST['id_producto']);
	break;

	case 'acttalla':

		$obj->acttalla($_REQUEST["id"]);
		header('Location: tallas.php?id='.$_REQUEST['id_producto']);

		break;
	case 'acttallacces':

		$obj->acttalla($_REQUEST["id"]);
		header('Location: tallasaccess.php?id='.$_REQUEST['id_producto']);

		break;

	case 'del':
		include "../../include/class/pedidos.php";
		$pedidos= new pedidos();
		$pedidos->del($_GET['id']);
		header('Location: poranular.php?ini='.$_REQUEST['ini']);
	 break;

	 case 'anu':
	 	include "../../include/class/pedidos.php";
		$pedidos= new pedidos();
		$pedidos->anu($_GET['id']);
		header('Location: poranular.php?id='.$_REQUEST['ini']);
	 break;
	 case 'addtalla_z':
	 $obj->addtalla($_POST['id_producto'],$_POST['id_talla']);
	 header('Location: tallas.php?id='.$_REQUEST['id_producto']);
	 break;
	 case 'addtalla_a':
	 $obj->addtalla($_POST['id_producto'],$_POST['id_talla']);
	 header('Location: tallasaccess.php?id='.$_REQUEST['id_producto']);
	 break;
	}

	?>
