<?php include "cabecera.php";

?>
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
<div style="height:300px;" >
    <div id="resultado" style="display:block; padding:0px;">Procesar Pago <br><p style="margin-top:10px""><a href="pagoenlinea.php?orden=<?php echo $_SESSION['orden'];?>" class="btn_deposito2" ></a></p><br><p style="margin-top:10px""><a href="pagocontarjeta.php?orden=<?php echo $_SESSION['orden'];?>" class="btn_tarjeta2"></a></p></div>
	</div>
 <?php  exit();$peden=0;
 if ((isset($_SESSION['pedidoenviado']))&&($_SESSION['pedidoenviado']=='no')):
			 $_SESSION['pedidoenviado']="";  $peden=1; ?>
       <div style="height:300px;" >
	<div onClick="javascript:window.location.href='mispedidos.php'" id="resultado" style="display:block;">Su solicitud no pudo ser procesada<br>No cierres la sesi&oacute;n e intenta m&aacute;s tarde</div>
	</div><?php endif;
		if ((isset($_SESSION['pedidoenviado']))&&($_SESSION['pedidoenviado']=='ok')):
			 $_SESSION['pedidoenviado']="";  $peden=1; ?>
          <div style="height:300px;" >
    <div id="resultado" style="display:block;">Procesar Pago<br> <a href="pagoenlinea.php?orden=<?php echo $_SESSION['orden'];?>" style="color: #FFF;" >DEP&Oacute;SITO/TRANSFERENCIA</a><br><p style="margin-top:10px""><a href="pagocontarjeta.php?orden=<?php echo $_SESSION['orden'];?>" style="color: #FFF;">TARJETA DE CR&Eacute;DITO</a></p></div>
	</div><?php endif; ?>
<div id="intwrapper" <?php echo ($peden==1) ? 'style="display:none;"':''; ?> >
  <span class="titulo">MIS PEDIDOS</span><br>
 <?php
	if ($npd>0):
	  for ($k=0;$k<$npd;$k++):
	  set_time_limit(20);
	  	$pedidos->loadItems($pedidos->infoPedidos[$k]['id']);
		$nitems=count($pedidos->items);
		if ($nitems==0) continue;
		?>

        <table width="100%" border="0" class="descripcion">

        <tr><td colspan="4" ><strong>Orden No. <?php echo $pedidos->infoPedidos[$k]['id'];?></strong><br></td></tr>
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
    		<td width="40%" rowspan="6" style="padding-right:20px;" id-"imgProdPedido"><img  src="../images/producto/thumb/<?php echo $obj->info[0]['thumb']; ?>" width="100%"></td>
	 		<td colspan="3" style="font-size:1.1em;font-weight:300; color:#999999;"><?php echo $obj->info[0]['nombre'];  $subtotal=$elprecio*$pedidos->items[$i]['cantidad']; $total+=$subtotal;?></td>
  		</tr>
        <tr><td colspan="3" style="line-height:1.3em">C&oacute;digo: <span style="color:#999999;"><?php echo $obj->info[0]['codigo']; ?></span></td></tr>
  		<tr><td colspan="3" style="line-height:1.3em">Cant: <?php echo $pedidos->items[$i]['cantidad']; ?></td></tr>
  		<tr><td colspan="3" style="line-height:1.3em">Talla: <?php echo $size->info[0]['name']; ?></td></tr>
  		<tr><td colspan="3" style="line-height:1.3em">BsF.<?php echo number_format($subtotal,2); ?></td></tr>
  		<tr><td  colspan="3"></td></tr>
    	<tr><td colspan="3" style="background-color:#CCC; height:1px;"></td></tr>
  <?php  endfor; ?>
		<tr><td colspan="4" >&nbsp;</td></tr>
		<tr>
    		<td  align="center" class="tienda" style="padding-right:20px;font-size:1.2em;">Subtotal</td>
 			<td colspan="3"  align="center" class="tienda"  style="font-size:1.2em;">BsF. <?php echo number_format($total,2); ?></td>
   		</tr>
 <tr>

    <td colspan="2" align="left" height="60" valign="bottom" width="50%"><a href="pagoenlinea.php?orden= <?php echo $pedidos->infoPedidos[$k]['id'];?>" class="btn_deposito" style="color: rgba(0, 144, 158, 1);" >DEP&Oacute;SITO<br>TRANSFERENCIA</a></td>
    <td width="50%" height="60" colspan="2"   align="left" valign="bottom"><a href="pagocontarjeta.php?orden= <?php echo $pedidos->infoPedidos[$k]['id'];?>" class="btn_tarjeta" style="color: rgba(0, 144, 158, 1);">TARJETA<br>DE CR&Eacute;DITO</a></td>
  </tr>
         <tr><td colspan="4" >&nbsp;</td></tr><tr><td colspan="4" >&nbsp;</td></tr>       </table>


	<?php endfor;
	endif;

     if ($x>0): ?>
	 <table width="100%" border="0" class="descripcion" >
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
        <form id="formulario<?php echo $i; ?>" action="editar.php" method="post" target="_self" class="myform">
  		<tr>
    		<td width="40%" rowspan="6" style="padding-right:20px;"><img  src="../images/producto/thumb/<?php echo $obj->info[0]['thumb']; ?>" width="100%"></td>
	 		<td colspan="3" style="font-size:1.1em;font-weight:300; color:#999999;"><?php echo $obj->info[0]['nombre'];  $subtotal=$elprecio*$cantidad[$i]; $total+=$subtotal;?></td>
  		</tr>
        <tr><td colspan="3" style="line-height:1.3em">C&oacute;digo: <span style="color:#999999;"><?php echo $obj->info[0]['codigo']; ?></span></td></tr>

  		<tr>

    		<td colspan="3" style="line-height:1.3em">Cant.
      		<select name="cantidad" id="cantidad" class="myselect" >
        		<?php for ($j=0;$j<$precio[0]['cantidad']; $j++) {
				$k=$j+1; ?>
        		<option value="<?php echo $k; ?>" <?php echo ($k==$cantidad[$i]) ? 'selected="selected"' : ''; ?>><?php echo $k; ?></option>
       		 <?php } ?>
     		 </select></td>
  		</tr>
  		<tr>
    		<td colspan="3" style="line-height:1.3em">Talla <?php echo $size->info[0]['name']; ?></td>
  		</tr>
  		<tr>
    		<td colspan="3" style="line-height:1.3em">BsF.<?php echo number_format($subtotal,2); ?></td>
  		</tr>
  		<tr>
   		 	<td  colspan="3"><input name="id" type="hidden" value="<?php echo $i; ?>">
            <input type="image" src="../images/movil/btn_p_edicion.png" value="" width="20" height="20" style="border: 0px solid #FFF; margin-bottom:10px; margin-top:10px; float:left;"><a href="eliminar.php?id=<?php echo $i; ?>" target="_self" ><img src="../images/movil/btn_p_borrar.png" width="20" height="20" style="margin-bottom:10px; margin-top:10px; margin-left:12px; float:left;"></a></td>


  		</tr>
	</form>
    	<tr>
    		<td colspan="3" style="background-color:#CCC; height:1px;"></td>
		</tr>
  <?php  endfor; ?>
		<tr>
    		<td  >&nbsp;</td>
 			<td></td>
   		</tr>
		<tr>
    		<td  align="center" style="padding-right:20px;" class="tienda">Subtotal</td>
 			<td colspan="2"  align="center" class="tienda">BsF. <?php echo number_format($total,2); ?></td>
   		</tr>
 </table>

 <div class="fondoCampo" style="margin-top:10px;"> <p class="descripcion" ><a href="borrar.php" class="boton">Borrar Orden</a></p></div>
<div class="fondoCampo" style="margin-top:2px;"> <p class="descripcion" ><a href="despacho.php" id="enviarpedido" class="boton" >Enviar</a></p></div>

<br>

 <?php endif;
  if (($npd==0) && ($x==0)) : ?>

      <img src="../images/botones/carrito.jpg" width="100%">
 <?php endif; ?>

</div>       <!-- fin wrapper -->
</div>
<script src="../js/script.js"></script>
</body>
</html>
