<?php
session_start();
include "../include/configure.php";
include "../include/database_tables.php";
include "../include/functions/database.php";
include "../include/class/usuario.php";
include "../include/class/producto.php";
include "../include/class/pedidos.php";

if (!isset($_SESSION['user'])){
		header('location: iniciar.php');
		exit();
	}
if ((!isset($_SESSION['orden']))||(strlen($_POST['numerodt'])==0)||(strlen($_POST['fecha'])==0)||(strlen($_POST['banco'])==0)){
		echo '<a href="javascript: despejar();" >Debe llenar todos los campos</a>';
		exit();
	}

if (is_numeric)

if ($_POST['acepto']==1){
	$acepto=1;
} else { $acepto=0;}



if ($acepto==1) {


$obj= new usuario();
$obj->infoUser($_SESSION['user']);

$pedido=new pedidos();
$pedido->loadPedidoUsuario($_SESSION['orden'],$_SESSION['user']);
if (count($pedido->info)==0) {
		header('location: resultado.php?e=2');
}
$pedido->cambiarEstado($_SESSION['orden'],'1');
$total=$pedido->info[0]['tot_zapato']+$pedido->info[0]['tot_envio'];

$correo ='Orden Nro. '. $_SESSION['orden'].'<br>';
$correo .='de '. $obj->info[0]['nombre'].'<br>';
$correo .='Tel&eacute;fono '. $obj->info[0]['telefono'].'<br>';
$correo .='Correo '. $obj->info[0]['correo'].'<br>';
$correo .= '<table width="100%" border="0" cellpadding="3" cellspacing="2">';
$correo .= '<tr><td width="200">Dep&oacute;sito/Transferencia</td><td></td></tr>';
$correo .= '<tr><td width="200">Monto</td><td>BsF. '.number_format($total,2).'</td></tr>';
$correo .= '<tr><td width="200">N&uacute;mero</td><td>'.$_POST['numerodt'].'</td></tr>';
$correo .= '<tr><td width="200">Fecha</td><td>'.$_POST['fecha'].'</td></tr>';
$correo .= '<tr><td width="200">Banco</td><td>'.$_POST['banco'].'</td></tr>';
$correo.='<tr><td colspan="2" align="center"valign="middle" style="background-color:#00a3b4">
 <a href="https://www.facebook.com/pages/Calzados-A-Mano/496423987087853" target="_blank" style="margin-right:20px"><img src="http://calzadosamano.com/mailing/img/redes_facebook.jpg" /></a>
 <a href="https://twitter.com/Calzados_Amano" target="_blank" style="margin-right:20px"><img src="http://calzadosamano.com/mailing/img/redes_twitter.jpg" /></a>
 <a href="https://instagram.com/calzadosamano/" target="_blank"><img src="http://calzadosamano.com/mailing/img/redes_instagram.jpg" /></a>
   </td></tr>
     <tr><td colspan="2" align="center"valign="middle" style="background-color:#00a3b4"><a href="http://calzadosamano.com/" target="_blank"><img src="http://calzadosamano.com/mailing/img/web.jpg" /></a></td></tr>';

$correo .= '</table>';
$correouser ='<a href="http://calzadosamano.com/" target="_blank"><img src="http://calzadosamano.com/mailing/img/confirmacion-pago.jpg" width="100%" /></a>';
$correouser.='<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td colspan="2" align="center"valign="middle" style="background-color:#00a3b4">
 <a href="https://www.facebook.com/pages/Calzados-A-Mano/496423987087853" target="_blank" style="margin-right:20px"><img src="http://calzadosamano.com/mailing/img/redes_facebook.jpg" /></a>
 <a href="https://twitter.com/Calzados_Amano" target="_blank" style="margin-right:20px"><img src="http://calzadosamano.com/mailing/img/redes_twitter.jpg" /></a>
 <a href="https://instagram.com/calzadosamano/" target="_blank"><img src="http://calzadosamano.com/mailing/img/redes_instagram.jpg" /></a>
   </td></tr>
     <tr><td colspan="2" align="center"valign="middle" style="background-color:#00a3b4"><a href="http://calzadosamano.com/" target="_blank"><img src="http://calzadosamano.com/mailing/img/web.jpg" /></a></td></tr></table>';
$email = $obj->info[0]['correo'];

$header = 'From: Calzados A Mano <info@calzadosamano.com>,';
$header .= "Mime-Version: 1.0 \r\n";
$header .= "Content-Type: text/html; charset=iso-8859-1";

$para="info@calzadosamano.com";

//
if (mail($para, "Pago Orden Nro. ". $_SESSION['orden'], utf8_decode($correo), $header)){
	mail($email, "Pago Orden Nro. ". $_SESSION['orden'] , utf8_decode($correouser), $header);
	echo '<a href="javascript: index.php;" >Sus datos de pago han sido enviados. &iexcl;Gracias por su compra!</a>';
}
} else {
	echo '<a href="javascript: despejar();" >Debe Aceptar los t&eacute;rminos y condiciones</a>';
}
?>
