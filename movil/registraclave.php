<?php
include "../include/configure.php";
include "../include/database_tables.php";
include "../include/functions/database.php";
include "../include/class/usuario.php";

$obj = new usuario();
$obj->load_usuario($_POST['u']);

if ((strlen($_POST['repiteclave'])==0)||(strlen($_POST['clave'])==0)) {
	header('location: generaclave.php?e=1&u='.$_POST['u']);
	exit();
}
if ($_POST['repiteclave']!=$_POST['clave']) {
	header('location: generaclave.php?e=2&u='.$_POST['u']);
	exit();
}

$obj->mod_clave($_POST['u'],$_POST['clave']);
header('location: generaclave.php?e=3&u='.$_POST['u']);
?>
