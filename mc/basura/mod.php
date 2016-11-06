<?php
$title_html="Manejador de contenido";
	include "../../include/headers2.php";
	$class="basura";
?>
<script type="text/javascript" >
function isempty() {
		if (document.getElementById("name").value.length==0) {
		alert("Coloque el nombre");
		return false;
	} else {
		return true;
	}

}
</script>
<script src="../../include/ckeditor/ckeditor.js"></script>
</head>
<BODY>


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
        	<form action="exec.php" name="frm_mod_banner" id="frm_mod_banner" method="post"  enctype="multipart/form-data"  >
               <?php
						tep_db_connect();

						$criterio = "id='".$_REQUEST["id"]."'";
						$listaSel = searchList($criterio,NULL,NULL,NULL,"*",TABLE_PRODUCTO,1);

					$categorias= searchList("","nombre",NULL,NULL,"*",TABLE_CATEGORIA);
					$suelas= searchList("","name",NULL,NULL,"*",TABLE_SUELA);
					$material= searchList("","name",NULL,NULL,"*",TABLE_MATERIAL);
					$tallas= searchList("","name",NULL,NULL,"*",TABLE_TALLA);
					tep_db_close();
				?>

          	<table width="800" border="0" cellpadding="2" cellspacing="0" style="margin-left:50px">
            	<tr>
				  <td width="161" ><strong>PRODUCTO</strong></td>
   					 <td width="631" >&nbsp;</td>

		      </tr>
              <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>

              </tr>
               <tr>
              <td >Categor&iacute;a</td>
              <td><select name="categoria"  id="categoria">
              <option value="0">Selecciona</option>
			  <?php for($i=0;$i<count($categorias);$i++) : ?>

                         <option value="<?php echo $categorias[$i]["id"]; ?>"  <?php if ($listaSel[0]['categoria']==$categorias[$i]["id"]): echo 'selected="selected"'; endif; ?>><?php echo $categorias[$i]["nombre"]; ?></option>
                         <?php endfor; ?></select></td>

            </tr>
            <tr>
              <td >Nombre</td>
              <td><input name="nombre" type="text" id="nombre" size="40" maxlength="255"  value="<?php  echo $listaSel[0]['nombre']; ?>" /></td>

            </tr>

            </tr>
 <tr>
        	      <td valign="top">Imagen Zoom</td>
        	      <td><input type="file" name="zoom" id="zoom" >
        	        <span style="font-size:9px"><br>
        	         805x992 <br>
      	          </span>
                  <?php if (strlen($listaSel[0]['zoom'])>0) : ?>
                  <img src="<?php echo IMAGENES.'producto/zoom/'.$listaSel[0]['zoom'];?>" alt="" height="190"><a href="exec.php?id=<?php echo $listaSel[0]['id']; ?>&action=del_z">
                  <img src="<?php echo IMAGENES;?>mc/eliminar.png" alt="Eliminar" width="20" height="20">
                  <?php endif; ?></a>
                  </td>
                  </tr>

                  </tr>
 <tr>
        	      <td valign="top">Imagen Grande</td>
        	      <td><input type="file" name="big" id="big" >
        	        <span style="font-size:9px"><br>
        	        805x992<br>
      	          </span>
                  <?php if (strlen($listaSel[0]['big'])>0) : ?>
                  <img src="<?php echo IMAGENES.'producto/big/'.$listaSel[0]['big'];?>" alt="" height="190"><a href="exec.php?id=<?php echo $listaSel[0]['id']; ?>&action=del_b">
                  <img src="<?php echo IMAGENES;?>mc/eliminar.png" alt="Eliminar" width="20" height="20">
                  <?php endif; ?></a>
                  </td>
                  </tr>

                  <tr>
        	      <td valign="top">Imagen Peque&ntilde;a</td>
        	      <td><input name="thumb" type="file" id="thumb" size="15" ><br>
                  <?php if (strlen($listaSel[0]['thumb'])>0) : ?>
                  <img src="<?php echo IMAGENES.'producto/thumb/'.$listaSel[0]['thumb'];?>" alt="" height="190"><a href="exec.php?id=<?php echo $listaSel[0]['id']; ?>&action=del_t">
                  <img src="<?php echo IMAGENES;?>mc/eliminar.png" alt="" width="20" height="20">
                  <?php endif; ?></a></td>
      	      </tr>
        	   <tr>
                      <td align="right"></td>
                      <td ></td>
                    </tr>
              <tr>


              <tr>
                      <td align="right"></td>
                      <td ></td>
                    </tr>
              <tr>




                    <tr>
                   <td align="right">Activado</td>
                   <td ><input name="activado" type="checkbox" id="activado" value="1" <?php if ($listaSel[0]['activado']=="1") : echo 'checked="checked"'; endif; ?> /></td>
                   </tr>
              </table>
             <input type="hidden" id="action" name="action" value="<?php echo $_REQUEST['action']; ?>" />
             <input type="hidden" id="id" name="id" value="<?php echo $listaSel[0]['id']; ?>" />
          <p class="botones">

        Aceptar   <input type="image" src="../../images/mc/ok.png" />


          </p>
        </form>
</DIV></DIV></DIV></DIV></DIV>

</body>
</HTML>
