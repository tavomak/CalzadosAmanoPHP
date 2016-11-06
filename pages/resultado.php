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
    <link rel="stylesheet" type="text/css" href="../css/menu.css">


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
					$mensaje='<a href="javascript: window.history.go(-1);">Para continuar debe llenar todos los campos.</a>';
					break;
				case '4':
					$mensaje='<a href="javascript: window.history.go(-1);" ><div style="margin-top:-45px">Sus datos no son v&aacute;lidos.<br>Por favor, revise e intente de nuevo</div></a>';
					break;
				case '5':
					$mensaje='<a href="javascript: window.history.go(-1);">Para continuar debe aceptar los t&eacute;rminos y condiciones</a>';
				case '6':
					$mensaje='<a href="javascript: window.history.go(-1);"><div style="margin-top:-45px">Su pago fue rechazado.<br><span style="font-size:40px;">Por favor, intente de nuevo o comun&iacute;quese con su entidad financiera</a></div></a>';
					break;
				case '7':
					$mensaje='<a href="terminos.pdf"><div style="margin-top:-45px">Orden no disponible.<br><span style="font-size:40px;">Excedido el l&iacute;mite de tiempo para efectuar el pago.</a></div></a>';
					break;
			}
		endif; ?>
                  <div id="resultado" align="left" style="display:block;"><?php echo $mensaje; ?></div>
	<div id="wrapper">

    	<div id="intwrapper">
        	<header>
 <div id="logo"><a href="../index.html"><img src="../images/logo.png" width="207" height="66"></a></div>
            	<?php include "redes.php"; ?>

                <div class="separador"></div>
                <nav id="menu">
                 <?php $pages=$_SERVER['PHP_SELF'];
				include "menu.php"; ?>
               </nav>
            </header>


		<div class="container"  align="center">
        	<section id="centroinicia">

            </section>
		</div> <!--fin container -->

        </div>  <!-- fin intwrapper -->
        <div id='footer'>
        	Todos los derechos reservados. <a href="http://http://www.instintocreativo.net.ve/" target="_blank">IC Estudio de Desarrollo Creativo</a>. 2014.
        </div>
	</div>       <!-- fin wrapper -->
</body>
</html>
