<?php session_start();

	if (!isset($_SESSION['user'])){
		header('location: iniciar.php');
		exit();
	}

	$cantidad=$_SESSION['cantidad'];

	settype($_GET['id'],'integer');
	$id=$_GET['id'];
	$_SESSION['articulos']=$_SESSION['articulos']-$cantidad[$id];
	$cantidad[$id]=0;

	$_SESSION['cantidad']=$cantidad;

	$n=count($cantidad);

	$x=0;
	for ($i=0;$i<$n;$i++):

	if ($cantidad[$i]==0) :
		continue;
	endif;
	$x+=1;
	endfor;

	if ($x==0):
		header('location: mispedidos.php');
		exit();
	endif;

	header('location: mispedidos.php');
?>
