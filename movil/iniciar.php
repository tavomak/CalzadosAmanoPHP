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
<script src="../js/amano.js"></script>
    <script>
		function enviarDatos(){
			document.forms["contacto"].submit();
		}
	</script>
</head>
<body>
<?php include "menu.php";?>

<div id="wrapper">
 <?php if ((isset($_GET['e'])) && ($_GET['e']==1)) : ?>
 <style> #intwrapper{display:none;}</style>
 <div style="height:300px;" id="marco">
        <div id="resultado" style="display:block;" onClick="javascript: quitarMarco();">Si no recuerdas tu contrase&ntilde;a entra a<br>"Recuperar Clave"</div></div>
 <?php endif; ?>
<div id="intwrapper" onClick="javascript: quitarMarco();">
<span class="titulo">INICIAR SESI&Oacute;N</span><br>
	<form id="contacto" name="contacto" action="login.php" method="post">
		<input name="usuario" id="usuario"  type="text" placeholder="*Usuario"><br>
		<input name="clave" type="password" id="clave" placeholder="*Contraseña"><br><br>
		<div class="fondoCampo"> <p class="descripcion" ><a href="javascript: enviarDatos();"  class="boton">Enviar</a></p> </div>
       <div class="fondoCampo"> <p class="descripcion" ><a href="recuperar.php" class="boton">Recuperar clave</a></p> </div><br><br>
	 </form>

</div>  <!-- fin intwrapper -->
</div>       <!-- fin wrapper -->
<script src="../js/script.js"></script>
</body>
</html>
