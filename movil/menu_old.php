<script>
function abritBebe(){
	$(".nav li#menuBebe ul").css({"left":"0","position":"relative","display":"block"});
	$(".nav li#menuBoys ul").css({"left":"-99999","display":"none"});
}
function abritBoy(){
	$(".nav li#menuBoys ul").css({"left":"0","position":"relative","display":"block"});
	$(".nav li#menuBebe ul").css({"left":"-99999","display":"none"});

}
</script>
<div class="header">
	<div class="redes"><img src="../images/movil/redes.jpg" width="80" usemap="#Map" border="0" />
      <map name="Map">
        <area shape="rect" coords="4,0,20,37" href="https://www.facebook.com/pages/Calzados-A-Mano/496423987087853" target="_blank" alt="facebook">
        <area shape="rect" coords="28,2,50,28" href="https://twitter.com/Calzados_Amano" target="_blank" alt="twitter">
        <area shape="rect" coords="58,2,113,28" href="https://instagram.com/calzadosamano/" target="_blank" alt="Instagram">
      </map>
  </div>

    <div class="cintaMenu" >
    	<a href="#" class="menu-trigger ss-icon" style="float:left;"><img src="../images/movil/menu.png" width="30"  /></a>
        <a href="index.php" id="logo"><img src="../images/movil/logo.png" width="100" /></a>
        <?php if (!isset($activalo)){ ?>
        <a href="mispedidos.php" class="btn_carrito"><img src="../images/movil/btn_carrito.png" width="35"  /><div class="caption"><?php echo $_SESSION['articulos'];?></div></a><?php } else { ?>
        <a href="mispedidos.php" class="btn_carrito"><img src="../images/movil/btn_cart_d.png" width="35"  /><div class="caption"><?php echo $_SESSION['articulos'];?></div></a>
        <?php } ?>


     </div>
<ul class="nav" style="display:none;">
<li><?php if (!isset($_SESSION['user'])){ ?><a href="iniciar.php"  style="background-image:url(../images/movil/menu_back.png);">INICIAR SESI&Oacute;N</a>
     <?php } else { ?>
     <a href="logout.php"  style="background-image:url(../images/movil/menu_back.png);">CERRAR SESI&Oacute;N</a><?php } ?></li>

	<li id="menuBebe" >
		<a href="javascript: abritBebe();" style="background-color: rgba(0, 144, 158, 0.9);">BEB&Eacute;S</a>
		<ul>
			<li><a href="bebes.php" >Zapatos</a></li>
			<li><a href="lazosb.php">Lazos</a></li>
			<li><a href="cintillosb.php">Bandanas</a></li>
			<li><a href="pijamasb.php">Pijamas</a></li>
		</ul>
	</li>
	<li id="menuGirls">
		<a href="#" style="background-color: rgba(0, 144, 158, 0.9);" >DAMAS/NI&Ntilde;AS</a>
		<ul>
			<li><a href="girls.php">Zapatos</a></li>
			<li><a href="lazosg.php">Lazos</a></li>
			<li><a href="cintillosg.php">Bandanas</a></li>
			<li><a href="pijamasg.php">Pijamas</a></li>
		</ul>
	</li>
	<li id="menuBoys">
		<a href="javascript: abritBoy();" style="background-color: rgba(0, 144, 158, 0.9);">NI&Ntilde;OS</a>
		<ul>
			<li><a href="boys.php">Zapatos</a></li>
			<li><a href="pijamaso.php">Pijamas</a></li>
		</ul>
	</li>
	<li><a href="colegial.php"  style="background-color: rgba(0, 144, 158, 0.9);">ESCOLARES</a></li>
	<li><a href="nosotros.php"  style="background-color: rgba(0, 144, 158, 0.9);">NUESTRAS MANOS</a></li>
	<li><a href="mispedidos.php"  style="background-color: rgba(0, 144, 158, 0.9);">MIS PEDIDOS</a></li>
	<li><a href="contacto.php"  style="background-image:url(../images/movil/menu_back.png);">CONTACTO</a></li>

</ul>





</div>
