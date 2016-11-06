<?php include "cabecera.php";
	if (!isset($_SESSION['user'])){?>
    <script>
		window.location.href='resultado.php?e=1';
		</script>
<?php
		exit();
	}
	include "../include/class/pedidos.php";
	include "../include/class/usuario.php";

	settype($_GET['orden'],"int");
	$pedido=new pedidos();
	$pedido->loadPedidoUsuario($_GET['orden'],$_SESSION['user']);
	if (count($pedido->info)==0) {?>
    <script>
		window.location.href='resultado.php?e=2';
		</script>
<?php
	}

	$pedido->pedidoUsuarioActivo($_GET['orden'],$_SESSION['user']);
if (count($pedido->info)==0){?>
    <script>
		window.location.href='resultado.php?e=7';
		</script>
<?php
}

	$_SESSION['orden']=$_GET['orden'];
?>
     <script>
		function enviarDatos(){
			document.forms["contacto"].submit();
		}
	</script>

<body>
<?php include "menu.php"; ?>
<div id="wrapper">
<div id="intwrapper">
	<section id="centro">
	<form  id="contacto" name="contacto" action="https://calzadosamano.com/movil/pagotarjeta.php" method="post" target="_blank">
<table width="100%" border="0" id="registro" name="registro" style="color:#009999;" >
  <tr>
    <td > Subtotal a pagar</td>
    <td colspan="2" style="color:#999999;padding-left:20px;"><?php echo "BsF. " .number_format($pedido->info[0]['tot_zapato'],2); ?></td>
  </tr>
  <tr>
    <td >Env&iacute;o</td>
    <td colspan="2" style="color:#999999;padding-left:20px;"><?php echo "BsF. " .number_format($pedido->info[0]['tot_envio'],2); ?></td>
  </tr>
  <tr>
    <td >Total a pagar</td>
    <td colspan="2" style="color:#999999;padding-left:20px;"><?php $total=$pedido->info[0]['tot_zapato']+$pedido->info[0]['tot_envio']; echo "Bs.F " .number_format($total,2); ?></td>
  </tr>
  <tr>
    <td align="right">N&uacute;mero de Orden</td>
    <td style="color:#999999;padding-left:20px;"><?php echo $pedido->info[0]['id']; ?></td>
    <td rowspan="3" align="left" style="color:#999999;padding-left:20px;"><img src="../images/codigo.png" width="78" height="78" style="margin-left:-15px; visibility:hidden;" id="codigocvc"/></td>
  </tr>
</table>
<input name="CardNumber" type="text" value="" maxlength="16" placeholder="*N&uacute;mero de Tarjeta"/></td>
<input name="CVC" type="password" value="" maxlength="3" onFocus="javascript: document.getElementById('codigocvc').style.visibility='visible'" onBlur="javascript: document.getElementById('codigocvc').style.visibility='hidden'" placeholder="* Cod. Seguridad"/>
<span style=" font-size:1.3em">Vencimiento </span>
  <select name="mes" style="width:61px">
      <option>Mes</option>
      <option value="01">Enero</option>
      <option value="02">Febrero</option>
      <option value="03">Marzo</option>
      <option value="04">Abril</option>
      <option value="05">Mayo</option>
      <option value="06">Junio</option>
      <option value="07">Julio</option>
      <option value="08">Agosto</option>
      <option value="09">Septiembre</option>
      <option value="10">Octubre</option>
      <option value="11">Noviembre</option>
      <option value="12">Diciembre</option>
    </select>

     <?php $y=date('Y'); ?>
        <select name="ano"  style="width:61px">
          <option>A&ntilde;o</option>
          <?php for ($j=$y;$j<($y+10);$j++){ ?>
          <option value="<?php echo $j;?>"><?php echo $j;?></option>
          <?php } ?>
        </select>
<input name="CardHolder" type="text" value="" placeholder="*Nombre del Tarjetahabiente"/></td>
<input name="Cedula" type="text" value="" maxlength="8" placeholder="*C&eacute;dula o Rif"/></td>
<table width="100%"  id="registro" name="registro" border="0"  style="color:#009999;" >
  <tr>
    <td align="right">Acepto los <a href="terminos.pdf" target="_blank" >t&eacute;rminos y condiciones</a></td>
    <td style="color:#999999;padding-left:20px;" width="60" ><input name="acepto" id ="acepto" type="checkbox" value="1" checked></td>
  </tr>
</table>
 <div class="fondoCampo"> <p class="descripcion" ><a  href="javascript: enviarDatos();"  class="boton">Enviar</a></p></div><br>

Esta transacci&oacute;n ser&aacute;
procesada de forma segura gracias a la plataforma de:<br><br>
<img src="../images/movil/instapago_logo.jpg" style="float:left;"  /><img src="../images/movil/banesco_logo.jpg"  style="float:right;" />

<input name="KeyId" type="hidden" value="BBEEE96C-0283-41C4-9035-5500A6508813" />
<input name="PublicKeyId" type="hidden" value="fadc5705728b15c0205b1bd8232c436e" />
<input name="Amount" type="hidden" value="<?php echo $total; ?>"/>
<input name="idFactura" type="hidden" value="<?php echo $pedido->info[0]['id']; ?>"/>
<input name="Description" type="hidden" value="Orden de Compra <?php echo $pedido->info[0]['id']; ?>"/>
<input name="IP" type="hidden" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" />
</form>

</section>

 </div>  <!-- fin intwrapper -->
</div>       <!-- fin wrapper -->
 <?php if ((isset($_GET['pagar'])) && ($_GET['pagar']=='1')) : ?>
  	<script>
 	   document.getElementById('centro').style.display="none";
 		document.getElementById('resultado').style.display="block";
 	</script>
  <?php endif; ?>
<script src="../js/script.js"></script>
</body>
</html>
