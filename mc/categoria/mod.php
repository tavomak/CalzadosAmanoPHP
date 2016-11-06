<?php include "zsession.php";
	include "../../include/headers2.php";
	include "../../include/class/categoria.php";

	if ($_GET['action']=='mod') :
		$obj = new categoria();
		$obj->load($_GET['id']);
	endif;
	$class="categoria";

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
          <td width="30"><a href="index.php"><img src="../../images/mc/volver.png" /></a></td>
        </tr>
      </table></td>
    </tr>
  </table>
  <form action="exec.php" name="frm_mod_product" id="frm_mod_product" method="post" enctype="multipart/form-data"  >
          	<table width="800" border="0" cellpadding="2" cellspacing="0" style="margin-left:50px">
            	<tr>
				  <td width="200"><strong>CATEGORIA</strong></td>
   					 <td width="150">&nbsp;</td>
   					 <td width="80">&nbsp;</td>
   					 <td>&nbsp;</td>
   					 <td>&nbsp;</td>
   					 <td>&nbsp;</td>
		      </tr>
              <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
              </tr>

              <tr>
                 <td>Nombre                 </td>
                 <td><input type="text" name="nombre" id="nombre" value="<?php echo $obj->info[0]['nombre']; ?>"></td>
                 <td>&nbsp;</td>
                 <td>&nbsp;</td>
                 <td>&nbsp;</td>
                 <td>&nbsp;</td>
              </tr>
              <tr>
               <td >Imagen </td>
               <td width="150" >en off:<?php if ($_GET['action']=='mod') : ?>
               <img src="<?php echo IMAGENES."categoria/".$obj->info[0]['image_off']; ?>" style="max-width:150px;"/>
			   <?php endif; ?><input type="file" name="image_off" id="image_off" ></td>
               <td >en on:<?php if ($_GET['action']=='mod') : ?>
               <img src="<?php echo IMAGENES."categoria/".$obj->info[0]['image_on']; ?>" style="max-width:150px;"/>
			   <?php endif; ?><input type="file" name="image_on" id="image_on" ></td>
               <td >Dimensiones<br>
                 400 X 300</td>
               <td >&nbsp;</td>
               <td >&nbsp;</td>
              </tr>

              <tr>
               <td >Posicion</td>
               <td><input name="posicion" type="text" id="posicion" size="6" value="<?php echo $obj->info[0]['posicion']; ?>"></td>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
             </tr>
             <tr>
               <td colspan="6" ><table width="300" border="0" cellspacing="0" cellpadding="0">
                 <tr>
                   <td width="80" align="right">Preview</td>
                   <td width="30"><input name="preview" type="checkbox" id="preview" value="1" <?php if ($obj->info[0]['preview']=="1") : echo 'checked="checked"'; endif; ?> /></td>
                   <td width="80" align="right">Activado</td>
                   <td width="30"><input name="activado" type="checkbox" id="activado" value="1" <?php if ($obj->info[0]['activado']=="1") : echo 'checked="checked"'; endif; ?> /></td>
                   <td width="80" align="right"><input type="hidden" id="action" name="action" value="<?php echo $_REQUEST['action']; ?>" />
                     <input type="hidden" id="id" name="id" value="<?php echo $obj->info[0]['id']; ?>" />
                   Aceptar </td>
                   <td width="30"><input type="image" src="../../images/mc/ok.png" /></td>
                 </tr>
               </table></td>
              </tr>
            <tr>
  				  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td >&nbsp;</td>
                  <td >&nbsp;</td>
                  <td >&nbsp;</td>

          </table>

      </form>
</DIV></DIV></DIV>
</BODY>
</HTML>
