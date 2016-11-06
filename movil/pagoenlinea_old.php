<?php include "cabecera.php";
if (!isset($_SESSION['user'])){?>
    <script>
		window.location.href='resultado.php?e=1';
		</script>
<?php
		exit();
	}
	date_default_timezone_set('America/Caracas') ;
	include "../include/class/pedidos.php";
	include "../include/class/usuario.php";

	settype($_GET['orden'],"int");
	$pedido=new pedidos();
	$pedido->loadPedidoUsuario($_GET['orden'],$_SESSION['user']);

	if (count($pedido->info)==0) { ?>
    <script>
		window.location.href='resultado.php?e=2';
		</script>
<?php	}

	$pedido->pedidoUsuarioActivo($_GET['orden'],$_SESSION['user']);
if (count($pedido->info)==0){ ?>
    <script>
		window.location.href='resultado.php?e=7';
		</script>
<?php
}
	$_SESSION['orden']=$_GET['orden'];
?>


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
<!--  <script src="../js/jquery-1.10.2.js"></script>
  <script src="../js/jquery-ui.js"></script>-->


<body>
<?php include "menu.php"; ?>


<div id="wrapper">
<div id="resultado" >Su solicitud ha sido enviada<br><br>Te enviamos un correo con toda la informaci&oacute;n para procesar tu pago</div>
<div id="intwrapper">

	<section id="centro">
		<form id="contacto" name="contacto" action="datospago.php" method="post">
              <table width="100%" border="0" id="registro" name="registro" style="color: rgba(0, 144, 158, 1);" >
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
      <tr>
    <td align="right">Depósito/Transferencia</td>
    <td style="color:#999999;padding-left:20px;"><input name="dt" id="dt" type="checkbox" value="1" checked ></td>
  </tr>
<tr><td colspan="2"><input name="numerodt"  id="numerodt" type="text" required placeholder="*Número de Depósito/Transferencia"></td></tr>
<tr><td colspan="2"><input name="fecha" id="fecha" type="text" size="10" required placeholder="*Fecha"></td></tr>
<tr><td colspan="2"><input name="banco" id="banco" type="text" size="40" required placeholder="*Banco"></td></tr>
<tr><td colspan="2"><img src="../images/datos-transferencia.jpg" style="margin-top:5px; margin-bottom:5px; width:100%;"></td></tr>
  </table>








<table width="100%"  id="registro" name="registro" border="0"  style="color:#009999;" >
      <tr>
    <td align="left" width="80%">Acepto los <a href="terminos.pdf" target="_blank">t&eacute;rminos y condiciones</a></td>
    <td style="color:#999999;" width="60" align="left"><input name="acepto" id ="acepto" type="checkbox" value="1" checked width="20%"></td>
    <td>&nbsp;</td>
  </tr>

  </table>


 <div class="fondoCampo" > <p class="descripcion" ><a  href="javascript: leerDatos();" class="boton">Enviar</a></p></div>

     </form>
</section>


</div>  <!-- fin intwrapper -->
</div>       <!-- fin wrapper -->
 <!--   	<script>
			$(function() {

				$( "#fecha" ).datepicker({ dateFormat: "dd-mm-yy" });
			});
	</script>	-->
     <?php if ((isset($_GET['pagar'])) && ($_GET['pagar']=='1')) : ?>
  	<script>
 	   document.getElementById('centro').style.display="none";
 		document.getElementById('resultado').style.display="block";
 	</script>
  <?php endif; ?>
<script src="../js/script.js"></script>
</body>
</html>
