<?php
	include "../../include/configure.php";
	include "../../include/database_tables.php";
	include "../../include/functions/database.php";
	include "../../include/class/pedidos.php";
	include "../../include/class/producto.php";
	include "../../include/class/talla.php";

	$obj=new pedidos();
	$obj->load($_GET['id']);
	$n=count($obj->items);

	$zap=new producto();
	$size=new talla();
?>


<table width="100%" border="0">
  <tr>
    <td width="25%" align="center">Producto</td>
    <td width="25%" align="center">Nombre</td>
    <td width="25%" align="center">Talla</td>
    <td width="25%" align="center">Cantidad</td>

  </tr>

  <?php for ($i=0;$i<$n;$i++):
  $zap->load($obj->items[$i]['id_producto']);
  $size->load($obj->items[$i]['talla']);
  ?>

  <tr>
    <td><img  src="../../images/producto/thumb/<?php echo $zap->info[0]['thumb']; ?>" width="25%"></td>
	<td align="center"><?php echo $zap->info[0]['nombre']; ?></td>
    <td align="center"><?php echo $size->info[0]['name']; ?></td>
    <td align="center"><?php echo $obj->items[$i]['cantidad']; ?>
    </td>
  </tr>

  <?php endfor; ?>

</table>




