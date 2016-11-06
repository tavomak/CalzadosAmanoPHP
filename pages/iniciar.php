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
                  <div id="resultado" align="left" style="display:block;">Si no recuerdas tu contrase&ntilde;a entra a "Recuperar Clave"</div>
                 <?php endif; ?>
	<div id="wrapper">
    	<div id="intwrapper">
        	<header>
 <div id="logo"><a href="../index.php"><img src="../images/logo.png" width="207" height="66"></a></div>
            	<nav id="redes">
                <a href="registrarse.php" class="boton btn_registrarse"></a>
                <a href="#" class="boton btn_sesionhover"></a>
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
       	 	  <form id="contacto" name="contacto" action="login.php" method="post">
              <table width="100%" border="0" id="registro" name="registro">
  <tr>
    <td align="right">Usuario</td>
    <td style="padding-left:20px;"> <input name="usuario" id="usuario"  type="text"></td>
  </tr>
  <tr>
    <td align="right">Contraseña </td>
    <td style="padding-left:20px;"> <input name="clave"  type="password" id="clave" ></td>
  </tr>
   <tr>
    <td>&nbsp; </td>
    <td></td>
  </tr>
</table>

                 <a href="javascript: enviarDatos();" class="btn_enviar"></a>
                 <a href="recuperar.php" class="btn_recuperar"></a><br><br>

                </form>
            </section>
		</div> <!--fin container -->

        </div>  <!-- fin intwrapper -->
       <?php include "footer.php"; ?>
	</div>       <!-- fin wrapper -->
</body>
</html>
