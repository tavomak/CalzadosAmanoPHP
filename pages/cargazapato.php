<?php if ($_GET['nuevo']=='1') : ?><div class="nuevo" style="position: absolute;  width: 60px; height:40px; top: 15%; left: 28%;  background-image:url(../images/nuevo_g.png);color:#FFF; display:block; font-weight:900; padding-top:20px;">NUEVO</div><?php endif; ?>
   <?php if (strlen($_GET['descuento'])>0) : ?><div class="descuento" style="position: absolute; width: 60px; height:50px; top: 15%; left: 28%;background-image:url(../images/descuentos_g.png); background-size:cover; color:#FFF; display:block; font-weight:300; padding-top:10px; font-size:1.8em; text-align:center;"><?php echo $_GET['descuento']; ?></div><?php endif; ?>

<script src="../js/jquery.js"></script>
    <script src="../js/jquery.imageLens.js"></script>
    <script type="text/javascript" language="javascript">
		$(function () {
			$("#zapato").imageLens({ lensSize: 300, borderSize: 0 });
		});
	</script>

<img  src="../images/producto/vistas/big/<?php echo $_GET['zapato']; ?>" id="zapato" >


