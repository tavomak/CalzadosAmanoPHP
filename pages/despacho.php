<?php
session_start();
	if (!isset($_SESSION['user'])){
		header('location: iniciar.php');
		exit();
	}
 if ($_SESSION['articulos']==0){
		header('location: mispedidos.php');
		exit();
	}
include "../include/configure.php";
include "../include/database_tables.php";
include "../include/functions/database.php";
tep_db_connect();
$lista_city = searchList("","city_name",NULL,NULL,"*",TABLE_ESTADO);
?><!DOCTYPE html>
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
     <link rel="stylesheet" type="text/css" href="../css/menu.css">

     <style>
	 input, select, textarea { margin-left:1.5em}
	 </style>

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

function cerrarResultado (){
	 document.getElementById('resultado').style.display="none";
}
	</script>
  <script src="../js/jquery-1.10.2.js"></script>

</head>

<body>
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

		<div id="containerPlan" align="center"  onClick="javascript:cerrarResultado();">
        	<section id="centro">
       	 	  <form id="despacho" name="despacho" action="confirmar.php" method="post">
              <table width="100%" border="0" id="registro" name="registro" >
  <tr>
    <td width="40%" align="left" > <strong>1</strong>.- Entregar en:</td>
    <td width="60%">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">*Estado</td>
    <td>  <select name="estado"  id="estado" onChange="javascript:cargar('#city','ruta.php?estado='+ this.value);" >
                 	<option value="" >Seleccione</option>

                	 <?php for($i=0;$i<count($lista_city);$i++) : ?>
                       <option value="<?php echo $lista_city[$i]["id_city"]; ?>"> <?php echo $lista_city[$i]["city_name"]; ?> </option>
                		<?php endfor; ?>
                	</select></td>
  </tr>
  <tr>
    <td align="right">*Ciudad</td>
    <td><div id="city"></div></td>
  </tr>
   <tr>
    <td align="right"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="left"><strong>2</strong>.- Elije la oficina zoom mas cercana a tu domicilio (Si tu ciudad no es elegible)<br></td>
  </tr>
  <tr>
    <td align="right">
      <label>
      Oficina Zoom
        <input type="radio" name="entregadoen" value="z" id="zoom" onClick="vaciarDireccion('1')">
      </label>

      </td>
    <td><div id="laagencia"></div></td>
  </tr>
 <tr>
    <td align="right"></td>
    <td>&nbsp;</td>
  </tr>
 <tr>
   <td align="right"></td>
   <td>&nbsp;</td>
 </tr>
  <tr>
    <td colspan="2" align="left"><strong>3</strong>.- Coloca la direcci&oacute;n de entrega (Si tu ciudad es elegible)<br></td>
    </tr>

    <tr>
      <td align="right">  <label>
      Direcci&oacute;n
      <input type="radio" name="entregadoen" value="d" id="midir" onChange="vaciarZoom()">
      </label></td>
      <td><textarea name="direccion" id="direccion" onChange="vaciarZoom()"></textarea></td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
   <tr>
     <td colspan="2" align="left"><strong>4</strong>.- Coloca el nombre de la persona autorizada para recibir el paquete<br></td>
   </tr>
   <tr>
     <td align="right">*Tel&eacute;fono</td>
     <td><input name="telefono" type="text" id="telefono" required ></td>
   </tr>
  <tr>
    <td align="right">*Persona Contacto</td>
    <td><input name="persona" id="persona" type="text" required></td>
  </tr>
  <tr>
    <td align="right">*C&eacute;dula Persona Contacto</td>
    <td><input name="cedula" type="text" required id="cedula" maxlength="10"></td>
  </tr>
  <tr>
    <td></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td><a href="javascript: document.getElementById('despacho').submit();" class="btn_enviar" style="margin-right:60px;"></a><a href="" class="btn_borrar"></a></td>
  </tr>
</table>
</form>
            </section>

		</div> <!--fin container -->

        </div>  <!-- fin intwrapper -->
                <?php  if ($_SESSION['error']==1) { ?>
            <div id="resultado" align="left" style=" display:block; top:85%; "><a href="javascript:cerrarResultado();">Debe llenar todos los campos obligatorios</a></div>
<?php } ?>
<?php include "footer.php"; ?>
	</div>       <!-- fin wrapper -->

</body>
</html>
