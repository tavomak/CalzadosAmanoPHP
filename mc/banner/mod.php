<?php include "zsession.php";
	include "../../include/headers2.php";
	include "../../include/class/banner.php";

	if ($_GET['action']=='mod') :
		$obj = new banner();
		$obj->load($_GET['id']);
	endif;
	$class="banner";

?>

<body>
<div id="wrapper">
<header><div  id="logo" > Administrador de Contenido</div></header>
    <div id="intwrapper">
    <div id="menu" >
				<?php include "../menu.php"; ?>
    </div>
<div id="content">
  <table width="800" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td><table class="fr" width="150" border="0" cellspacing="0" cellpadding="5">
        <tr>
          <td align="right"><a href="index.php">Volver</a></td>
          <td width="30"><a href="index.php"><img src="<?php echo IMAGENES; ?>mc/volver.png" /></a></td>
        </tr>
      </table></td>
    </tr>
  </table>
  <form action="exec.php" name="frm_mod_product" id="frm_mod_product" method="post" enctype="multipart/form-data"  >
          	<table width="800" border="0" cellpadding="2" cellspacing="0" style="margin-left:50px">
            	<tr>
				  <td><strong>BANNER</strong></td>
   					 <td colspan="2">&nbsp;</td>
			  </tr>
              <tr>
                  <td>&nbsp;</td>
                  <td colspan="2">&nbsp;</td>
              </tr>

              <tr>
                <td>Titulo</td>
                <td colspan="2"><input name="titulo" id="titulo" type="text" value="<?php echo $obj->info[0]['titulo']; ?>"></td>
              </tr>

              <tr>
                <td >Imagen</td>
                <td colspan="2"><?php if (strlen($obj->info[0]['imagen'])>0) : ?>
               <img src="<?php echo IMAGENES."banner/".$obj->info[0]['imagen']; ?>" style="max-width:150px;"/>
               <a href="exec.php?id=<?php echo $obj->info[0]['id']; ?>&action=delt">
                  <img src="<?php echo IMAGENES;?>mc/eliminar.png" alt="Eliminar" width="20" height="20"></a>
                  <?php endif; ?>
				  <input type="file" name="imagen" id="imagen" ></td>
              </tr>
             <tr>
                <td>Enlace</td>
                <td colspan="2"><input name="enlace" id="enlace" type="text" value="<?php echo $obj->info[0]['enlace']; ?>"></td>
              </tr>
              <tr>
                <td>Posici&oacute;n</td>
                <td colspan="2"><input name="posicion" id="posicion" type="text" value="<?php echo $obj->info[0]['posicion']; ?>"></td>
              </tr>
              <tr>
               <td >&nbsp;</td>
               <td colspan="2" >Activado
               <input name="activado" type="checkbox" id="activado" value="1" <?php if ($obj->info[0]['activado']=="1") : echo 'checked="checked"'; endif; ?> /></td>
              </tr>
            <tr>
  				  <td>&nbsp;</td>
                  <td colspan="2"><input type="hidden" id="action" name="action" value="<?php echo $_REQUEST['action']; ?>" />
                    <input type="hidden" id="id" name="id" value="<?php echo $obj->info[0]['id']; ?>" />
Aceptar
<input type="image" src="<?php echo IMAGENES; ?>mc/ok.png" /></td>
          </table>

      </form>
</DIV></DIV></DIV>
</BODY>
</HTML>
