<nav id="redes">
	<a href="registrarse.php" class="boton btn_registrarse"></a>
    <?php if (!isset($_SESSION['user'])){ ?>
		<a href="iniciar.php" class="boton btn_sesion"></a>
     <?php } else { ?>
         <a href="logout.php" class="boton btn_cerrar_sesion"></a>  <?php } ?>

     <a href="https://www.facebook.com/pages/Calzados-A-Mano/496423987087853" class="boton btn_facebook" target="_blank"></a>
     <a href="https://twitter.com/Calzados_Amano" class="boton btn_twitter" target="_blank"></a>
     <a href="https://instagram.com/calzadosamano/" class="boton btn_instagram" target="_blank"></a>
     <a href="mispedidos.php" class="boton btn_carrito" ></a> <span style="color: #009999; margin-left:10px; font-weight:bold;"><?php echo $_SESSION['articulos'];?></span>
</nav>
