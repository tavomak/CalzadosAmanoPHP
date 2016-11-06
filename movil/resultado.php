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
<script src="../js/amano.js"></script>

 <script>

function enviarDatos(){
	document.forms["contacto"].submit();
}
	</script>
</head>
<body>
    <?php if (isset($_GET['e'])) :
			switch ($_GET['e']) {
				case '1' :
					$mensaje='Inicie sesi&oacute;n para continuar.';
					break;
				case '2':
					$mensaje='N&uacute;mero de orden no v&aacute;lido.';
					break;
				case '3':
					$mensaje='<a href="javascript: window.history.go(-1);" >Para continuar debe llenar todos los campos.</a>';
					break;
				case '4':
					$mensaje='<a href="javascript: window.history.go(-1);"  >Sus datos no son v&aacute;lidos.<br>Por favor, revise e intente de nuevo</a>';
					break;
				case '5':
					$mensaje='<a href="javascript: window.history.go(-1);" >Para continuar debe aceptar los t&eacute;rminos y condiciones</a>';
				case '6':
					$mensaje='<a href="javascript: window.history.go(-1);"> Su pago fue rechazado.<br>Por favor, intente de nuevo o comun&iacute;quese con su entidad financiera</a>';
					break;
				case '7':
					$mensaje='<a href="terminos.pdf" >Orden no disponible.<br>Excedido el l&iacute;mite de tiempo para efectuar el pago.</div></a>';
					break;
				case '8':
					$mensaje='Mensaje Enviado';
					break;
				case '9':
					$mensaje='<a href="javascript: contacto.php">Mensaje No Enviado.<br>Intente m&aacute;s tarde.</a>';
					break;
			}
		endif; ?>

<?php include "menu.php"; ?>
<div id="wrapper"><div style="height:300px;" > <div id="resultado" style="display:block;"><?php echo $mensaje; ?></div></div>
<div id="intwrapper">

		<div class="container"  align="center">
        	<section id="centroinicia">

            </section>
		</div> <!--fin container -->

</div>  <!-- fin intwrapper -->
</div>       <!-- fin wrapper -->
<script src="../js/script.js"></script>
</body>
</html>
