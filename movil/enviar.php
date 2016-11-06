<?php

if (strlen($_POST['nombre'])==0) :
	echo "Debes llenar todos los campos";
	exit();
endif;

if (strlen($_POST['correo'])==0):
	echo "Debes llenar todos los campos";
	exit();
endif;

if(!filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL))
  {
  echo "Correo no v&aacute;lido";
  exit();
  }

if (strlen($_POST['asunto'])==0):
	echo "Debes llenar todos los campos";
	exit();
endif;

if (strlen($_POST['mensaje'])==0):
	echo "Debes llenar todos los campos";
	exit();
endif;

$email = $_POST['correo'];

$header = 'From: ' . $email . " \r\n";
$header .= "Mime-Version: 1.0 \r\n";
$header .= "Content-Type: text/html; charset=iso-8859-1";

$mensaje = "Mensaje enviado por " . $_POST['nombre'] . " <br>";
$mensaje .= "Su e-mail es: " . $email . "<br>";
$mensaje .= "Enviado el " . date('d/m/Y', time()). "<br>";

$mensaje .= "Mensaje:<br>" ;
$mensaje .=  $_POST['mensaje'] . "<br>";

$para="info@calzadosamano.com";

mail($para, $_POST['asunto'] , utf8_decode($mensaje), $header);
header('location: resultado.php?e=8');
?>
