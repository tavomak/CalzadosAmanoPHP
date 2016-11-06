<?php
$title_html="Manejador de contenido";
	include "../../include/headers2.php";
	$class="pijamas";
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
   </table>

        	<form action="exec.php" name="frm_mod_banner" id="frm_mod_banner" method="post"  enctype="multipart/form-data"  >

               <?php
					tep_db_connect();
					$criterio = "id='".$_REQUEST["id"]."'";
					$listaSel = searchList($criterio,NULL,NULL,NULL,"*",TABLE_PRODUCTO,1);
					$tallas= searchList("","name",NULL,NULL,"*",TABLE_TALLA);
					$material= searchList("","name",NULL,NULL,"*",TABLE_MATERIAL);
					tep_db_close();

				?>

          	<table width="800" border="0" cellpadding="2" cellspacing="0" style="margin-left:50px">
            	<tr>
				  <td width="161" ><strong>PIJAMAS</strong></td>
   					 <td width="631" >&nbsp;</td>
		      </tr>
              <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
              </tr>
              <tr>
                 <td>Nuevo</td>
                  <td><input type="checkbox" name="nuevo" id="nuevo" value="1" <?php echo ($listaSel[0]['nuevo']=='1') ? 'checked' : ''; ?>></td>
              </tr>

            <tr>
              <td >Nombre</td>
              <td><input name="nombre" type="text" id="nombre" size="40" maxlength="255"  value="<?php  echo $listaSel[0]['nombre']; ?>" /></td>
            </tr>
             <tr>
              <td >C&oacute;digo</td>
              <td colspan="3"><input name="codigo" type="text" id="codigo"  maxlength="10"  value="<?php  echo $listaSel[0]['codigo']; ?>" /></td>
            </tr>
             <tr>

              <td >Material</td>

              <td><select name="material"  id="material"><?php for($i=0;$i<count($material);$i++) : ?>

                         <option value="<?php echo $material[$i]["id"]; ?>"  <?php if ($listaSel[0]['material']==$material[$i]["id"]): echo 'selected="selected"'; endif; ?>><?php echo $material[$i]["name"]; ?></option>

                         <?php endfor; ?></select></td>



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
        	      <td><input name="thumb" type="file" id="thumb" size="15" ><span style="font-size:9px"><br>
       	       107x130<br>
      	          </span>

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
                 <td align="right">Descuento</td>
                 <td ><input name="descuento" type="text" id="descuento" size="10" maxlength="8" value="<?php  echo $listaSel[0]['descuento']; ?>"></td>
              </tr>
              <tr>
                   <td align="right">Posicion</td>
                   <td ><input name="posicion" type="text" id="posicion" value="<?php  echo $listaSel[0]['posicion']; ?>" /></td>
                   </tr>
            <tr>
                  <td align="right">Preview</td>
                  <td ><input name="preview" type="checkbox" id="preview" value="1" <?php if ($listaSel[0]['preview']=="1") : echo 'checked="checked"'; endif; ?> /></td>
                   </tr>
                    <tr>
                   <td align="right">Activado</td>
                  <td ><input name="activado" type="checkbox" id="activado" value="1" <?php if ($listaSel[0]['activado']=="1") : echo 'checked="checked"'; endif; ?> /></td>
                   </tr>
                   <tr>
                      <td colspan="2" align="left">Tallas del producto</td>
                    </tr>

                    <tr>
                      <td colspan="2" align="right"><iframe src="tallas.php?id=<?php echo $listaSel[0]['id']; ?>" width="100%" height="300px"></iframe></td>
                    </tr>

                     <tr>
                      <td colspan="2" align="left">Vistas</td>
                    </tr>

 <tr>

                      <td colspan="2" align="right" valign="top"><iframe src="catalogo.php?id=<?php echo $listaSel[0]['id']; ?>" width="100%" height="400px"></iframe></td>
                    </tr>

            </table>

             <input type="hidden" id="action" name="action" value="<?php echo $_REQUEST['action']; ?>" />
             <input type="hidden" id="id" name="id" value="<?php echo $listaSel[0]['id']; ?>" />
             <input type="hidden" id="categoria" name="categoria" value="<?php echo $_GET['cat']; ?>" />
             <input type="hidden" id="suela" name="suela" value="0" />

          <p class="botones">

        Aceptar   <input type="image" src="../../images/mc/ok.png" />

          </p>

        </form>

</DIV></DIV></DIV></DIV></DIV>

</body>

</HTML>
