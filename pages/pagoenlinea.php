<?php session_start();
	if (!isset($_SESSION['user'])){
		header('location: iniciar.php');
		exit();
	}
	date_default_timezone_set('America/Caracas') ;
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
<!DOCTYPE html>
<html lang="en" class="no-js">
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

		var objeto = false;

		function crearObjeto() {
 		// --- Crear el Objeto dependiendo los diferentes Navegadores y versiones ---
 		try { objeto = new ActiveXObject("Msxml2.XMLHTTP");  }
 		catch (e) {
			 try { objeto = new ActiveXObject("Microsoft.XMLHTTP"); }
 			 catch (E) {
				objeto = false; }
		}
 		// --- Si no se pudo crear... intentar este ultimo metodo ---
 		if (!objeto && typeof XMLHttpRequest!='undefined') {
   			objeto = new XMLHttpRequest();
 		}
		}

// ------------------------------

	function leerDatos() {

 	crearObjeto();

 	if (objeto.readyState != 0) {
   		alert('Error al crear el objeto XML. El Navegador no soporta AJAX');
 	} else {
   		// Preparar donde va a recibir el Resultado
   		objeto.onreadystatechange = procesaResultado;
   		// Enviar la consulta
   		objeto.open("POST", "datospago.php", true);
		objeto.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

  		objeto.send(retornarDatos());
 	}
	}

// ------------------------------

	function retornarDatos()
	{

		var cad='';

		var numerodt=document.getElementById('numerodt').value;
		var fecha=document.getElementById('fecha').value;
		var banco=document.getElementById('banco').value;
		var dt=document.getElementById('dt').checked;

		var acepto=0;
		if(document.getElementById('acepto').checked){
			acepto=1;
		}


		cad='dt='+encodeURIComponent(dt)+'&numerodt='+encodeURIComponent(numerodt)+'&fecha='+encodeURIComponent(fecha)+'&banco='+encodeURIComponent(banco)+'&acepto='+encodeURIComponent(acepto);

		return cad;
}

function procesaResultado() {
// Si aun esta revisando los datos...
if (objeto.readyState == 1) {
 document.getElementById('resultado').innerHTML = "Cargando datos...";
}
// Si el estado es 4 significa que ya termino
if (objeto.readyState == 4) {
 // objeto.responseText trae el Resultado que metemos al DIV de arriba
 document.getElementById('centro').style.display="none";
 document.getElementById('resultado').style.display="block";
 document.getElementById('resultado').innerHTML = objeto.responseText;

}
}

function despejar(){
	document.getElementById("resultado").style.display="none";document.getElementById("centro").style.display="block"
}
	</script>
  <script src="../js/jquery-1.10.2.js"></script>
  <script src="../js/jquery-ui.js"></script>
</head>

<body>
<div id="resultado" style="line-height:24px; padding-bottom:30px; "><a href="javascript: despejar();">Su solicitud ha sido enviada<br><br>Te enviamos un correo con toda la informaci&oacute;n para procesar tu pago</a></div>

	<div id="wrapper">
    	<div id="intwrapper">
        	<header>
         <div id="logo"><a href="../index.php"><img src="../images/logo.png" width="207" height="66"></a></div>
        	<?php include "redes.php"; ?>
                <div class="separador"></div>
                <nav id="menu">
                <?php $pages=$_SERVER['PHP_SELF'];
				include "menu.php"; ?>
               </nav>
            </header>

		<div class="container" align="center" >
        	<section id="centro">
       	 	  <form id="contacto" name="contacto" action="datospago.php" method="post">
              <table width="100%" border="0" id="registro" name="registro" style="color:#009999;" >
  <tr>
    <td align="right"  > Subtotal a pagar </td>
    <td style="color:#999999;padding-left:20px;"><?php echo "BsF. " .number_format($pedido->info[0]['tot_zapato'],2); ?></td>
  </tr>
  <tr>
    <td align="right">Envío</td>
    <td style="color:#999999;padding-left:20px;"><?php echo "BsF. " .number_format($pedido->info[0]['tot_envio'],2); ?></td>
  </tr>
  <tr>
    <td align="right">Total a pagar</td>
    <td style="color:#999999;padding-left:20px;"><?php $total=$pedido->info[0]['tot_zapato']+$pedido->info[0]['tot_envio']; echo "BsF. " .number_format($total,2); ?></td>
  </tr>
  <tr>
    <td align="right">Número de Orden</td>
    <td style="color:#999999;padding-left:20px;"><?php echo $pedido->info[0]['id']; ?></td>
  </tr>
  <tr>
    <td align="right">Depósito/Transferencia</td>
    <td><input name="dt" id="dt" type="checkbox" value="1" checked></td>
  </tr>
  <tr>
    <td align="right">Número de Depósito/Transferencia</td>
    <td><input name="numerodt"  id="numerodt" type="text" required></td>
  </tr>
  <tr>
    <td align="right">Fecha</td>
    <td><input name="fecha" id="fecha" type="text" size="10" required></td>
  </tr>
  <tr>
    <td align="right">Banco</td>
    <td><input name="banco" id="banco" type="text" size="40" required></td>
  </tr>
  <tr>
    <td></td>
    <td style="padding-left:20px;"><p><strong>Inversiones Subibaja C.A</strong><br>RIF: J-405745282 <br>Cuenta corriente Banesco <strong>0134-0384-81-3841027802</strong></p></td>
  </tr>
  <tr>
    <td></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Acepto los <a href="terminos.pdf" target="_blank">t&eacute;rminos y condiciones</a></td>
    <td><input name="acepto" id ="acepto" type="checkbox" value="1" checked></td>
  </tr>
  <tr>
    <td></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td><a  href="javascript: leerDatos();"  class="btn_enviar"></a></td>
  </tr>
</table>      </form>
            </section>

		</div> <!--fin container -->

        </div>  <!-- fin intwrapper -->
<?php include "footer.php"; ?>
	</div>       <!-- fin wrapper -->
    	<script>
			$(function() {

				$( "#fecha" ).datepicker({ dateFormat: "dd-mm-yy" });
			});
	</script>
     <?php if ((isset($_GET['pagar'])) && ($_GET['pagar']=='1')) : ?>
  	<script>
 	   document.getElementById('centro').style.display="none";
 		document.getElementById('resultado').style.display="block";
 	</script>
  <?php endif; ?>
</body>
</html>
