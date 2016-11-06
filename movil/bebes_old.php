<?php include "cabecera.php";
	include "../include/class/producto.php";
	$obj = new producto();
	$obj->loadCategoria('1');
	$n=count($obj->info);?>
<body>
<?php include "menu.php"; ?>
<div id="wrapper">
<div id="intwrapper">

    <div class="titulo">BEB&Eacute;S / <span class="miga">Zapatos</span></div>
<div class="galshoes">
<?php for ($i=0;$i<$n;$i++) : ?>
	<div class="zapato">
        <form action="producto.php" method="post" >
       		<input type="image" src="../images/producto/thumb/<?php echo $obj->info[$i]['thumb']; ?>" class="imgzap" >
            <input name="id" type="hidden" value="<?php echo $obj->info[$i]['id']; ?>">
		</form>
	</div>
<?php endfor; ?>
</div>
</div>
</div>

<script src="../js/script.js"></script>
</body>
</html>
