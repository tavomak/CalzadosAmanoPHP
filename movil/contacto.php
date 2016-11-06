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
   		objeto.open("POST", "enviar.php", true);
		objeto.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
 		objeto.send(retornarDatos());
 	}
	}
// ------------------------------

	function retornarDatos()
	{
		var cad='';
 		var nom=document.getElementById('nombre').value;
  		var cor_in=document.getElementById('correo').value;
		var asunto=document.getElementById('asunto').value;
		var mes=document.getElementById('mensaje').value;
		cad='nombre='+encodeURIComponent(nom)+'&correo='+encodeURIComponent(cor_in)+'&asunto='+encodeURIComponent(asunto)+'&mensaje='+encodeURIComponent(mes);
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
 window.location.href="resultado.php?e=8";
 /*document.getElementById('resultado').style.display="block";
 document.getElementById('resultado').innerHTML = objeto.responseText;*/
}

}

function borrarDatos(){
	document.getElementById('nombre').value='';
  	document.getElementById('correo').value='';
	document.getElementById('asunto').value='';
	document.getElementById('mensaje').value='';
}

	</script>
</head>

<body>
<?php include "menu.php"; ?>
<div id="wrapper">
<div id="intwrapper">
<span class="titulo">CONTACTO</span><br>
<p class="descripcion ubicacion">
	<span class="tienda">Ventas Online - Al mayor</span><br>
	info@calzadosamano.com<br>
	Telf:+58 212 991 30 02<br>
	Lunes a Viernes:<br>
	Horario corrido de 8:30 am -3:30 pm<br><br>

	<span class="tienda">Tienda San Luis</span><br>
	C.C. San Luis. Urb. San Luis. El Cafetal. Caracas.<br>
	(Local 26, al lado de Tequeños Las Tías)<br>
	Telf: +58 212 986 09 50<br>
	Lunes a Viernes: 10:00 am-07:00 pm<br>
	S&aacute;bados: 11:00 am-05:00 pm
</p>
<form id="contacto" name="contacto" action="enviar.php" method="post" onClick="javascript: cerrarMenu();">
	<input name="nombre" id="nombre" type="text"  placeholder="*Nombre Completo"  ><br>
	<input name="correo" id="correo" type="text"  placeholder="*Email" ><br>
	<input name="asunto" id="asunto" type="text"  placeholder="Asunto" ><br>
	<input name="mensaje" id="mensaje" placeholder="Mensaje" ><br><br>
<div class="fondoCampo"> <p class="descripcion" ><a href="javascript: leerDatos();" class="boton">Enviar</a></p> </div>
</form>
</div>
</div>

<script src="../js/script.js"></script>
</body>
</html>
