<?php session_start(); ?><!DOCTYPE html>

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
      #map-canvas {
        height: 250px;
		width: 50%;
        margin: 0px;
        padding: 0px;
		float:left;
		margin-top: 10%;
      }
	  #contacto{line-height:1.0em}
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script>
	var map;
	var myLatlng = new google.maps.LatLng(10.468378,-66.842894 );

	function initialize() {
 	 	var mapOptions = {
    		zoom: 15,
   		center: myLatlng,
  		 disableDefaultUI: true
  		};

		map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
 		// Agregar marcador
		var image = '../images/contacto/contactos-location-icon.png';
		var marker = new google.maps.Marker({
    		position: myLatlng,
			map: map,
    		title:"Calzados A'Mano"
		});
}

google.maps.event.addDomListener(window, 'load', initialize);
 </script>
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
 document.getElementById('resultado').style.display="block";
 document.getElementById('resultado').innerHTML = objeto.responseText;
if (document.getElementById('resultado').innerHTML=='mensaje enviado') {
	borrarDatos();
}
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
<div id="resultado" align="left" onClick="javascript: this.style.display='none'"></div>
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

		<div id="containerPlan" onClick="javascript: document.getElementById('resultado').style.display='none'" >
        	<section id="izquierda">
     	 	  <form id="contacto" name="contacto" action="enviar.php" method="post">
                *Nombre Completo<br>
                <input name="nombre" id="nombre" type="text" size="60"><br>
                *E-mail<br>
                <input name="correo" id="correo" type="text" size="60"><br>
                Asunto<br>
                <input name="asunto" id="asunto" type="text" size="60"><br>
                Mensaje<br>
                <textarea name="mensaje" id="mensaje" cols="50" rows="7"></textarea><br><br>
                 <a href="javascript: leerDatos();" class="btn_enviar"></a><a href="javascript: borrarDatos();" class="btn_borrar" style="margin-left:60px;"></a><br><br> <div id="addressright" style="line-height:1.4em;" >

               	<span class="titdireccion">Ventas Online - Al mayor</span><br>
info@calzadosamano.com<br>
Telf:+58 212 991 30 02<br>
Lunes a Viernes:<br>
Horario corrido de 8:30 am -3:30 pm.
			</div>

               </form>
            </section>

			<section id="derecha">
           	 <div id="map-canvas"></div>
                 <div id="address" style="padding-top:45px;">
                 	<span class="titdireccion">Tienda San Luis</span><br>
                 	C.C. San Luis. Urb. San Luis. El Cafetal. Caracas.<br>
(Local 26, al lado de Tequeños Las Tías)<br>
Telf: +58 212 986 09 50<br>
Lunes a Viernes: 10:00 am-07:00 pm<br>
S&aacute;bados: 11:00 am-05:00 pm
				</div>
                </section>
		</div> <!--fin container -->
        </div>  <!-- fin intwrapper -->
<?php include "footer.php"; ?>

	</div>       <!-- fin wrapper -->
</body>
</html>
