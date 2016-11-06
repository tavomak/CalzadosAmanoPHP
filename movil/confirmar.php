<?php include "cabecera.php";
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
	$objColor=new color(); ?>

    <script>


function aceptar(){
	if (document.getElementById('terminos').checked){
		document.getElementById("enviarpedido").style.visibility="visible";
	}else{
		document.getElementById("enviarpedido").style.visibility="hidden";
	}
}
</script>

<body>
<?php $activalo='1'; include "menu.php"; ?>
<div id="wrapper">
 <?php if ((isset($_SESSION['pedidoenviado'])) && ($total>=0) && ($_SESSION['pedidoenviado']=='ok')): ?>
 <div style="height:300px;" >
<div id="resultado" style="display:block;"> Tu pedido ha sido enviado, pronto recibir&aacute;s nuestro correo con los pasos a seguir</div>
 </div> <?php endif; ?>
<div id="intwrapper">
<?php  if (($n>0)&&($x>0)): ?>
	<span class="titulo">MIS PEDIDOS</span><br>


	<strong>Solicitud: <?php echo $user[0]['nombre'];?></strong><br>
    <strong>Tel&eacute;fono: <?php echo $user[0]['telefono'];?></strong><br>
	<strong>Correo: <?php echo $user[0]['correo'];?></strong><br><br>
    <strong>Datos para el despacho</strong><br>
    <strong><?php echo $estado[0]['city_name']."-".$ruta->info[0]['ciudad'];	?></strong><br>
    <strong>
  <?php if (strlen($_POST['agencia'])>0){
	echo $agencia[0]['nombre'] ." - ".$agencia[0]['direccion'];
	} else { echo $_POST['direccion'];	}?></strong><br>
	<strong><?php echo "Persona contacto: " . $_POST['persona'];	?></strong><br>
	<strong><?php echo "Telf: ". $_POST['telefono'];	?></strong><br><br>
	 <table width="100%" border="0" class="descripcion">
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

  $subtotal=$elprecio*$cantidad[$i];
  $seguro=$subtotal*$bolsa[0]['seguro'];
  $total_seguro+=$seguro;
  $total+=$subtotal;
  $peso+=$precio[0]['peso'];
  $articulos+=$cantidad[$i]; ?>
  		<tr>
			<td width="40%" rowspan="5" style="padding-right:20px;"><img  src="../images/producto/thumb/<?php echo $obj->info[0]['thumb']; ?>" width="100%"></td>
			<td colspan="3"><h1><?php echo $obj->info[0]['nombre']; ?></h1></td>
  		</tr>
        <tr><td colspan="3" style="line-height:1.3em">C&oacute;digo <?php echo $obj->info[0]['codigo']; ?></td></tr>
  		<tr><td colspan="3" style="line-height:1.3em">Cant. <?php echo $cantidad[$i]; ?></td></tr>
  		<tr><td colspan="3" style="line-height:1.3em">Talla <?php echo $size->info[0]['name']; ?></td></tr>
  		<tr><td colspan="3" style="line-height:1.3em">BsF.<?php echo number_format($subtotal,2); ?></td>	</tr>
     	<tr><td colspan="3" style="background-color:#CCC; height:1px;"></td></tr>
  <?php  endfor; ?>
		<tr>
    		<td  >&nbsp;</td>
 			<td></td>
   		</tr>
 <?php
 $_SESSION['articulos']=$articulos;
  tep_db_connect();
  $tarifa=searchList("hasta > '".$peso."' and local='".$ruta->info[0]['local']."'","hasta",0,NULL,"*", TABLE_TARIFA);
  tep_db_close();
  $costoBolsa=$bolsa[0]['costo']*$_SESSION['articulos'];
   $costoEnvio=$tarifa[0]['precio']+$tarifa[0]['franqueo']+$tarifa[0]['iva']+$costoBolsa+$total_seguro;
    $_SESSION['datosTarifa']=$tarifa;
 ?>
		<tr>
    		<td  align="right" style="padding-right:20px;" >Subtotal</td>
 			<td colspan="2" >BsF. <?php echo number_format($total,2); ?></td>
   		</tr>
        <tr>
    		<td  align="right" style="padding-right:20px;" >Env&iacute;o </td>
 			<td colspan="2" >BsF. <?php echo number_format($costoEnvio,2); ?></td>
   		</tr>
        <tr>
    		<td  align="right" style="padding-right:20px;" >Total </td>
 			<td colspan="2" >BsF. <?php $total+=$costoEnvio; echo number_format($total,2); ?></td>
   		</tr>
        <tr><td colspan="3" class="tienda">&nbsp;</td></tr>
   <tr><td colspan="3"><?php
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

  <input name="terminos" id="terminos" type="checkbox" value="1" onClick="javascript: aceptar();"> <span >Acepto los <a href="terminos.pdf" target="_blank">t&eacute;rminos y condiciones</a> para proceder al pago en l&iacute;nea.</span>

 <br>
 <?php endif; ?>

</td></tr>
  </table>

 <div class="fondoCampo" style="margin-top:10px;"> <p class="descripcion" ><a href="borrar.php" class="boton">Borrar Orden</a></p></div>
<div class="fondoCampo" id="enviarpedido" style=" visibility:hidden;"> <p class="descripcion" ><a href="enviarpedido.php"  class="boton">Enviar</a></p></div>

<?php else: ?>
	<img src="../images/botones/carrito.jpg" width="100%">
<?php endif;  ?>
</div>       <!-- fin wrapper -->
</div>
<script src="../js/script.js"></script>
</body>
</html>
