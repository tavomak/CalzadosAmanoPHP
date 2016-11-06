<?php session_start();
if (!isset($_SESSION['tipoUser'])){
	header('location: ../index.php');
}
if ($_SESSION['tipoUser']!='1'){
	header('location: ../index.php');
}
?>
