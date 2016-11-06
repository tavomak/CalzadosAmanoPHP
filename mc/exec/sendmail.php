<?php
include "../../include/configure.php";
	include "../../include/database_tables.php";
	include "../../include/functions/database.php";
	include "../../include/class/usuario.php";

	if (strlen($_POST['email'])==0){ ?>
    <script>
	alert("No coloco el email");
	</script>

	<?php	header('location: ../index.php');
		exit();
	}

	$obj = new usuario();
	$obj->load_superusuario();

	$header = 'From: '. $_POST['email'] . '\r\n';
	$header .= "Mime-Version: 1.0\r\n";
	$header .= "Content-Type: text/html; charset=iso-8859-1";
	$mensaje='Cambiar  Clave<br><br>Email: '.  $_POST['email'] ;
	mail($obj->info[0]['email'],'Olvido sus datos',$mensaje,$header);
		?>
    <script>
			alert("El email ha sido enviado, pronto le responderemos");
			window.location.href='../index.php';
	</script>
	<?php
	exit();

?>
