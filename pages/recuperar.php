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
    <?php if ((isset($_GET['e'])) && ($_GET['e']==1)) : ?>
                  <div id="resultado" align="left" style="display:block;">El correo no se encuentra. Intenta de nuevo.</div>
                  <?php endif; ?>
                   <?php if ((isset($_GET['e'])) && ($_GET['e']==2)) : ?>
                  <div id="resultado" align="left" style="display:block;">Un email ha sido enviado a tu buz&oacute;n de correo.</div>
                  <?php endif; ?>
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

 <!--
<a href="javascript:alertSize();" > mostrar Height / Width </a>
<p id="resultado"></p>  -->

		<div class="container"  align="center">
        	<section id="centroinicia">
       	 	  <form id="contacto" name="contacto" action="certificarcambio.php" method="post">
              <table width="100%" border="0" id="registro" name="registro">
  <tr>
    <td>Correo Electr&oacute;nico </td>
    <td><input name="correo" id="correo"  type="text" style="margin-left:10px;"></td>
  </tr>

   <tr>
    <td>&nbsp; </td>
    <td></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><table><tr><td><a href="javascript: enviarDatos();" class="btn_enviar"></a></td></tr></table> </td>
    </tr>
</table>


                 <br><br>
                </form>
            </section>
		</div> <!--fin container -->

        </div>  <!-- fin intwrapper -->
        <div id='footer'>
        	Todos los derechos reservados. <a href="http://http://www.instintocreativo.net.ve/" target="_blank">IC Estudio de Desarrollo Creativo</a>. 2014.
        </div>
	</div>       <!-- fin wrapper -->
</body>
</html>
