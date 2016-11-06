<script>
function abritBebe(){
	$(".nav li#menuBebe ul").css({"left":"0","position":"relative","display":"block"});
	$(".nav li#menuBoys ul").css({"left":"-99999","display":"none"});
	$(".nav li#menuGirl ul").css({"left":"-99999","display":"none"});
}

function abritBoy(){
	$(".nav li#menuBoys ul").css({"left":"0","position":"relative","display":"block"});
	$(".nav li#menuBebe ul").css({"left":"-99999","display":"none"});
	$(".nav li#menuGirl ul").css({"left":"-99999","display":"none"});
}

function abritGirl(){

	$(".nav li#menuGirl ul").css({"left":"0","position":"relative","display":"block"});
	$(".nav li#menuBebe ul").css({"left":"-99999","display":"none"});
	$(".nav li#menuBoys ul").css({"left":"-99999","display":"none"});
}
</script>
<div class="header">
	<div class="redes"><a href="https://www.facebook.com/pages/Calzados-A-Mano/496423987087853" target="_blank"><img src="../images/movil/fb.png" width="37" height="34" /></a>
    <a href="https://twitter.com/Calzados_Amano" target="_blank"><img src="../images/movil/tw.png" width="38" height="34"  style="margin-left:30px; margin-right:30px;"/></a>
    <a href="https://instagram.com/calzadosamano/" target="_blank"><img src="../images/movil/ins.png" width="38" height="34" /></a>

  </div>

    <div class="cintaMenu" >
    	<a href="#" class="menu-trigger ss-icon" style="float:left; padding-left:20px;"><img src="../images/movil/menu.png" width="30"  /></a>
        <a href="index.php" id="logo" style="margin-left:-50px;"><img src="../images/movil/logo.png" width="100" /></a>
        <?php if (!isset($activalo)){ ?>
        <a href="mispedidos.php" class="btn_carrito"><img src="../images/movil/btn_carrito.png" width="35"  /><div class="caption"><?php echo $_SESSION['articulos'];?></div></a><?php } else { ?>
        <a href="mispedidos.php" class="btn_carrito"><img src="../images/movil/btn_cart_d.png" width="35"  /><div class="caption"><?php echo $_SESSION['articulos'];?></div></a>
        <?php } ?>


     </div>


<ul class="nav" style="display:none; height:100%;overflow-x:hidden;overflow-y:scroll;-webkit-overflow-scrolling:touch;" >
<li><?php if (!isset($_SESSION['user'])){ ?><a href="iniciar.php" style="background-image:url(../images/pix_azul.jpg);">INICIAR SESI&Oacute;N</a>
     <?php } else { ?>
     <a href="logout.php"  style="background-image:url(../images/pix_azul.jpg);">CERRAR SESI&Oacute;N</a><?php } ?></li>

	<li id="menuBebe" >
		<a href="javascript: abritBebe();" style="background-image:url(../images/pix_azul.jpg);">BEB&Eacute;S</a>
		<ul>
			<li><a href="bebes.php" >Zapatos</a></li>
			<li><a href="lazosb.php">Lazos</a></li>
			<li><a href="cintillosb.php">Bandanas</a></li>
			<li><a href="pijamasb.php">Pijamas</a></li>
		</ul>
	</li>
    <li id="menuGirl">
		<a href="javascript: abritGirl();" style="background-image:url(../images/pix_azul.jpg);" >DAMAS/NI&Ntilde;AS</a>
		<ul>
			<li><a href="girls.php">Zapatos</a></li>
			<li><a href="lazosg.php">Lazos</a></li>
			<li><a href="cintillosg.php">Bandanas</a></li>
			<li><a href="pijamasg.php">Pijamas</a></li>
		</ul>
	</li>
	<li id="menuBoys">
		<a href="javascript: abritBoy();"style="background-image:url(../images/pix_azul.jpg);">NI&Ntilde;OS</a>
		<ul>
			<li><a href="boys.php">Zapatos</a></li>
			<li><a href="pijamaso.php">Pijamas</a></li>
		</ul>
	</li>


	<li><a href="colegial.php"  style="background-image:url(../images/pix_azul.jpg);">ESCOLARES</a></li>
	<li><a href="nosotros.php"  style="background-image:url(../images/pix_azul.jpg);">NUESTRAS MANOS</a></li>
	<li><a href="mispedidos.php"  style="background-image:url(../images/pix_azul.jpg);">MIS PEDIDOS</a></li>
	<li><a href="contacto.php"  style="background-image:url(../images/pix_azul.jpg);">CONTACTO</a></li>

</ul>

</div>
