<?php include "cabecera.php";
	include "../include/class/producto.php";
	settype($_GET['id_categoria'],'integer')	;
	$id_categoria=$_GET['id_categoria'];
	$obj = new producto();
	$obj->loadCategoria($id_categoria);
	$id=$obj->info[0]['id'];
	settype($_GET['id_zapato'],'integer')	;
	$id_zapato=$_GET['id_zapato'];
?>
<body>
<?php include "menu.php"; ?>
<iframe frameborder="0" height="1000" width="100%" scrolling="no" src="detaplantilla.php?id=<?php echo $id;?>&id_zapato=<?php echo $id_zapato; ?>"></iframe>
<script src="../js/script.js"></script>
</body>
</html>
