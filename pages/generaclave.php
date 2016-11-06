<?php
include "../include/configure.php";
include "../include/database_tables.php";
include "../include/functions/database.php";
include "../include/class/usuario.php";

$obj = new usuario();
$obj->load_usuario($_GET['u']);
if (count($obj->info)==0) { ?>
<script>
	window.location.href="http://www.calzadosamano.com/";
</script>
<?php exit();
} ?>
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
			document.forms["formRecuperar"].submit();
		}
	</script>
</head>
<body>
 <?php if ((isset($_GET['e'])) && ($_GET['e']==1)) : ?>
     <div id="resultado" align="left" style="display:block;" onClick="javascript: this.style.display='none'">Debes llenar todos los campos</div>
 <?php endif;
  if ((isset($_GET['e'])) && ($_GET['e']==2)) : ?>
     <div id="resultado" align="left" style="display:block;" onClick="javascript: this.style.display='none'">Confirme la contrase&ntilde;a</div>
 <?php endif;
 if ((isset($_GET['e'])) && ($_GET['e']==3)) : ?>
     <div id="resultado" align="left" style="display:block;" onClick="javascript: window.location.href='iniciar.php'">Tu clave ha sido modificada exitosamente</div>
     <script>
	 document.getElementById("centroinicia").style.display="none";
	 </script>
 <?php endif; ?>

	<div id="wrapper">
    	<div id="intwrapper">
        	<header>
 <div id="logo"><a href="../index.php"><img src="../images/logo.png" width="207" height="66"></a></div>
            	<nav id="redes">
                <a href="registrarse.php" class="boton btn_registrarse"></a>
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


		<div class="container"  align="center" onClick="javascript: document.getElementById('resultado').style.display='none'">
        	<section id="centroinicia">
       	 	  <form id="formRecuperar" name="formRecuperar" action="registraclave.php" method="post" style="float:none;">
              <table  border="0" id="registro" name="registro">
  <tr>
    <td colspan="2" align="center" style="font-size:16px; font-weight:bold">Tu usuario es: <?php echo $_GET['u']; ?></td>
  </tr>
  <tr>
    <td colspan="2" align="center ">&nbsp;</td>
  </tr>

  <tr>
    <td align="right">Escribe tu nueva clave</td>
    <td style="padding-left:10px;"> <input name="clave" id="clave"  type="password" ></td>
  </tr>
  <tr>
    <td align="right">Repite tu nueva clave</td>
    <td style="padding-left:10px;"> <input name="repiteclave"  type="password" id="repiteclave" ></td>
  </tr>
   <tr>
    <td>&nbsp;<input name="u" type="hidden" value="<?php echo $_GET['u']; ?>"> </td>

  </tr>
   <tr>

     <td colspan="2"><table align="center"><td><a href="javascript: enviarDatos();" class="btn_enviar" ></a></td></table></td>
  </tr>
</table>




                </form>
            </section>
		</div> <!--fin container -->

        </div>  <!-- fin intwrapper -->
       <?php include "footer.php"; ?>
	</div>       <!-- fin wrapper -->
</body>
</html>
