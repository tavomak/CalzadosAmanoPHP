<?php
session_start();
	if (!isset($_SESSION['user'])){
		header('location: iniciar.php');
		exit();
	}
include "../include/configure.php";
include "../include/database_tables.php";
include "../include/functions/database.php";
include "../include/class/usuario.php";
include "../include/class/producto.php";
include "../include/class/pedidos.php";
include "../include/class/color.php";
include "../include/class/talla.php";

$newzapato=$_SESSION['zapato'];
$newtalla=$_SESSION['talla'];
$cantidad=$_SESSION['cantidad'];
$precio=$_SESSION['precio'];
$tarifa=$_SESSION['tarifa'];
$estado= $_SESSION['estado'];
$ciudad=  $_SESSION['ciudad'];
$cedula=  $_SESSION['cedula'];
$telefono=$_SESSION['telefono'];
$persona = $_SESSION['persona'];
$direccion = $_SESSION['direccion'];
$colores=$_SESSION['colores'];
$n=count($_SESSION['zapato']);

$j=0;
for ($i=0;$i<$n; $i++):
	if ($cantidad[$i]==0)  :
		continue;
	endif;
	$j=1;
endfor;

if (($n==0) || ($j==0)):
	header('location: mispedidos.php');
		exit();
endif;



$obj= new usuario();
$obj->infoUser($_SESSION['user']);
$zapato=new  producto();
$objColor=new color();
$size=new talla();

$solicitud = new pedidos();
$nroOrden=$solicitud->addPedido($_SESSION['user'],$_SESSION['subtotal'],$tarifa);

$correo='
<table width="100%" border="0" cellpadding="0" cellspacing="0" >
<tr><td colspan="6" align="center"><img src="http://calzadosamano.com/images/logo.png" width="207" height="66" /></td></tr>
<tr>
<tr><td colspan="3" align="left">Orden de Compra: '. $nroOrden .' </td>
<td colspan="3"  align="right"><strong>Datos para el despacho</strong></td></tr>
<tr><td colspan="3" align="left"><strong>Solicitud:  '. $obj->info[0]['nombre'].'</strong></td>
<td colspan="3"  align="right"><strong>'. $estado."-".$ciudad .'</strong></td></tr>
<tr>
<td colspan="3" align="left"><strong>Tel&eacute;fono: '.$obj->info[0]['telefono'].'</strong></td>
<td colspan="3" rowspan="2"  align="right" valign="top"><strong>';
$correo.= $direccion;
$correo.='</strong></td></tr>
<tr><td colspan="3" align="left" valign="top" width="60%"><strong>Correo: '.$obj->info[0]['correo'].'</strong></td></tr>
<tr>
<td colspan="3" align="left"></td>
<td colspan="3"  align="right"><strong>Persona contacto: ' . $persona.'</strong></td></tr>
<td colspan="3" align="left"></td>
<td colspan="3"  align="right"><strong>C&eacute;dula persona contacto: ' . $cedula.'</strong></td></tr>
<tr><td colspan="3" align="left"></td>
<td colspan="3"  align="right"><strong>Telf: '. $telefono.'</strong></td></tr>
<tr><td colspan="6">&nbsp;</td></tr>
<tr><td colspan="6" bgcolor="#999999" style="height:1px;"></td></tr>
<tr><td colspan="6">&nbsp;</td></tr>
<tr>  <td align="center"></td>
<td align="center"><strong>Modelo</strong></td>
<td  align="center"><strong>Talla</strong></td>

<td  align="center"><strong>Cantidad</strong></td>
<td  align="right" width="20%"><strong>Precio Unitario</strong></td>
<td  align="right"  width="20%"><strong>Total</strong></td></tr>';
$total=0;

for ($i=0;$i<$n; $i++):
	if ($cantidad[$i]==0)  :
		continue;
	endif;

	$zapato->load($newzapato[$i]);
	$objColor->load($colores[$i]);
	$size->load($newtalla[$i]);
	$precio=$zapato->loadTallaProd($newzapato[$i],$newtalla[$i]);
	$inventario=$precio[0]['cantidad']-$cantidad[$i];

	if (strlen($obj->info[0]['descuento'])>0) {
		$porcentaje =(100 - intval(preg_replace('/[^0-9]+/', '', $obj->info[0]['descuento']), 10))/100;
	} else {
		$porcentaje =1;
	}
	$elprecio=$precio[0]['precio']*$porcentaje;

	if ($inventario>=0) {
		$solicitud->addProducto($nroOrden,$newzapato[$i],$newtalla[$i],$cantidad[$i]);
		$monto = $cantidad[$i]*$elprecio;$total+=$monto;
		$zapato->modCantidad($precio[0]['id'],$inventario);
	} else {
		$cantidad[$i]=0;
		continue;
	}

	$correo.='<tr>
    <td width="8%"><img  src="http://calzadosamano.com/images/producto/thumb/'.trim($zapato->info[0]['thumb']).'" width="80"></td>
    <td align="center">'.$zapato->info[0]['nombre'].'</td>
	<td align="center">'.$size->info[0]['name'].'</td>

    <td align="center">'.$cantidad[$i].'</td>
    <td align="right">Bs. '.number_format($elprecio,2).'</td>
 	<td align="right">Bs. '.number_format($monto,2).'</td></tr>';

  	endfor;
    $correo.=' <tr>   <td ></td> <td ></td><td ></td> <td ></td>
    <td  align="right"><strong>Sub-total Bs.</strong></td>
	<td  align="right"><strong>'.number_format($total,2).'</strong></td></tr>
   	<tr>    <td ></td> <td ></td><td ></td> <td ></td>
    <td  align="right"><strong>Costo Envio Bs. </strong></td>
	<td  align="right"><strong>'. number_format($tarifa,2).'</strong></td></tr>
  	<tr>  <td ></td> <td ></td><td ></td> <td ></td>
    <td  align="right"><strong>Total Bs. </strong></td>
	<td  align="right"><strong>';
  	$total+=$tarifa;
	$correo.= number_format($total,2).'</strong></td>  </tr>
    <tr><td></td><td></td><td></td><td></td><td></td><td >&nbsp;</td></tr>
     <tr><td colspan="6" align="center"><img src="http://calzadosamano.com/images/24h.jpg"  />
</td></tr><tr><td colspan="6">&nbsp;</td></tr>

<tr><td colspan="6" align="center"valign="middle" style="background-color:#00a3b4">
 <a href="https://www.facebook.com/pages/Calzados-A-Mano/496423987087853" target="_blank" style="margin-right:20px"><img src="http://calzadosamano.com/mailing/img/redes_facebook.jpg" /></a>
 <a href="https://twitter.com/Calzados_Amano" target="_blank" style="margin-right:20px"><img src="http://calzadosamano.com/mailing/img/redes_twitter.jpg" /></a>
 <a href="https://instagram.com/calzadosamano/" target="_blank"><img src="http://calzadosamano.com/mailing/img/redes_instagram.jpg" /></a>
   </td></tr>
     <tr><td colspan="6" align="center"valign="middle" style="background-color:#00a3b4"><a href="http://calzadosamano.com/" target="_blank"><img src="http://calzadosamano.com/mailing/img/web.jpg" /></a></td></tr>

</table>

';

$email = $obj->info[0]['correo'];

$header = 'From: Calzados A Mano <info@calzadosamano.com>,';
$header .= "Mime-Version: 1.0 \r\n";
$header .= "Content-Type: text/html; charset=iso-8859-1";

$para="info@calzadosamano.com";
$_SESSION['orden']=$nroOrden;
$_SESSION['cantidad']=$cantidad;
//
if (mail($para, "Nuevo pedido" , utf8_decode($correo), $header)){
	mail($email, 'Tu orden de compra en Calzados A Mano' , utf8_decode($correo), $header);
	$_SESSION['pedidoenviado']='ok';


} else {

	$_SESSION['pedidoenviado']='no';

}
header('location: mispedidos.php');
?>
