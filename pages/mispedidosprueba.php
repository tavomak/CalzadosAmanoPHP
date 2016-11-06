<?php session_start();
	if (!isset($_SESSION['user'])){
		header('location: iniciar.php');
		exit();
	}

	include "../include/configure.php";
	include "../include/database_tables.php";
	include "../include/functions/database.php";
	include "../include/class/producto.php";
	include "../include/class/talla.php";
	include "../include/class/usuario.php";
	include "../include/class/color.php";
	include "../include/class/pedidos.php";

	tep_db_connect();
	$user =	searchList("id='" .$_SESSION['user'] . "'",NULL,0,NULL,"*", TABLE_USUARIO);
	tep_db_close();

	$newzapato=$_SESSION['zapato'];
	$newtalla=$_SESSION['talla'];
	$cantidad=$_SESSION['cantidad'];
	$precio=$_SESSION['precio'];
	$preciosel=$_SESSION['precio'];
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

//Verificar si tiene pedido por pagar
	$pedidos = new pedidos();
	$pedidos->loadPedidos($_SESSION['user']);
	$npd=count($pedidos->infoPedidos);
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
    	<div id="intwrapper" style="height:auto;">
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

        <?php
		 if ((isset($_SESSION['pedidoenviado']))&&($_SESSION['pedidoenviado']=='no')):
			 $_SESSION['pedidoenviado']="";  ?>
			  <div onClick="javascript:window.location.href='mispedidos.php'" style="width:100%; height:90px; padding-top:50px; color:#FFF; background-color:#009999; position:absolute; top:50%; left:0; margin-top:-50px; z-index:999;  font-family: 'Open Sans Condensed', sans-serif; font-size:48px; text-align:center; line-height:24px; padding-bottom:30px; display:block;">Su solicitud no pudo ser procesada<br><br>No cierres la sesi&oacute;n e intenta m&aacute;s tarde</div>

		<?php endif;
		if ((isset($_SESSION['pedidoenviado']))&&($_SESSION['pedidoenviado']=='ok')):
			 $_SESSION['pedidoenviado']=""; ?>
        <div onClick="javascript:window.location.href='mispedidos.php'" style="width:100%; height:90px; padding-top:50px; color:#FFF; background-color:#009999; position:absolute; top:50%; left:0; margin-top:-50px; z-index:999;  font-family: 'Open Sans Condensed', sans-serif; font-size:48px; text-align:center; line-height:24px; padding-bottom:30px; display:block;">Procesar Pago<br><br> <a href="pagoenlinea.php?orden=<?php echo $_SESSION['orden'];?>" class="btn_deposito" style="margin-right:20px;"></a><a href="pagocontarjeta.php?orden=<?php echo $_SESSION['orden'];?>" class="btn_tarjeta"></a></div>

</div>
		<?php endif;

	if ($npd>0):
	  for ($k=0;$k<$npd;$k++):
	  	$pedidos->loadItems($pedidos->infoPedidos[$k]['id']);
		$nitems=count($pedidos->items);
		if ($nitems==0) continue;
	  ?>
		<div id="centroPedido" >
           <div id="datos">
              <table width="100%" >
                <tr>
    			<td  colspan="3"><strong>Orden No. <?php echo $pedidos->infoPedidos[$k]['id'];?></strong><br></td>
 				<td ></td> <td ></td>	<td ></td>
  				</tr>
  			  <tr>
    			<td align="center"></td>
				<td align="center" width="19%"><strong>Modelo</strong></td>
    			<td width="6%"  align="center"><strong>Talla</strong></td>
				<td width="20%"  align="center"><strong>Cantidad</strong></td>
    			<td   width="15%" align="right"><strong>Precio Unitario</strong></td>
				<td width="15%"   align="right"><strong>Total</strong></td>


  			  </tr>
  			  <?php $subtotal=0; $total=0;
  			for ($i=0;$i<$nitems;$i++):
  				$obj->load($pedidos->items[$i]['id_producto']);
  				$size->load($pedidos->items[$i]['talla']);
  				$precio= $obj->loadTallaProd($pedidos->items[$i]['id_producto'],$pedidos->items[$i]['talla']);
  				if ($precio[0]['precio']==0):
					continue;
				endif;
				if (strlen($obj->info[0]['descuento'])>0) {
					$porcentaje =(100 - intval(preg_replace('/[^0-9]+/', '', $obj->info[0]['descuento']), 10))/100;
				} else {
					$porcentaje =1;
				}
				$elprecio=$precio[0]['precio']*$porcentaje;
  				?>
  				<tr>
    			<td width="7%"><img  src="../images/producto/thumb/<?php echo $obj->info[0]['thumb']; ?>" width="100%"></td>
	 			<td align="center"><?php echo $obj->info[0]['nombre']; ?></td>
    			<td align="center"><?php echo $size->info[0]['name']; ?></td>
				<td align="center"><?php echo $pedidos->items[$k]['cantidad']; ?></td>
				<td  align="right">Bs. <?php echo number_format($elprecio,2);
				$subtotal=$elprecio*$pedidos->items[$k]['cantidad']; $total+=$subtotal; ?></td>
 				<td  align="right">Bs. <?php echo number_format($subtotal,2); ?></td>
  				</tr>
  			<?php  endfor; ?>
    			<tr>
    			<td  align="center" style="height:1px;"></td>
 				<td ></td>	<td ></td> 			<td></td>
    			<td></td><td  align="center" style="background-color:#999;"></td>
  				</tr>
   				<tr>
    			<td  style="height:1px;"></td>
 				<td ></td>	<td ></td>		<td ></td>	<td ></td>	<td ></td>
  				</tr>
  				<tr>
   				<td ></td> <td ></td>    <td ></td><td></td>
    			<td  align="right"><strong>Subtotal</strong></td>
				<td   align="right"><strong>Bs. <?php echo number_format($total,2); ?></strong></td>

  				</tr>
  				<tr>
    			<td ></td>
    <td colspan="3" align="left" height="60" valign="bottom"><a href="pagoenlinea.php?orden= <?php echo $pedidos->infoPedidos[$k]['id'];?>" class="btn_deposito" ></a></td>
    <td height="60" colspan="2"   align="left" valign="bottom"><a href="pagocontarjeta.php?orden= <?php echo $pedidos->infoPedidos[$k]['id'];?>" class="btn_tarjeta"></a></td>
  </tr>
                </table>
              </div>
            </div>
	<?php endfor;
	endif;
		if ($x>0): ?>

			<div id="centroPedido"  >
            	<div id="datos">
                <table width="100%" border="0">

  <tr>

    <td align="center"></td>
<td align="center" width="19%"><strong>Modelo</strong></td>
    <td width="6%"  align="center"><strong>Talla</strong></td>
<td width="20%"  align="right"><strong>Cantidad</strong></td>
    <td colspan="2"  align="right"><strong>Precio Unitario</strong></td>
<td width="19%" colspan="2"  align="right"><strong>Total</strong></td>
<td  align="center">&nbsp;</td>
    <td width="4%" ></td>

    <td width="4%" ></td>

  </tr>

  <?php $subtotal=0; $total=0;
  for ($i=0;$i<$n;$i++):

	if ($cantidad[$i]==0) :
		continue;
	endif;
  $obj->load($newzapato[$i]);
  $size->load($newtalla[$i]);
  $precio= $obj->loadTallaProd($newzapato[$i],$newtalla[$i]);
  	if ($precio[0]['precio']==0):
		continue;
	endif;
	$objColor->load($colores[$i]);

	if (strlen($obj->info[0]['descuento'])>0) {
		$porcentaje =(100 - intval(preg_replace('/[^0-9]+/', '', $obj->info[0]['descuento']), 10))/100;
	} else {
		$porcentaje =1;
	}
	$elprecio=$precio[0]['precio']*$porcentaje;
  ?>

  <tr> <form id="formulario<?php echo $i; ?>" action="editar.php" method="post" target="_self">

    <td width="7%"><img  src="../images/producto/thumb/<?php echo $obj->info[0]['thumb']; ?>" width="100%"></td>
	 <td align="center"><?php echo $obj->info[0]['nombre']; ?></td>
    <td align="center"><?php echo $size->info[0]['name']; ?></td>
<td align="right"><select name="cantidad" id="cantidad" >
  <?php
  for ($j=0;$j<$precio[0]['cantidad']; $j++) {
	$k=$j+1; ?>
  <option value="<?php echo $k; ?>" <?php echo ($k==$cantidad[$i]) ? 'selected="selected"' : ''; ?>><?php echo $k; ?></option>
  <?php } ?>

  </select></td>

<td colspan="2" align="right">Bs. <?php echo number_format($elprecio,2); ?>
    <input name="id" type="hidden" value="<?php echo $i; ?>">
    <?php  $subtotal=$elprecio*$cantidad[$i];
	$total+=$subtotal; ?></td>
 <td colspan="2" align="right">Bs. <?php echo number_format($subtotal,2); ?></td>
 <td align="right" width="4%" >&nbsp;</td>
     <td w align="right"><input type="image" src="" value="" width="20" height="20" class="btn_editar" style="border: 0px solid #FFF"></td>

    <td align="right"><a href="eliminar.php?id=<?php echo $i; ?>" target="_self" class="btn_eliminar"></a></td>

   </form>

  </tr>

  <?php  endfor; ?>
    <tr>

    <td  align="center" style="height:1px;"></td>
 <td  align="center"></td>
    <td  align="center"></td>
    <td align="center"></td>
    <td width="4%"  align="center" ></td>
    <td></td><td colspan="2" align="center" style="background-color:#999;"></td>
    <td align="center"></td><td align="center"></td><td align="center"></td>

  </tr>
   <tr>

    <td  align="center" style="height:1px;"></td>
 <td  align="center"></td>
    <td  align="center"></td>
<td align="center"></td>
    <td  align="center" ></td>
    <td  align="center" ></td>
    <td  align="center" ></td>
    <td  align="center" ></td>
<td  align="center"></td>
    <td ></td>

    <td >&nbsp;</td>

  </tr>
  <tr>

    <td  align="center"></td>
 <td  align="center"></td>
    <td  align="center"></td>
<td align="center"></td>
    <td colspan="2"  align="right"><strong>Subtotal</strong></td>
<td colspan="2"  align="right"><strong>Bs. <?php echo number_format($total,2); ?></strong></td>
<td  align="center">&nbsp;</td>
    <td ></td>

    <td ></td>

  </tr>
  <tr>
    <td  align="center"></td>
    <td  align="center"></td>
    <td  align="center"></td>
    <td colspan="3" align="center" height="60" valign="bottom"><a href="despacho.php" class="btn_enviar" id="enviarpedido" style="float:right; margin-right:80px;" ></a>
</td>
    <td height="60" colspan="2"  align="right" valign="bottom"><a href="borrar.php" class="btn_borrar_orden" style="float:left;"></a></td>
    <td  align="center"></td>
    <td ></td>
    <td ></td>
  </tr>
                </table>
<br>
 <br><br><br>

              </div>
                <div>
              </div>

            </div>
 <?php else:  ?>
            <div style="width:100%; text-align:center">
            <img src="../images/botones/carrito.jpg" width="325" height="387" >
            </div>
            <?php endif; ?>
		</div> <!--fin container -->

<?php include "footer.php"; ?>

	</div>       <!-- fin wrapper -->


</body>

</html>
