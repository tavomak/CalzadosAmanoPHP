<?php session_start();
	include "../../include/configure.php";
	include "../../include/database_tables.php";
	include "../../include/functions/database.php";
	include "../../include/class/usuario.php";

	$obj = new usuario();
	$obj->load_usuario($_POST['usuario']);

	if (count($obj->info)==0){
		header('location: ../index.php');
		exit();
	}

	if (($obj->info[0]['clave']==md5($_POST['clave']))&& (($obj->info[0]['empleado']=='1')||($obj->info[0]['empleado']=='2'))) {
		$_SESSION['tipoUser']=$obj->info[0]['empleado'];
		$_SESSION['user']=$obj->info[0]['usuario'];
		if ($obj->info[0]['empleado']=='1'):
			header('location: ../mc.php');
		else:
			header('location: ../inventario/index.php');
		endif;
		exit();
	 ?>
        <script>
		alert("Comuniquese con el Administrador");
		</script>
        <?php
	}

	//La clave no coincide
	header('location: ../index.php');

?>
