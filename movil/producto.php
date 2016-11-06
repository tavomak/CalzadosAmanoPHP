<?php include "cabecera.php";
	include "../include/class/producto.php";
	settype($_POST['id'],'integer')	;
	$id=$_POST['id'];
	$obj = new producto();
	$obj->load($id);
	settype($_POST['id_zapato'],'integer')	;
	$id_zapato=$_POST['id_zapato'];
?>
<body>
<?php include "menu.php"; ?>


	 <?php if (($obj->info[0]['categoria']>='5') || ($obj->info[0]['categoria']=='10')|| ($obj->info[0]['categoria']=='11')|| ($obj->info[0]['categoria']=='12')|| ($obj->info[0]['categoria']=='13')|| ($obj->info[0]['categoria']=='14')) :
	   	if (($obj->info[0]['categoria']=='5') || ($obj->info[0]['categoria']=='9')|| ($obj->info[0]['categoria']=='8')) : ?>
	<iframe frameborder="0" height="1200" width="100%" scrolling="no" src="detaplantilla.php?id=<?php echo $id;?>&id_zapato=<?php echo $id_zapato; ?>"></iframe>
	<?php else: ?>
	<iframe frameborder="0" height="1200" width="100%" scrolling="no" src="detaccesorio.php?id=<?php echo $id;?>"></iframe>
         <?php endif; ?>
  <?php else: ?>
	<iframe frameborder="0" height="1200" width="100%" scrolling="no" src="detalle.php?id=<?php echo $id;?>"></iframe>
<?php endif; ?>

<script src="../js/script.js"></script>
</body>
</html>
