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

/*$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
$cad = "";
for($i=0;$i<8;$i++) {
	$cad .= substr($str,rand(0,62),1);
}
$correo=$obj->info['0']['correo'];*/
$obj->mod_clave($_POST['u'],$_POST['clave']);

/*$header = 'From: Calzados A Mano <info@calzadosamano.com>,';
$header .= 'Mime-Version: 1.0 \r\n';
$header .= 'Content-Type: text/html; charset=iso-8859-1';
$mensaje = "Mensaje enviado por Calzados A Mano<br>";
$mensaje .= "Su usuario es: " . $obj->info['0']['usuario'] . "<br>";
$mensaje .= "Nueva clave " . $cad. "<br>";
$asunto='Clave recuperada Calzados A Mano';

//mail( $correo, $asunto , utf8_decode($mensaje), $header);
header('location: http://calzadosamano.com/pages/iniciar.php');
exit();*/
header('location: generaclave.php?e=3&u='.$_POST['u']);
?>
