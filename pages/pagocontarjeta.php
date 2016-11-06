<?php session_start();
	if (!isset($_SESSION['user'])){
		header('location: resultado.php?e=1');
		exit();
	}
	include "../include/configure.php";
	include "../include/database_tables.php";
	include "../include/functions/database.php";
	include "../include/class/pedidos.php";
	include "../include/class/usuario.php";

	settype($_GET['orden'],"int");
	$pedido=new pedidos();
	$pedido->loadPedidoUsuario($_GET['orden'],$_SESSION['user']);
	if (count($pedido->info)==0) {
		header('location: resultado.php?e=2');
	}

	$pedido->pedidoUsuarioActivo($_GET['orden'],$_SESSION['user']);
if (count($pedido->info)==0){
	header('location: resultado.php?e=7');
}

	$_SESSION['orden']=$_GET['orden'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Calzados A'mano</title>
	<meta name="description" content="Calzados A'mano" />
	<meta name="keywords" content="Calzados A'mano" />
	<link rel="shortcut icon" href="../favicon.ico">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="../css/basic.css" />
    <link rel="stylesheet" type="text/css" href="../css/contacto.css" />
    <link rel="stylesheet" type="text/css" href="../css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="../css/menu.css">
     <style>
	 input, select, textarea { margin-left:1.5em}
	 </style>
     <script>
		function enviarDatos(){
			document.forms["contacto"].submit();
		}

	</script>

</head>

<body>
<div id="resultado" style="line-height:24px; padding-bottom:30px; "><a href="javascript: despejar();">Su solicitud ha sido enviada<br><br>Te enviamos un correo con toda la informaci&oacute;n para procesar tu pago</a></div>
	<div id="wrapper">
    	<div id="intwrapper">
        	<header>
         <div id="logo"><a href="../index.php"><img src="../images/logo.png" width="207" height="66"></a></div>
        	<?php include "redes.php"; ?>
                <div class="separador" style="margin-top:15px; margin-bottom:5px;"></div>
                <nav id="menu">
                 <?php $pages=$_SERVER['PHP_SELF'];
				include "menu.php"; ?>
                </nav>
            </header>

		<div class="container" align="center" >
        	<section id="centro">
<form  id="contacto" name="contacto" action="https://calzadosamano.com/pages/pagotarjeta.php" method="post" target="_blank">
<table width="100%" border="0" id="registro" name="registro" style="color:#009999;" >
  <tr>
    <td align="right"  > Subtotal a pagar</td>
    <td colspan="2" style="color:#999999;padding-left:20px;"><?php echo "BsF. " .number_format($pedido->info[0]['tot_zapato'],2); ?></td>
  </tr>
  <tr>
    <td align="right">Env&iacute;o</td>
    <td colspan="2" style="color:#999999;padding-left:20px;"><?php echo "BsF. " .number_format($pedido->info[0]['tot_envio'],2); ?></td>
  </tr>
  <tr>
    <td align="right">Total a pagar</td>
    <td colspan="2" style="color:#999999;padding-left:20px;"><?php $total=$pedido->info[0]['tot_zapato']+$pedido->info[0]['tot_envio']; echo "BsF. " .number_format($total,2); ?></td>
  </tr>
  <tr>
    <td align="right">N&uacute;mero de Orden</td>
    <td style="color:#999999;padding-left:20px;"><?php echo $pedido->info[0]['id']; ?></td>
    <td rowspan="3" align="left" style="color:#999999;padding-left:20px;"><img src="../images/codigo.png" width="78" height="78" style="margin-left:-15px; visibility:hidden;" id="codigocvc"/></td>
  </tr>

  <tr>
    <td align="right">N&uacute;mero de Tarjeta</td>
    <td><input name="CardNumber" type="text" value="" maxlength="16"/></td>
    </tr>
  <tr>
    <td align="right">Cod. Seguridad</td>
    <td><input name="CVC" type="password" value="" maxlength="3" onfocus="javascript: document.getElementById('codigocvc').style.visibility='visible'" onblur="javascript: document.getElementById('codigocvc').style.visibility='hidden'"/></td>
    </tr>
  <tr>
    <td align="right">Vencimiento</td>
    <td colspan="2"><select name="mes" style="width:61px">
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
      </td>
  </tr>
  <tr>
    <td align="right">Nombre del Tarjetahabiente</td>
    <td colspan="2"><input name="CardHolder" type="text" value=""/></td>
  </tr>
  <tr>
    <td align="right">C&eacute;dula o Rif</td>
    <td colspan="2"><input name="Cedula" type="text" value="" maxlength="8"/></td>
  </tr>
  <tr>
    <td></td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Acepto los <a href="terminos.pdf" target="_blank">t&eacute;rminos y condiciones</a></td>
    <td colspan="2"><input name="acepto" id ="acepto" type="checkbox" value="1" checked></td>
  </tr>

  <tr>
    <td></td>
    <td colspan="2" style="padding-left:15px;"><a  href="javascript: enviarDatos();"  class="btn_enviar"></a></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
   <td colspan="3">&nbsp;</td>
  </tr>

  <tr>
    <td colspan="3">Esta transacci&oacute;n ser&aacute;
procesada de forma segura gracias a la plataforma de:</td>
  </tr>
  <tr>
    <td colspan="3" align="center"><img src="../images/instapago_logo.jpg" width="130" /><img src="../images/banesco_logo.gif"  width="130" style="margin-left:30px;" /></td>
  </tr>
</table>

<input name="KeyId" type="hidden" value="BBEEE96C-0283-41C4-9035-5500A6508813" />
<input name="PublicKeyId" type="hidden" value="fadc5705728b15c0205b1bd8232c436e" />
<input name="Amount" type="hidden" value="<?php echo $total; ?>"/>
<input name="idFactura" type="hidden" value="<?php echo $pedido->info[0]['id']; ?>"/>
<input name="Description" type="hidden" value="Orden de Compra <?php echo $pedido->info[0]['id']; ?>"/>
<input name="IP" type="hidden" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" />
</form>

</section>

		</div> <!--fin container -->

        </div>  <!-- fin intwrapper -->

<?php include "footer.php"; ?>
	</div>       <!-- fin wrapper -->
 <?php if ((isset($_GET['pagar'])) && ($_GET['pagar']=='1')) : ?>
  	<script>
 	   document.getElementById('centro').style.display="none";
 		document.getElementById('resultado').style.display="block";
 	</script>
  <?php endif; ?>
</body>
</html>

</body>
</html>
