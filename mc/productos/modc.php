<?php
	include "../../include/configure.php";
	include "../../include/database_tables.php";
	include "../../include/functions/database.php";
	tep_db_connect();
	$criterio = "id='".$_GET["id"]."'";
	$listaSel = searchList($criterio,NULL,NULL,NULL,"*",TABLE_CATALOGO);
?>


</head>
<BODY>
<div id="wrapper">

	<div id="intwrapper">

		<div id="content">
			<p id="about_titulo">
        	 Imágenes
          </p>
        	<form action="exec.php" name="frm_mod_banner" id="frm_mod_banner" method="post" enctype="multipart/form-data" onSubmit="javascript: return isempty();" >
        	  <table cellspacing="0" >
        	    <tr>
        	      <th width="97" align="left"></th>
        	      <th width="285" align="left"> Imagen Zoom        	        <?php

				?>
      	        </th>
        	      <th width="107" align="right">&nbsp;</th>
        	      <th width="463" align="left">Imagen Peque&ntilde;a</th>
      	      </tr>
        	 <tr>
             </tr>

        	    <tr>
        	      <td valign="top">&nbsp;</td>
        	      <td><input type="file" name="big" id="big" >
       	          </td>
        	      <td>&nbsp;</td>
        	      <td><input name="thumb" type="file" id="thumb" size="15" ></td>
      	      </tr>

        	    <?php  if($_REQUEST['action']  == "modc") : ?>
        	    <tr>
        	      <td valign="top">&nbsp;</td>
        	      <td><?php if (strlen($listaSel[0]['big'])>0) : ?>
                  <img src="<?php echo IMAGENES.'producto/vistas/big/'.$listaSel[0]['big'];?>" alt="" height="100">

                  <?php endif; ?></td>
        	      <td>&nbsp;</td>
        	      <td><?php if (strlen($listaSel[0]['thumb'])>0) : ?>
                  <img src="<?php echo IMAGENES.'producto/vistas/thumb/'.$listaSel[0]['thumb'];?>" alt="" height="100">

                  <?php endif; ?></td>
      	      </tr>
        	    <?php endif; ?>
        	    <tr>
        	      <td align="left" valign="top" nowrap>&nbsp;</td>
        	      <td valign="top">&nbsp;</td>
        	      <td valign="top">&nbsp;</td>
        	      <td valign="top">&nbsp;</td>
      	      </tr>
        	    <tr>
        	      <td><strong>Posicion</strong></td>
        	      <td><input name="posicion" type="text" id="posicion" value="<?php echo $listaSel[0]['posicion']; ?>"  /></td>
        	      <td>&nbsp;</td>
        	      <td>&nbsp;</td>
      	      </tr>
        	    <tr>
        	      <td><strong>Mostrar</strong></td>
        	      <td><input name="mostrar" type="checkbox" id="mostrar" value="1" <?php if ($listaSel[0]['activado']=="1") : echo 'checked="checked"'; endif; ?> /></td>
        	      <td>&nbsp;</td>
        	      <td>&nbsp;</td>
      	      </tr>
      	    </table>
        	  <input type="hidden" id="action" name="action" value="<?php echo $_REQUEST['action']; ?>" />
          <input type="hidden" id="id" name="id" value="<?php echo $listaSel[0]['id']; ?>" />
          <input type="hidden" id="id_producto" name="id_producto" value="<?php echo $listaSel[0]['id_producto']; ?>" />

          <p class="botones">

        Aceptar   <input type="image" src="<?php echo IMAGENES;?>mc/ok.png" />


          </p>
        </form>
</DIV></DIV></DIV>

<?php tep_db_close(); ?>
</body>
</HTML>
