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
function despejar(){
	document.getElementById('resultado').style.display='none';
}

	</script>
</head>
<body>
    <?php include "menu.php"; ?>

<div id="wrapper">
	<?php if ((isset($_GET['e'])) && ($_GET['e']==1)) : ?>
    <div style="height:300px;" id="marco" >
                  <div id="resultado" style="display:block;"><a href="javascript: quitarMarco(); " >El correo no se encuentra. Intenta de nuevo.</a></div>
                 </div> <?php endif; ?>
                   <?php if ((isset($_GET['e'])) && ($_GET['e']==2)) : ?>
                  <div style="height:300px;" > <div id="resultado" style="display:block;">Un email ha sido enviado a tu buz&oacute;n de correo.</div>
                 </div> <?php endif; ?>
<div id="intwrapper">
<span class="titulo">RECUPERAR CLAVE</span><br>
	<form id="contacto" name="contacto" action="certificarcambio.php" method="post">
		<input name="correo" id="correo" type="text"  placeholder="*Correo Electrónico"><br>
        <div class="fondoCampo" style="margin-top:2px;"> <p class="descripcion" ><a href="javascript: enviarDatos();" class="boton">Enviar</a></p> </div>

	 </form>
</div>  <!-- fin intwrapper -->
</div>       <!-- fin wrapper -->
<script src="../js/script.js"></script>
</body>
</html>
