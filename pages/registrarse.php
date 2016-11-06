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
   		objeto.open("POST", "registrar.php", true);
		objeto.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

  		objeto.send(retornarDatos());
 	}
	}

// ------------------------------

	function retornarDatos()
	{
		var cad='';
 		var nom=document.getElementById('nombre').value;
		var cedula=document.getElementById('cedula').value;
		var birth=document.getElementById('birth').value;
  		var cor_in=document.getElementById('correo').value;
		var usuario=document.getElementById('usuario').value;
		var ocupacion=document.getElementById('ocupacion').value;
		var ciudad=document.getElementById('ciudad').value;
		var indice = document.contacto.sexo.selectedIndex ;
		var sexo = document.contacto.sexo.options[indice].value ;
		var telefono=document.getElementById('telefono').value;
		var confirma=document.getElementById('confirma').value;
		var clave=document.getElementById('clave').value;
		var conclave=document.getElementById('conclave').value;
		cad='usuario='+encodeURIComponent(usuario)+'&nombre='+encodeURIComponent(nom)+'&cedula='+encodeURIComponent(cedula)+'&birth='+encodeURIComponent(birth)+'&correo='+encodeURIComponent(cor_in)+'&ocupacion='+encodeURIComponent(ocupacion)+'&ciudad='+encodeURIComponent(ciudad)+'&sexo='+encodeURIComponent(sexo)+'&telefono='+encodeURIComponent(telefono)+'&confirma='+encodeURIComponent(confirma)+'&clave='+encodeURIComponent(clave)+'&conclave='+encodeURIComponent(conclave);

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

	</script>
  <script src="../js/jquery-1.10.2.js"></script>
  <script src="../js/jquery-ui.js"></script>
</head>

<body>
<div id="resultado" onClick="javascript:this.style.display='none'; document.getElementById('centro').style.display='block';" style="line-height:40px; padding-bottom:40px; padding-top:40px; color:#FFF; font-size:72px;"></a></div>

	<div id="wrapper">
    	<div id="intwrapper">
        	<header>
         <div id="logo"><a href="../index.php"><img src="../images/logo.png" width="207" height="66"></a></div>
        	<nav id="redes">
                <a href="registrarse.php" class="boton btn_registrarsehover" ></a>
                <a href="iniciar.php" class="boton btn_sesion"></a>
                <a href="https://www.facebook.com/pages/Calzados-A-Mano/496423987087853" class="boton btn_facebook" target="_blank"></a>
                <a href="https://twitter.com/Calzados_Amano" class="boton btn_twitter" target="_blank"></a>
               <a href="https://instagram.com/calzadosamano/" class="boton btn_instagram" target="_blank"></a>
               <a href="mispedidos.php" class="boton btn_carrito" ></a> <span style="color: #009999; margin-left:10px; font-weight:bold;"><?php echo $_SESSION['articulos'];?></span>
                </nav>

                <div class="separador"></div>
                <nav id="menu">
                 <?php $pages=$_SERVER['PHP_SELF'];
				include "menu.php"; ?>
               </nav>
            </header>
 <!--
<a href="javascript:alertSize();" > mostrar Height / Width </a>
<p id="resultado"></p>  -->

		<div id="containerPlan" align="center" >
        	<section id="centro">
       	 	  <form id="contacto" name="contacto" action="registrar.php" method="post">
              <table width="100%" border="0" id="registro" name="registro" >
  <tr>
    <td align="right" > *Usuario</td>
    <td><input name="usuario" id="usuario"  type="text"></td>
  </tr>
  <tr>
    <td align="right">*Nombre Completo</td>
    <td><input name="nombre" id="nombre" type="text" size="40" ></td>
  </tr>
  <tr>
    <td align="right">*C&eacute;dula</td>
    <td>
      <input type="text" name="cedula" id="cedula" size="10">
   </td>
  </tr>
  <tr>
    <td align="right">*Fecha de Nacimiento</td>
    <td><input name="birth" id="birth" type="text" size="10"></td>
  </tr>
  <tr>
    <td align="right">*Sexo</td>
    <td><select name="sexo" id="sexo" >
    <option value="0">Seleccione</option>
      <option value="F">Femenino</option>
      <option value="M">Masculino</option>
    </select></td>
  </tr>
  <tr>
    <td align="right">Ocupación/Profesión</td>
    <td><input name="ocupacion" id="ocupacion"  type="text"></td>
  </tr>
  <tr>
    <td align="right">*Ciudad</td>
    <td><input name="ciudad"  id="ciudad" type="text"></td>
  </tr>
  <tr>
    <td align="right">*Teléfono</td>
    <td><input name="telefono" type="text" id="telefono"></td>
  </tr>
  <tr>
    <td align="right">*Correo Electrónico</td>
    <td><input name="correo" id="correo" type="text" size="40"></td>
  </tr>
  <tr>
    <td align="right">*Confirme  Correo Electrónico </td>
    <td><input name="confirma" id="confirma" type="text" size="40"></td>
  </tr>
  <tr>
    <td align="right">*Contraseña</td>
    <td><input name="clave" type="password" id="clave"></td>
  </tr>
  <tr>
    <td align="right">*Confirme  Contraseña</td>
    <td><input name="conclave" type="password" id="conclave"></td>
  </tr>
  <tr>
    <td></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><a href="javascript: leerDatos();" class="btn_enviar" style="float:right;"></a></td>
    <td>
                <a href="registrarse.php" class="btn_borrar" style="margin-left:60px;"></a></td>
  </tr>
</table>

                </form>
            </section>

		</div> <!--fin container -->

        </div>  <!-- fin intwrapper -->
<?php include "footer.php"; ?>
	</div>       <!-- fin wrapper -->
    	<script>
			$(function() {

				$( "#birth" ).datepicker(  {
      changeMonth: true,
      changeYear: true,
	   dateFormat: "dd/mm/yy",
	  yearRange: "1930:2016"
    });
			});
	</script>
</body>
</html>
