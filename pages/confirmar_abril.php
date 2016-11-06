<?php session_start();
	if (!isset($_SESSION['user'])){
		header('location: iniciar.php');
		exit();
	}

	include "../include/configure.php";
	include "../include/database_tables.php";
	include "../include/functions/database.php";
	include "../include/class/usuario.php";
	include "../include/class/producto.php";
	include "../include/class/talla.php";
	include "../include/class/ruta.php";
	include "../include/class/color.php";

	if ((!isset($_POST['ciudad']))||(strlen($_POST['ciudad'])==0) ||(strlen($_POST['telefono'])==0)||(strlen($_POST['persona'])==0)||((strlen($_POST['agencia'])==0)&&(strlen($_POST['direccion'])==0))){ ?>
    <script>window.location.href="despacho.php";</script>
	<?php  exit(); 	}

	$idRuta=$_POST['ciudad'];

	$ruta=new ruta();
	$ruta->load($idRuta);

	tep_db_connect();
	$user =	searchList("id='" .$_SESSION['user'] . "'",NULL,0,NULL,"*", TABLE_USUARIO);
	$estado = searchList("id_city='".$_POST['estado']."'","city_name",NULL,NULL,"*",TABLE_ESTADO);
	if (strlen(($_POST['agencia'])>0)){
		$agencia = searchList("id='" . $_POST['agencia'] . "'",NULL,0,NULL,"*", TABLE_AGENCIA);
	}
	$bolsa= searchList("",NULL,0,NULL,"*", TABLE_BOLSA);
	tep_db_close();

	$newzapato=$_SESSION['zapato'];
	$newtalla=$_SESSION['talla'];
	$cantidad=$_SESSION['cantidad'];
	$precio=$_SESSION['precio'];
	$colores=$_SESSION['colores'];
	$n=count($newzapato);

	$x=0;
	for ($i=0;$i<$n;$i++):

	if ($cantidad[$i]==0)  :
		continue;
	endif;
	$x+=1;
	endfor;

	$obj = new producto();
	$obj->load($newzapato[0]);

	$size=new talla();
	$objColor=new color();
?>
<!DOCTYPE html>

<html lang="en" >

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="../css/basic.css" />
    <link rel="stylesheet" type="text/css" href="../css/producto.css" />
   <link rel="stylesheet" type="text/css" href="../css/menu.css">
    <script>


function aceptar(){
	if (document.getElementById('terminos').checked){
		document.getElementById("enviarpedido").style.visibility="visible";
	}else{
		document.getElementById("enviarpedido").style.visibility="hidden";
	}
}
</script>


</head>

<body>
	<div id="wrapper">
    	<div id="intwrapper"  style="height:auto;">
        	<header>
            <div id="logo"><a href="../index.php"><img src="../images/logo.png" width="207" height="66"></a></div>
            <?php include "redes.php"; ?>

            <div class="separador"></div>
            <nav id="menu">
               <?php $pages=$_SERVER['PHP_SELF'];
				include "menu.php"; ?>
            </nav>
            </header>
		</div>

		<div class="containerPedido" >
        <?php  if (($n>0)&&($x>0)): ?>

			<div id="centroPedido"  >
            	<div id="datos">
                <table width="100%" border="0" >

<tr>
<td colspan="3" align="center">&nbsp;</td>

<td colspan="3"  align="right"><strong>Datos para el despacho</strong></td>
</tr>

<tr>
<td colspan="3" align="left"><strong>Solicitud: <?php echo $user[0]['nombre'];?></strong></td>

<td colspan="3"  align="right"><strong><?php echo $estado[0]['city_name']."-".$ruta->info[0]['ciudad'];	?></strong></td>
</tr>

<tr>
<td colspan="3" align="left"><strong>Tel&eacute;fono: <?php echo $user[0]['telefono'];?></strong></td>

<td colspan="3" rowspan="2"  align="right" valign="top"><strong>
  <?php if (strlen($_POST['agencia'])>0){
	echo $agencia[0]['nombre'] ." - ".$agencia[0]['direccion'];
	} else { echo $_POST['direccion'];	}?>
</strong></td>
</tr>

<tr>
<td colspan="3" align="left" valign="top" width="60%"><strong>Correo: <?php echo $user[0]['correo'];?></strong></td>

</tr>

<tr>
<td colspan="3" align="left"></td>

<td colspan="3"  align="right"><strong><?php echo "Persona contacto: " . $_POST['persona'];	?></strong></td>
</tr>

<tr>
<td colspan="3" align="left"></td>

<td colspan="3"  align="right"><strong><?php echo "Telf: ". $_POST['telefono'];	?></strong></td>
</tr>

<tr><td colspan="6">&nbsp;</td></tr>
<tr><td colspan="6" bgcolor="#999999" style="height:1px;"></td></tr>
<tr><td colspan="6">&nbsp;</td></tr>

<tr>  <td align="center"></td>
<td  align="center"><strong>Modelo</strong></td>

    <td  align="center"><strong>Talla</strong></td>
    <td  align="center"><strong>Cantidad</strong></td>
    <td  align="right" width="20%"><strong>Precio Unitario</strong></td>
<td  align="right" width="20%"><strong>Total</strong></td>

  </tr>
  <?php $subtotal=0; $total=0;$preference_data['items'] = array(); $peso=0;$total_seguro=0;
  for ($i=0;$i<$n;$i++):

	if ($cantidad[$i]==0)  :
		continue;
	endif;
  $obj->load($newzapato[$i]);
  $size->load($newtalla[$i]);
  $precio= $obj->loadTallaProd($newzapato[$i],$newtalla[$i]);
  $objColor->load($colores[$i]);

  	if (strlen($obj->info[0]['descuento'])>0) {
		$porcentaje =(100 - intval(preg_replace('/[^0-9]+/', '', $obj->info[0]['descuento']), 10))/100;
	} else {
		$porcentaje =1;
	}
	$elprecio=$precio[0]['precio']*$porcentaje;
  ?>

  <tr>

    <td width="10%"><img  src="../images/producto/thumb/<?php echo $obj->info[0]['thumb']; ?>" width="100%"></td>
    <td  align="center"><?php echo $obj->info[0]['nombre']; ?></td>
    <td align="center"><?php echo $size->info[0]['name']; ?></td>
    <td align="center"><?php echo $cantidad[$i]; ?></td>
    <td align="right">Bs. <?php echo number_format($elprecio,2); ?>
    <?php  $subtotal=$elprecio*$cantidad[$i];
	$seguro=$subtotal*$bolsa[0]['seguro'];
	$total_seguro+=$seguro;
	$total+=$subtotal;
	$peso+=$precio[0]['peso']; ?></td>
 <td align="right">Bs. <?php echo number_format($subtotal,2); ?></td>



 </tr>

  <?php  endfor;
  tep_db_connect();
  $tarifa=searchList("hasta > '".$peso."' and local='".$ruta->info[0]['local']."'","hasta",0,NULL,"*", TABLE_TARIFA);
  tep_db_close();
  $costoBolsa=$bolsa[0]['costo']*$_SESSION['articulos'];
   $costoEnvio=$tarifa[0]['precio']+$tarifa[0]['franqueo']+$tarifa[0]['iva']+$costoBolsa+$total_seguro;

  ?>
     <tr>    <td ></td> <td ></td><td ></td> <td ></td>
    <td  align="right"><strong>Sub-total Bs.</strong></td>
<td  align="right"><strong><?php echo number_format($total,2);  ?></strong></td>

  </tr>
   <tr>    <td ></td> <td ></td><td ></td> <td ></td>
    <td  align="right"><strong>Costo Envio Bs.</strong></td>
<td  align="right"><strong><?php echo number_format($costoEnvio,2);  ?></strong></td>

  </tr>
  <tr>
     <td ></td> <td ></td><td ></td> <td ></td>
    <td  align="right"><strong>Total Bs.</strong></td>
<td  align="right"><strong>
  <?php $total+=$costoEnvio; echo number_format($total,2); ?>
</strong></td>

  </tr>
    <tr><td></td><td></td><td></td><td></td><td></td><td >&nbsp;</td></tr>
   <tr><td colspan="7"><?php
 if ((!isset($_SESSION['pedidoenviado'])) || ($_SESSION['pedidoenviado']!='ok')):
  $_SESSION['tarifa']=$costoEnvio;
  $_SESSION['subtotal']=$total-$costoEnvio;
   $_SESSION['estado']= $estado[0]['city_name'];
  $_SESSION['ciudad']=$ruta->info[0]['ciudad'];
  $_SESSION['telefono']=$_POST['telefono'];
  $_SESSION['persona']=$_POST['persona'];
   $_SESSION['cedula']=$_POST['cedula'];
  if (strlen($_POST['agencia'])>0){
	  $_SESSION['direccion']=$agencia[0]['nombre'] ." - ".$agencia[0]['direccion'];
  } else {
    $_SESSION['direccion']=$_POST['direccion'];
  }
  ?>

  <input name="terminos" id="terminos" type="checkbox" value="1" onClick="javascript: aceptar();"> Acepto los <a href="terminos.pdf" target="_blank">t&eacute;rminos y condiciones</a> para proceder al pago en l&iacute;nea.
  <br><br>
 <br>
 <?php endif;

 if ((isset($_SESSION['pedidoenviado'])) && ($total>=0) && ($_SESSION['pedidoenviado']=='ok')): ?>
 Tu pedido ha sido enviado, pronto recibir&aacute;s nuestro correo con los pasos a seguir<br>
  <?php endif; ?></td></tr>
     <tr><td></td><td></td><td></td><td></td><td></td><td >&nbsp;</td></tr>
       <tr><td></td><td></td><td></td><td></td><td></td><td >&nbsp;</td></tr>
         <tr><td></td><td></td><td><a href="enviarpedido.php" class="btn_generar_orden" id="enviarpedido" style="visibility:hidden"></a> </td>
           <td>&nbsp;</td>
           <td><a href="borrar.php" class="btn_borrar_orden"></a></td><td >&nbsp;</td></tr>
</table>
<br></div></div>
            <?php else: ?>
            <div style="width:100%; text-align:center">
            <img src="../images/botones/carrito.jpg" width="325" height="387" >
            </div>
            <?php endif; ?>
		</div> <!--fin container -->
<?php include "footer.php"; ?>
	</div>       <!-- fin wrapper -->

</body>
</html>
