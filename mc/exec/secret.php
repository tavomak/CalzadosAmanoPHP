<?php
include "../../include/configure.php";
	include "../../include/database_tables.php";
	include "../../include/functions/database.php";
	include "../../include/class/usuario.php";

	$obj = new usuario();
	$obj->load_usuario($_POST['usuario']);

	if (count($obj->info)==0){ ?>
    <script>
	alert("Lo sentimos, usuario o respuesta no coincide");
	window.location.href='../index.php';
	</script>

	<?php
		exit();
	}

	if ($obj->info[0]['respuesta']==$_POST['respuesta']) {
		$newClave=rand(1001,9999);
		$obj->mod_soloclaveusuario($_POST['usuario'],$newClave);

		$header = 'From: info@calzadosamano.com  \r\n';
		$header .= "Mime-Version: 1.0 \r\n";
		$header .= "Content-Type: text/html; charset=iso-8859-1";
		$mensaje='Cambio de Clave \r\n \r\nEstimado \r\n' .$obj->info[0]['nombre_usuario'].' \r\n \r\nEstamos enviando su nueva clave de acceso debido al olvido manifestado por usted,\r\n \r\n Clave:'.$newClave.' \r\n \r\nLe recomendamos notifique al administrador para una clave mas fuerte, más aún si usted no ha solicitado le enviemos su clave<br><br>Recuerde también mantener actualizada la dirección de correo, ya que es la única vía para tenerle informado.';
		mail($obj->info[0]['email'],'Recuperacion de clave',$mensaje,$header);

		echo '<script>
			alert("La clave ha sido enviada a su email");
			window.location.href="../index.php";
		</script>';
		exit();
	} else {
		//La respuesta no coincide ?>
		<script>
		alert("Lo sentimos, usuario o respuesta no coincide");
		window.location.href='../index.php';
		</script>
	<?php	}
?>
