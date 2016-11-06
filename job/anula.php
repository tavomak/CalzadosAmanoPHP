<?php  date_default_timezone_set('America/Caracas') ;

include "/home/calzado1/public_html/include/configure.php";
include "/home/calzado1/public_html/include/database_tables.php";
include "/home/calzado1/public_html/include/functions/database.php";
include "/home/calzado1/public_html/include/class/pedidos.php";

//Buscar pedidos
$obj = new pedidos();
$obj->loadPedidoOffline();
$fp = fopen("/home/calzado1/public_html/job/log.txt", "a+");
fwrite($fp,"----------------------------------------\n\n" );
fwrite($fp, date("Y-m-d H:i:s",time())." Resumen Pedidos Anulados\n\n" );
$k=0;
for ($j=0;$j<count($obj->info);$j++) {
	$fecha=time();
	$date1=date ("Y-m-d H:i:s",$fecha);
	$date2=$obj->info[$j]["fecha"];
	$s = strtotime($date1)-strtotime($date2);
	$d = intval($s/86400);
	$s -= $d*86400;
	$h = intval($s/3600);
	$dif= (($d*24)+$h);
	if ($dif > 6) {
		$obj->anu($obj->info[$j]['id']);
		fwrite($fp, date("Y-m-d H:i:s",time())." Anulado pedido ". $obj->info[$j]['id']. "\n" );
		$k++;
	}
}
fwrite($fp, "\n".date("Y-m-d H:i:s",time())." Total Anulados: ". $k. "\n\n" );
fclose($fp);
?>
