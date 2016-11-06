<?php session_start(); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Calzados A'mano</title>
<meta name="description" content="Calzados A'mano es una empresa ubicada en la ciudad de Caracas con más de 15 años en el mercado de calzados en Venezuela." />
<meta name="keywords" content="Calzados a'mano" />
<link rel="shortcut icon" href="../favicon.ico">
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="../css/stylesmovil.css">
<link rel="stylesheet" type="text/css" href="../css/menumovil.css">
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
<script src="../js/jquery.min.js"></script>
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
/* window.location.href="resultado.php?e=8";
   document.getElementById('centro').style.display="none";*/
 window.scrollTo(0, 0);
  document.getElementById('marco').style.display="block";
 document.getElementById('resultado').style.display="block";
 document.getElementById('intwrapper').style.display="none;";
 document.getElementById('resultado').innerHTML = objeto.responseText;
}

}
	</script>
    <script src="../js/amano.js"></script>
</head>

<body>
<?php include "menu.php"; ?>

<div id="wrapper"><div style="height:300px;" id="marco"><div id="resultado" onClick="javascript:quitarMarco();"></div></div>
<div id="intwrapper" onClick="javascript: quitarMarco();">
<span class="titulo">REGISTRO</span><br>

<form id="contacto" name="contacto" action="registrar.php" method="post">
	<input name="usuario" id="usuario"  type="text" placeholder="*Usuario"><br>
	<input name="nombre" id="nombre" type="text"  placeholder="*Nombre Completo"><br>
    <input name="cedula" id="cedula" type="text" size="10" placeholder="*C&eacute;dula"><br>
    <input name="birth" id="birth" type="text" size="10" placeholder="*Fecha de Nacimiento (dia/mes/a&ntilde;o)"><br>
    <select name="sexo" id="sexo" >
    <option value="0">*Sexo</option>
      <option value="F">Femenino</option>
      <option value="M">Masculino</option>
    </select> <br>
    <input name="ocupacion" id="ocupacion"  type="text" placeholder="Ocupación/Profesión"><br>
    <input name="ciudad"  id="ciudad" type="text" placeholder="*Ciudad"><br>
    <input name="telefono" type="text" id="telefono" placeholder="*Teléfono">
	<input name="correo" id="correo" type="text"  placeholder="*Correo Electrónico"><br>
	<input name="confirma" id="confirma" type="text" size="40" placeholder="*Confirme  Correo Electrónico"><br>
	<input name="clave" type="password" id="clave" placeholder="*Contraseña"><br>
    <input name="conclave" type="password" id="conclave" placeholder="*Confirme  Contraseña"><br><br>
<div class="fondoCampo" > <p class="descripcion" ><a href="javascript: leerDatos();" class="boton">Enviar</a></p> </div>
</form>
</div>
</div>

<script src="../js/script.js"></script>
</body>
</html>
