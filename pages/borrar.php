<?php session_start();
$_SESSION['zapato']=array();
$_SESSION['talla']=array();
$_SESSION['cantidad']=array();
$_SESSION['precio']=array();
$_SESSION['articulos']=0;
$_SESSION['tarifa']='';
$_SESSION['estado']= '';
$_SESSION['ciudad']='';
$_SESSION['telefono']='';
$_SESSION['persona']='';
$_SESSION['agencia']='';
$_SESSION['direccion']='';
header('location: mispedidos.php');
?>
