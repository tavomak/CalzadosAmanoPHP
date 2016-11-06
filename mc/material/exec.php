<?php
	include "../../include/configure.php";
	include "../../include/database_tables.php";
	include "../../include/functions/database.php";
	include "../../include/class/material.php";


	$action = $_REQUEST['action'];

	$obj = new material();
	switch ($action) {
	case 'add':

				$obj->add($_POST["name"]);

		break;

	case 'mod':

		$obj->mod($_POST["id"],$_POST['name']);

		break;

	case 'del':

		$obj->del($_REQUEST["id"]);
	}

	header('Location: index.php');


	?>
