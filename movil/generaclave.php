<?php include "cabecera.php";
include "../include/class/usuario.php";
$obj = new usuario();
$obj->load_usuario($_GET['u']);
if (count($obj->info)==0) { ?>
<script>
	window.location.href="http://www.calzadosamano.com/movil/";
</script>
<?php exit();
} ?>

<script>
	function enviarDatos(){
			document.forms["formRecuperar"].submit();
	}
</script>
<script src="../js/amano.js"></script>
<body>
<?php include "menu.php"; ?>
<div id="wrapper">
<?php if ((isset($_GET['e'])) && ($_GET['e']==1)) : ?>
     <div style="height:300px;" id="marco" > <div id="resultado" style="display:block;" onClick="javascript: quitarMarco();">Debes llenar todos los campos</div></div>
 <?php endif;
  if ((isset($_GET['e'])) && ($_GET['e']==2)) : ?>
   <div style="height:300px;" id="marco"  >   <div id="resultado" style="display:block;" onClick="javascript: quitarMarco();" >Confirme la contrase&ntilde;a</div></div>
 <?php endif;
 if ((isset($_GET['e'])) && ($_GET['e']==3)) : ?>
   <div style="height:300px;" id="marco"  >   <div id="resultado" style="display:block;" onClick="javascript: window.location.href='iniciar.php'">Tu clave ha sido modificada exitosamente</div></div>
 <?php endif; ?>
<div id="intwrapper">
<span class="titulo">RECUPERAR CLAVE</span><br>
        	<section id="centroinicia">
       	 	  <form id="contacto" name="contacto" action="registraclave.php" method="post" style="float:none;">
              Tu usuario es: <?php echo $_GET['u']; ?>


   <input name="clave" id="clave"  type="password"  placeholder="*Escribe tu nueva clave">
    <input name="repiteclave"  type="password" id="repiteclave" placeholder="*Repite tu nueva clave" >
   <input name="u" type="hidden" value="<?php echo $_GET['u']; ?>">
 <div class="fondoCampo"> <p class="descripcion" ><a href="javascript: enviarDatos();" class="boton">Enviar</a></p> </div>

                  </form>
            </section>
</div>  <!-- fin intwrapper -->
</div>       <!-- fin wrapper -->
<script src="../js/script.js"></script>
</body>
</html>
