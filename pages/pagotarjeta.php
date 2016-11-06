<?php
/* session_start();
	if (!isset($_SESSION['user'])){
		header('location: resultado.php?e=1');
		exit();
	}*/
	?>
<!DOCTYPE html>
<html lang="es" class="no-js">
<head>
	<meta charset="UTF-8" />
 <?php
function solonumeros($x){
	//compruebo que los caracteres sean los permitidos
   $permitidos = "0123456789";
   for ($i=0; $i<strlen($x); $i++){
      if (strpos($permitidos, substr($x,$i,1))===false){
         return false;
      }
   }
   return true;
}

if ((strlen($_POST["Amount"])==0) || (strlen($_POST['CardHolder'])==0)||(strlen($_POST["Cedula"])==0)||(strlen($_POST['CardNumber'])==0)||(strlen($_POST['CVC'])==0)||(strlen($_POST['mes'])==0)||(strlen($_POST['ano'])==0)){?>
<script>
	window.location.href="resultado.php?e=3";
</script>

<?php }

if ((strlen($_POST['CardNumber'])<15)||(strlen($_POST['CVC'])<3)|| (strlen($_POST['Cedula'])<6)){?>
<script>
	window.location.href="resultado.php?e=4";
</script>

<?php
exit();
}

if (solonumeros($_POST['CardNumber'])){
} else {?>
<script>
	window.location.href="resultado.php?e=4";
</script>
<?php
exit();
}
if (solonumeros($_POST['CVC'])){
} else {?>
<script>
	window.location.href="resultado.php?e=4";
</script>
<?php  exit();
}

if (($_POST['mes']<=date('m')) && ($_POST['ano']==date('Y'))){?>
<script>
	window.location.href="resultado.php?e=4";
</script>
<?php  exit();
}
$patron="ABCDEFGHIJKLMNÑOPQRSTUVWXYZabcdefghijklmnñopqrstuvwxyz";
$porciones = explode(" ", $_POST['CardHolder']);
for ($i=0;$i<count($porciones);$i++) {
	for ($j=0;$j<strlen($porciones[$i]);$j++) {
		$caracter=substr($porciones[$i],$j,1);
		if (strstr($patron,$caracter)){
			//ok
		}else {?>
	<script>
	window.location.href="resultado.php?e=4";
	</script>
	<?php  exit();
		}
	}
}

if ($_POST['acepto']!='1') {?>
	<script>
	window.location.href="resultado.php?e=5";
	</script>
	<?php
}

$url = 'https://api.instapago.com/payment';
$fields = array("KeyID" => $_POST['KeyId'] ,
		 "PublicKeyId" => $_POST['PublicKeyId'],
		 "Amount" => floatval($_POST["Amount"]),
		 "Description"  => $_POST['Description'],
		 "CardHolder"=> $_POST['CardHolder'],
		 "CardHolderId"=>$_POST["Cedula"],
		 "CardNumber" => $_POST['CardNumber'],
		 "CVC" => $_POST['CVC'],
		 "ExpirationDate" => $_POST['mes']."/".$_POST['ano'],
		 "StatusId" => "2");
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url );
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($fields));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec ($ch);
curl_close ($ch);

$json_clientes = json_decode($server_output, true);
//print_r( $json_clientes)."<br>";

$i=0;
foreach ($json_clientes as $cliente) {
    $resultado[$i]=$cliente;
	$i++;
}

$sucess=$resultado[0];
$message= $resultado[1];
$id=$resultado[2];
$code=$resultado[3];
$reference=$resultado[4];
$voucher=$resultado[5];
$ordernumber=$resultado[6];
$sequence=$resultado[7];
$lote==$resultado[8];

if ($code>="400") {?>
	<script>
	window.location.href="resultado.php?e=6";
	</script>
	<?php 	exit(); }

include "../include/configure.php";
include "../include/database_tables.php";
include "../include/functions/database.php";
include "../include/class/usuario.php";
include "../include/class/producto.php";
include "../include/class/pedidos.php";

$pedido=new pedidos();
$pedido->cambiarEstado($_POST["idFactura"],'1');
$pedido->load($_POST["idFactura"]);

$obj= new usuario();
$obj->infoUser($pedido->info[0]['id_usuario']);

/*$zapato=new  producto();
$pedido->loadItems($_POST["idFactura"]);
for ($i=0;$i<count($pedido->items);$i++){
	$precio=$zapato->loadTallaProd($pedido->items[$i]['id_producto'],$pedido->items[$i]['talla']);
	$inventario=$precio[0]['cantidad']-$pedido->items[$i]['cantidad'];
	$zapato->modCantidad($precio[0]['id'],$inventario);
}
*/

$correo ='Orden Nro. '. $_POST["idFactura"].'<br>';
$correo .='de '. $obj->info[0]['nombre'].'<br>';
$correo .='Tel&eacute;fono '. $obj->info[0]['telefono'].'<br>';
$correo .='Correo '. $obj->info[0]['correo'].'<br>';
$correo .= html_entity_decode($voucher);


$correouser ='<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td align="center" ><a href="http://calzadosamano.com/" target="_blank"><img src="http://calzadosamano.com/mailing/img/pago-verificado.jpg" /></a></td></tr>';
$correouser.='<tr><td  align="center" valign="middle"><table><tr><td>'.html_entity_decode($voucher).'</td></tr></table></td></tr>';
$correouser.='<tr><td  align="center" valign="middle" style="background-color:#00a3b4">
 <a href="https://www.facebook.com/pages/Calzados-A-Mano/496423987087853" target="_blank" style="margin-right:20px"><img src="http://calzadosamano.com/mailing/img/redes_facebook.jpg" /></a>
 <a href="https://twitter.com/Calzados_Amano" target="_blank" style="margin-right:20px"><img src="http://calzadosamano.com/mailing/img/redes_twitter.jpg" /></a>
 <a href="https://instagram.com/calzadosamano/" target="_blank"><img src="http://calzadosamano.com/mailing/img/redes_instagram.jpg" /></a>
   </td></tr>
     <tr><td align="center"valign="middle" style="background-color:#00a3b4"><a href="http://calzadosamano.com/" target="_blank"><img src="http://calzadosamano.com/mailing/img/web.jpg" /></a></td></tr></table>';

$email = $obj->info[0]['correo'];

$header = 'From: Calzados A Mano <info@calzadosamano.com>,';
$header .= "Mime-Version: 1.0 \r\n";
$header .= "Content-Type: text/html; charset=iso-8859-1";

$para="info@calzadosamano.com";

//

if (mail($para, "Pago Orden Nro. ".  $_POST["idFactura"], utf8_decode($correo), $header)){
	mail($email, "Pago Orden Nro. ". $_POST["idFactura"] , utf8_decode($correouser), $header);
}

?>

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
    <script language="Javascript">
function imprSelec(nombre)
{
  var ficha = document.getElementById(nombre);
  var ventimp = window.open(' ', 'popimpr');
  ventimp.document.write( ficha.innerHTML );
  ventimp.document.close();
  ventimp.print( );
  ventimp.close();
}
</script>
 </head>

<body>
	<div id="wrapper" >
    	<div id="intwrapper" style="height:auto;">
        	<header>
            <div id="logo"><a href="../index.php"><img src="../images/logo.png" width="207" height="66"></a></div>
            <?php include "redes.php"; ?>

            <div class="separador"></div>
                <nav id="menu">
                 <?php $pages=$_SERVER['PHP_SELF'];
				include "menu.php"; ?>
                </nav>
            </header>
            <div class="container" align="center" >
        	<section id="centro" style="padding-top:40px;">
            <?php echo html_entity_decode($voucher); ?>
            <br><br>
            <a href="javascript:imprSelec('voucher')" class="btn_imprimir"></a>

            </section>
 		</div>
 	</div>
    <?php include "footer.php"; ?>
    </div>
 </body>
 </html>

