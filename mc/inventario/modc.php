<?php
$title_html="Manejador de contenido";
	include "../../include/headers2.php";
	$class="cintillos";
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

		<table>

    <tr>

      <td><strong><u>Cat&aacute;logo</u></strong></td>

    </tr>



    <tr>

      <td><strong><u>Zapatos</u></strong></td>

    </tr>

    <?php tep_db_connect(); $categorias= searchList("","posicion",NULL,NULL,"*",TABLE_CATEGORIA);

	tep_db_close();

	for ($i=0;$i<4; $i++) :?>

      <tr>

		<td><a href="<?php echo CMS; ?>inventario/zapatos.php?cat=<?php echo $categorias[$i]["id"]; ?>" <?php if ($class=="productos") { echo "class='selected'"; } ?>><?php echo $categorias[$i]["nombre"]; ?></a></td>

    </tr>

    <?php endfor; ?>
<tr>
      <td><strong><u>Plantillas</u></strong></td>
  </tr>
        <tr><td><a href="<?php echo CMS; ?>inventario/accesorios.php?cat=5" <?php if ($class=="plantillas") { echo "class='selected'"; } ?>>Beb&eacute;s</a></td></tr>
        <tr><td><a href="<?php echo CMS; ?>inventario/accesorios.php?cat=9" <?php if ($class=="plantillas") { echo "class='selected'"; } ?>>Ni&ntilde;as</a></td></tr>
        <tr><td><a href="<?php echo CMS; ?>inventario/accesorios.php?cat=8" <?php if ($class=="plantillas") { echo "class='selected'"; } ?>>Ni&ntilde;os</a></td></tr>
  <tr>
      <td><strong><u>Cintillos</u></strong></td>
  </tr>
  <tr>
      <td><a href="<?php echo CMS; ?>inventario/accesorios.php?cat=7" <?php if ($class=="cintillos") { echo "class='selected'"; } ?>>Beb&eacute;s</a>
      </td></tr>
       <tr>
      <td><a href="<?php echo CMS; ?>inventario/accesorios.php?cat=11" <?php if ($class=="cintillos") { echo "class='selected'"; } ?>>Ni&ntilde;as</a>
      </td></tr>
   <tr>
      <td><strong><u>Lazos</u></strong></td>
  </tr>
   <tr>
      <td><a href="<?php echo CMS; ?>inventario/accesorios.php?cat=6" <?php if ($class=="lazos") { echo "class='selected'"; } ?>>Beb&eacute;s</a></td>
      </tr>
       <tr>
      <td><a href="<?php echo CMS; ?>inventario/accesorios.php?cat=10" <?php if ($class=="lazos") { echo "class='selected'"; } ?>>Ni&ntilde;as</a></td>
      </tr>
  <tr>
      <td><strong><u>Pijamas</u></strong></td>
  </tr>

 <tr><td><a href="<?php echo CMS; ?>inventario/accesorios.php?cat=12" <?php if ($class=="pijamas") { echo "class='selected'"; } ?>>Beb&eacute;s</a></td></tr>
        <tr><td><a href="<?php echo CMS; ?>inventario/accesorios.php?cat=13" <?php if ($class=="pijamas") { echo "class='selected'"; } ?>>Ni&ntilde;as</a></td></tr>
        <tr><td><a href="<?php echo CMS; ?>inventario/accesorios.php?cat=14" <?php if ($class=="pijamas") { echo "class='selected'"; } ?>>Ni&ntilde;os</a></td></tr>
    <tr>

      <td><strong><u>Pedidos</u></strong></td>

    </tr>

     <tr><td><a href="<?php echo CMS; ?>inventario/poranular.php" <?php if ($class=="pedidos") { echo "class='selected'"; } ?>>Pedidos por anular</a></td></tr>

 </table>
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
				  <td width="161" ><strong>BANDANAS</strong></td>
   					 <td width="631" >&nbsp;</td>
		      </tr>
              <tr>
                 <td>&nbsp;</td>
                  <td>&nbsp;</td>
              </tr>

            <tr>
              <td >Nombre</td>
              <td><input name="nombre" type="text" id="nombre" size="40" maxlength="255"  value="<?php  echo $listaSel[0]['nombre']; ?>" /></td>
            </tr>

             <tr>

              <td >Material</td>

              <td><select name="material"  id="material"><?php for($i=0;$i<count($material);$i++) : ?>

                         <option value="<?php echo $material[$i]["id"]; ?>"  <?php if ($listaSel[0]['material']==$material[$i]["id"]): echo 'selected="selected"'; endif; ?>><?php echo $material[$i]["name"]; ?></option>

                         <?php endfor; ?></select></td>



            </tr>

 <tr>
   	        <td valign="top">Imagen Peque&ntilde;a</td>
   	        <td>

              <img src="<?php echo IMAGENES.'producto/thumb/'.$listaSel[0]['thumb'];?>" alt="" height="190">

             </td>

   	        </tr>


                   <tr>
                      <td colspan="2" align="left">Tallas del producto</td>
                    </tr>

                    <tr>
                      <td colspan="2" align="right"><?php if (($listaSel[0]['categoria']=='6')||($listaSel[0]['categoria']=='7') ||($listaSel[0]['categoria']=='10')||($listaSel[0]['categoria']=='11')) { ?>
					  <iframe src="tallasaccess.php?id=<?php echo $listaSel[0]['id']; ?>" width="100%" height="300px"></iframe>
					 <?php } else { ?>
						  <iframe src="tallas.php?id=<?php echo $listaSel[0]['id']; ?>" width="100%" height="300px"></iframe>
                          <?php } ?>
                          </td>
                    </tr>

                     <tr>
                      <td colspan="2" align="left">&nbsp;</td>
                    </tr>

 <tr>

                      <td colspan="2" align="right" valign="top">&nbsp;</td>
                    </tr>

            </table>


          <p class="botones">&nbsp;</p>

        </form>

</DIV></DIV></DIV></DIV></DIV>

</body>

</HTML>
