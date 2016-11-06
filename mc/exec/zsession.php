<?php session_start();
if (!isset($_SESSION['tipoUser'])){
	header('location: index.php');
}
?>
