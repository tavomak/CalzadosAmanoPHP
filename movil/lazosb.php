<?php include "cabecera.php";
	include "../include/class/producto.php";
	$obj = new producto();
	$obj->loadAccesorios('6');
	$n=count($obj->info);?>
<body>
<?php include "menu.php"; ?>
<div id="wrapper">
<div id="intwrapper">

    <div class="titulo">BEB&Eacute;S / <span class="miga">Lazos</span></div>
<div class="galshoes">
<?php for ($i=0;$i<$n;$i++) : ?>
	<div class="zapato">
        <form action="producto.php" method="post" >
       		<input type="image" src="../images/producto/thumb/<?php echo $obj->info[$i]['thumb']; ?>" class="imgzap" >
              <?php if ($obj->info[$i]['nuevo']=='1') : ?><div class="nuevo">NUEVO</div><?php endif; ?>
                    <?php if (strlen($obj->info[$i]['descuento'])>0) : ?><div class="descuento"><?php echo $obj->info[$i]['descuento']; ?></div><?php endif; ?>
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
