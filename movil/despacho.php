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

tep_db_connect();
$lista_city = searchList("","city_name",NULL,NULL,"*",TABLE_ESTADO);
?>

<script>
function cargar(div, destino){
   	 $(div).load(destino);
}

function vaciarDireccion(valor){
   	 if (valor==''){
	 } else {
		 document.getElementById('direccion').value='';
		 document.getElementById('direccion').disabled=true;
		 document.getElementById('zoom').checked=true;

	 }
}

function vaciarZoom(valor){
		 document.getElementById("nulo").selected = true;
		 document.getElementById('direccion').disabled=false;
		 document.getElementById('midir').checked=true;
}
	</script>
<body>
<?php $activalo='1'; include "menu.php"; ?>
<div id="wrapper">
<div id="intwrapper">
 <span class="titulo">FORMULARIO DE DESPACHO</span><br>
	<section id="centro" class="descripcion">
		<form id="despacho" name="despacho" action="confirmar.php" method="post">
			<strong>1</strong>.- Entregar en: <br>
 			<select name="estado"  id="estado" onChange="javascript:cargar('#city','ruta.php?estado='+ this.value);" style="margin-bottom:10px; margin-top:10px; " >
                 <option value="" >*Selecciona Estado</option>
                <?php for($i=0;$i<count($lista_city);$i++) : ?>
                 <option value="<?php echo $lista_city[$i]["id_city"]; ?>"> <?php echo $lista_city[$i]["city_name"]; ?> </option>    			<?php endfor; ?>
            </select>
            <div id="city" style=" margin-bottom:10px;"></div>
            <div style="clear:both"></div>
            <strong>2</strong>.- Elije la oficina zoom mas cercana a tu domicilio (Si tu ciudad no es elegible)<br><br>
      <div style="width:20%; float:left; margin-top:-7px;">
        <input type="radio" name="entregadoen" value="z" id="zoom" onClick="vaciarDireccion('1')" ></div>
        <span>Oficina Zoom</span>   <br>

      <div id="laagencia" style="margin-top:10px;"></div>
      <div style="clear:both"></div><br>
  <strong>3</strong>.- Coloca la direcci&oacute;n de entrega (Si tu ciudad es elegible)<br><br>
		  <div style="width:20%; float:left; ; margin-top:-7px;">
        <input type="radio" name="entregadoen" value="d" id="midir" onChange="vaciarZoom('1')"  width="20%"></div>
        Direcci&oacute;n<br>
        <textarea name="direccion" id="direccion" onChange="vaciarZoom('1')" style="width:100%; margin-bottom:10px; margin-top:10px;"> </textarea><br>
<strong>4</strong>.- Coloca el nombre de la persona autorizada para recibir el paquete<br>
   <input name="telefono" type="text" id="telefono" required placeholder="*Tel&eacute;fono" >
     <input name="persona" id="persona" type="text"  required placeholder="*Persona Contacto">
    <input name="cedula" type="text" required id="cedula"  maxlength="10" placeholder="*C&eacute;dula Persona Contacto">
    <div class="fondoCampo" style="margin-top:10px;"> <p class="descripcion" ><a href="javascript: document.getElementById('despacho').submit();" class="boton">Enviar</a></p></div>
	</form>
	</section>
</div>  <!-- fin intwrapper -->
</div>       <!-- fin wrapper -->
<script src="../js/script.js"></script>
</body>
</html>
