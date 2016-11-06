<?php
session_start();
if (!isset($_SESSION['user'])){?>
    <script>
		window.location.href='resultado.php?e=1';
		</script>
<?php
		exit();
	}
		if ($_SESSION['articulos']==0){
		header('location: mispedidos.php');
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
$datosTarifa=$_SESSION['datosTarifa'];
$obj= new usuario();
$obj->infoUser($_SESSION['user']);
$zapato=new  producto();
$objColor=new color();
$size=new talla();

$solicitud = new pedidos();
$nroOrden=$solicitud->addPedido($_SESSION['user'],$_SESSION['subtotal'],$tarifa);

$correo='
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-size:14px; font-family:Arial;" >
<tr><td colspan="2" align="center"><img src="http://calzadosamano.com/images/logo.png" width="207" height="66" /></td></tr>
<tr><td colspan="2">&nbsp;</td></tr><tr>
<tr><td colspan="2"><strong>Orden de Compra: '. $nroOrden .' </strong></td></tr><tr><td colspan="2" height="10" ></td></tr>
<tr><td colspan="2" >Solicitud:  '. $obj->info[0]['nombre'].'</td>
<tr><td colspan="2" align="left">Telf: '.$obj->info[0]['telefono'].'</td></tr>
<tr><td colspan="2" >Correo: '.$obj->info[0]['correo'].'</td></tr>
<tr><td colspan="2" height="20"></td></tr>
<tr><td colspan="2" ><strong>Datos para el despacho</strong></td></tr>
<tr><td colspan="2" height="10" ></td></tr>
<tr><td colspan="2" ><strong>'. $estado."-".$ciudad .'</strong></td></tr>
<td colspan="2" >';
$correo.= $direccion;
$correo.='</td></tr>
<tr><td colspan="2">Persona contacto: ' . $persona.'</td></tr>
<tr><td colspan="2">C&eacute;dula persona contacto: ' . $cedula.'</td></tr>
<tr><td colspan="2" >Telf: '. $telefono.'</td></tr>
<tr><td colspan="2">&nbsp;</td></tr>

<tr><td colspan="2">&nbsp;</td></tr>';
$total=0;$peso=0;$total_seguro=0; $articulos=0;$seguro=0;
tep_db_connect();
$bolsa= searchList("",NULL,0,NULL,"*", TABLE_BOLSA);
tep_db_close();

for ($i=0;$i<$n; $i++):
	if ($cantidad[$i]==0)  :
		continue;
	endif;

	$zapato->load($newzapato[$i]);
	$objColor->load($colores[$i]);
	$size->load($newtalla[$i]);
	$precio=$zapato->loadTallaProd($newzapato[$i],$newtalla[$i]);
	$inventario=$precio[0]['cantidad']-$cantidad[$i];
	if (strlen($zapato->info[0]['descuento'])>0) {
		$porcentaje =(100 - intval(preg_replace('/[^0-9]+/', '', $zapato->info[0]['descuento']), 10))/100;
	} else {
		$porcentaje =1;
	}
	$elprecio=$precio[0]['precio']*$porcentaje;
	if ($inventario>=0) {
		$solicitud->addProducto($nroOrden,$newzapato[$i],$newtalla[$i],$cantidad[$i]);
		$monto = $cantidad[$i]*$elprecio;$total+=$monto;
		$zapato->modCantidad($precio[0]['id'],$inventario);
		$seguro=$monto*$bolsa[0]['seguro'];
		$total_seguro+=$seguro;
		$peso+=$precio[0]['peso'];
		$articulos+=$cantidad[$i];
	} else {
		$cantidad[$i]=0;
		continue;
	}

	$correo.='<tr>
    <td  align="right" width="85" ><img  src="http://calzadosamano.com/images/producto/thumb/'.trim($zapato->info[0]['thumb']).'" width="80"></td>
    <td style="padding-left:10px" >
	<table style="font-size:14px; font-family:Arial;"><tr ><td>'.$cantidad[$i].'</td><td>'.$zapato->info[0]['nombre'].'</td><td>'.$size->info[0]['name'].'</td</tr>
	<tr><td colspan="3">BsF. '.number_format($elprecio,2).'</td></tr>
	<tr><td colspan="3" style="color:#999;">Cod. '.$zapato->info[0]['codigo'].'</td></tr></table></td></tr>';

   	endfor;
	$_SESSION['articulos']=$articulos;
	$costoBolsa=$bolsa[0]['costo']*$articulos;
   	$costoEnvio=$datosTarifa[0]['precio']+$datosTarifa[0]['franqueo']+$datosTarifa[0]['iva']+$costoBolsa+$total_seguro;
    if ($articulos==0):
	$solicitud->modPedido($nroOrden,0,0);
	else:
	$solicitud->modPedido($nroOrden,$total,$costoEnvio);
    endif;
    $correo.=' <tr>   <td ></td> <td ></td></tr>
	<tr><td align="right"><strong>Sub-total</strong></td><td style="padding-left:13px;">BsF. '.number_format($total,2).
	'</td></tr><tr><td align="right"><strong>Costo Envio</strong></td><td style="padding-left:13px;">BsF. '. number_format($costoEnvio,2).'</td></tr>';
	$total+=$costoEnvio;
	$correo.='<tr><td align="right"><strong>Total</strong></td><td style="padding-left:13px;">BsF. '. number_format($total,2).
	'</td></tr><tr><td colspan="2">&nbsp;</td></tr>
     <tr><td colspan="2" ><img src="http://calzadosamano.com/images/24h.jpg"  /></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>

<tr><td colspan="2" align="center"valign="middle" style="background-color:#00a3b4;padding-top:10px;">
 <a href="https://www.facebook.com/pages/Calzados-A-Mano/496423987087853" target="_blank" style="margin-right:20px"><img src="http://calzadosamano.com/mailing/img/redes_facebook.jpg" /></a>
 <a href="https://twitter.com/Calzados_Amano" target="_blank" style="margin-right:20px"><img src="http://calzadosamano.com/mailing/img/redes_twitter.jpg" /></a>
 <a href="https://instagram.com/calzadosamano/" target="_blank"><img src="http://calzadosamano.com/mailing/img/redes_instagram.jpg" /></a>
   </td></tr>
     <tr><td colspan="2" align="center"valign="middle" style="background-color:#00a3b4; padding-bottom:10px;"><a href="http://calzadosamano.com/" target="_blank"><img src="http://calzadosamano.com/mailing/img/web.jpg" /></a></td></tr>

</table>

';

$email = $obj->info[0]['correo'];

$header = 'From: Calzados A Mano <info@calzadosamano.com>,';
$header .= "Mime-Version: 1.0 \r\n";
$header .= "Content-Type: text/html; charset=iso-8859-1";

$para="info@calzadosamano.com";
$_SESSION['orden']=$nroOrden;
//
if (mail($para, "Nuevo pedido" , utf8_decode($correo), $header)){
	mail($email, 'Tu orden de compra en Calzados A Mano' , utf8_decode($correo), $header);
	$_SESSION['pedidoenviado']='ok';
	$_SESSION['zapato']=array();
$_SESSION['talla']=array();
$_SESSION['cantidad']=array();
$_SESSION['precio']=array();
$_SESSION['tarifa']='';
$_SESSION['estado']='';
$_SESSION['ciudad']='';
$_SESSION['cedula']='';
$_SESSION['telefono']='';
$_SESSION['persona']='';
$_SESSION['direccion']='';
$_SESSION['colores']=array();
$_SESSION['datosTarifa']=array();
$_SESSION['subtotal']='';
$_SESSION['articulos']=0;

} else {

	$_SESSION['pedidoenviado']='no';

}
header('location: mispedidos.php');
?>
