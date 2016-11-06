<?php
include "../include/configure.php";
include "../include/database_tables.php";
include "../include/functions/database.php";
include "../include/class/usuario.php";

$obj = new usuario();
$obj->loadFromCorreo($_POST['correo']);

if (count($obj->info)==0){
	header('location: recuperar.php?e=1');
	exit();
}


$header = 'From: Calzados A Mano <info@calzadosamano.com>,';
$header .= "Mime-Version: 1.0 \r\n";
$header .= "Content-Type: text/html; charset=iso-8859-1";

$mensaje ='';
$mensaje.='<table  border="0" cellpadding="0" cellspacing="0">
<tr bgcolor="f7f7f9"><td><a href="http://calzadosamano.com/" target="_blank"><img src="http://calzadosamano.com/mailing/img/restablececlave1.jpg"  /></a></td></tr>
<tr bgcolor="f7f7f9"><td><a href="http://calzadosamano.com/pages/generaclave.php?u='. $obj->info['0']['usuario'].'" target="_blank"><img src="http://calzadosamano.com/mailing/img/restablececlave2.jpg" /></a></td></tr>
<tr><td align="center"valign="middle" style="background-color:#00a3b4; padding-top:10px;">
 <a href="https://www.facebook.com/pages/Calzados-A-Mano/496423987087853" target="_blank" style="margin-right:20px"><img src="http://calzadosamano.com/mailing/img/redes_facebook.jpg" /></a>
 <a href="https://twitter.com/Calzados_Amano" target="_blank" style="margin-right:20px"><img src="http://calzadosamano.com/mailing/img/redes_twitter.jpg" /></a>
 <a href="https://instagram.com/calzadosamano/" target="_blank"><img src="http://calzadosamano.com/mailing/img/redes_instagram.jpg" /></a>
   </td></tr>
     <tr><td colspan="2" align="center"valign="middle" style="background-color:#00a3b4; padding-bottom:10px;"><a href="http://calzadosamano.com/" target="_blank"><img src="http://calzadosamano.com/mailing/img/web.jpg" /></a></td></tr></table>';

$asunto='Recuperar clave en Calzados A Mano';

if (mail( $_POST['correo'], $asunto , utf8_decode($mensaje), $header)){ ?>
<script>
window.location.href="recuperar.php?e=2";
</script>
<?php
}
?>
