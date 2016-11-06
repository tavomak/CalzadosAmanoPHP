<?php

include "../include/configure.php";
include "../include/database_tables.php";
include "../include/functions/database.php";
include "../include/class/usuario.php";

function sanear_string($string)

	{
	$string = trim($string);

       //Esta parte se encarga de eliminar cualquier caracter extraño

    $string = str_replace(
        array("\\", "¨", "º", "-", "~",
             "#", "@", "|", "!", "\"",
            "·", "$", "%", "&", "/",
             "(", ")", "?", "'", "¡",
             "¿", "[", "^", "`", "]",
             "+", "}", "{", "¨", "´",
             ">", "< ", ";", ",", ":",
             "."),

        '',

        $string

    );

    return $string;

}



/*Verificar si el usuario ya existe */

$obj = new usuario();
$obj->load_usuario($_POST['usuario']);
if (count($obj->info)>0) :
	echo "<a href='javascript: document.getElementById('resultado').style.display='none';document.getElementById('centro').style.display='block';' >Ya existe este nombre de usuario. &iquest;Quieres volver a intentarlo?</a>";
	exit();
endif;

$usuario = sanear_string($_POST['usuario']);
$nombre = sanear_string($_POST['nombre']);
$sexo = $_POST['sexo'];

$empleado =3;

if (strlen($_POST['nombre'])==0) :
	echo "<a href='javascript: document.getElementById('resultado').style.display='none';document.getElementById('centro').style.display='block';' >Debes llenar todos los campos</a>";
	exit();
endif;

if (strlen($_POST['correo'])==0):
	echo "<a href='javascript: document.getElementById('resultado').style.display='none';document.getElementById('centro').style.display='block';' >Debes llenar todos los campos</a>";
	exit();
endif;

if (strlen($_POST['birth'])==0):
	echo "<a href='javascript: document.getElementById('resultado').style.display='none';document.getElementById('centro').style.display='block';' >Debes llenar todos los campos</a>";
	exit();
endif;

$fecha = explode("/", $_POST['birth']);
if (checkdate($fecha[1],$fecha[0],$fecha[2])):
else:
	echo "<a href='javascript: document.getElementById('resultado').style.display='none';document.getElementById('centro').style.display='block';' >Fecha no valida" . $_POST['birth']."</a>";
	exit();
endif;

if(!filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL))
  {
  echo "<a href='javascript: document.getElementById('resultado').style.display='none';document.getElementById('centro').style.display='block';' >Correo no v&aacute;lido</a>";
  exit();
  }

$obj->loadFromCorreo($_POST['correo']);
if (count($obj->info)>0) :
	echo "<a href='javascript: document.getElementById('resultado').style.display='none';document.getElementById('centro').style.display='block';' >Ya existe este correo. &iquest;Quieres volver a intentarlo?</a>";
	exit();
endif;

if (strlen($_POST['usuario'])==0):
	echo "Debes llenar todos los campos";
	exit();
endif;

if (strlen($_POST['ciudad'])==0):
	echo "<a href='javascript: document.getElementById('resultado').style.display='none';document.getElementById('centro').style.display='block';' >Debes llenar todos los campos</a>";
	exit();
endif;

if (strlen($_POST['telefono'])==0):
	echo "<a href='javascript: document.getElementById('resultado').style.display='none';document.getElementById('centro').style.display='block';' >Debes llenar todos los campos</a>";
	exit();
endif;

if (strlen($_POST['cedula'])==0):
	echo "<a href='javascript: document.getElementById('resultado').style.display='none';document.getElementById('centro').style.display='block';' >Debes llenar todos los campos</a>";
	exit();
endif;
if (!is_numeric($_POST['cedula'])):
	echo "<a href='javascript: document.getElementById('resultado').style.display='none';document.getElementById('centro').style.display='block';' >C&eacute;dula no v&aacute;lida</a>";
	exit();
endif;

if ($_POST['correo']!=$_POST['confirma']):
echo "<a href='javascript: document.getElementById('resultado').style.display='none';document.getElementById('centro').style.display='block';' >Confirme el correo</a>";
	exit();
endif;

if (strlen($_POST['clave'])==0):
echo "<a href='javascript: document.getElementById('resultado').style.display='none';document.getElementById('centro').style.display='block';' >Debes llenar todos los campos</a>";
	exit();
endif;

if ($_POST['clave']!=$_POST['conclave']):
echo "<a href='javascript: document.getElementById('resultado').style.display='none';document.getElementById('centro').style.display='block';' >Confirme la clave</a>";
	exit();
endif;

$ocupacion = sanear_string($_POST['ocupacion']);
$ciudad = sanear_string($_POST['ciudad']);
$telefono = sanear_string($_POST['telefono']);
$email =$_POST['correo'];
$confirmemail = $_POST['confirma'];
$clave = $_POST['clave'];
$confirmeclave = $_POST['conclave'];
$cedula= sanear_string($_POST['cedula']);

$birth=$fecha[1]."/".$fecha[0]."/".$fecha[2];
$obj->add($usuario,$nombre,$birth,$sexo,$empleado,$ocupacion,$ciudad,$telefono,$email,$clave,$cedula);
$header = 'From: Calzados A Mano <info@calzadosamano.com>,';
$header .= "Mime-Version: 1.0 \r\n";
$header .= "Content-Type: text/html; charset=iso-8859-1";
$mensaje = '<table width="100%" border="0" cellspacing="0">
  <tr>
    <td background="http://calzadosamano.com/mailing/img/fondo_blanco.jpg"><table width="100%" border="0" align="center" cellspacing="0">
      <tr align="center"><td><img src="http://calzadosamano.com/mailing/img/logo.jpg" width="199" height="69" alt="A Mano" /></td> </tr>
      <tr align="center"><td><img src="http://calzadosamano.com/mailing/img/raya.jpg" width="536" height="7" /></td></tr>
      <tr align="center">        <td>&nbsp;</td>        </tr>
      <tr align="center">
        <td><img src="http://calzadosamano.com/mailing/img/texto.jpg" width="564" height="101" alt="¡Gracias por registrarte en nuestra tienda On-Line!
        Ahora podrás comprar nuestr" /></td>
        </tr>
      <tr align="center">        <td>&nbsp;</td>        </tr>
    </table></td>
  </tr>
  <tr>
    <td background="http://calzadosamano.com/mailing/img/fondo_azul.jpg"><table width="100%" border="0" cellspacing="0">
      <tr>
        <td align="center" valign="middle"><img src="http://calzadosamano.com/mailing/img/redes.jpg" width="118" height="33" usemap="#Map" border="0" /></td>
      </tr>
      <tr>
        <td align="center" valign="middle"><a href="http://calzadosamano.com/" target="_blank"><img src="http://calzadosamano.com/mailing/img/web.jpg" width="316" height="18" /></a></td>
      </tr>
    </table></td>
  </tr>
</table>
<map name="Map" id="Map">
  <area shape="rect" coords="0,2,21,32" href="https://www.facebook.com/pages/Calzados-A-Mano/496423987087853" target="_blank" />
  <area shape="rect" coords="38,2,70,32" href="https://twitter.com/Calzados_Amano" target="_blank" />
  <area shape="rect" coords="89,3,116,30" href="https://instagram.com/calzadosamano/" target="_blank" />
</map>';

mail( $_POST['correo'], "Bienvenido a Calzados A Mano" , utf8_decode($mensaje), $header);
echo "<a href='iniciar.php' >Bienvenido  <br><span style='font-size:26px'>&iexcl;Su registro ha sido exitoso!</span></a>";
?>
