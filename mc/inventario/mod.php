<?php
$title_html="Manejador de contenido";
	include "../../include/headers2.php";
	$class="producto";
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
<table width="130" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td colspan="2" align="left"><hr /></td>
  </tr>
  <tr>
    <td colspan="2" align="center">Leyenda</td>
  </tr>
  <?php if (strlen($class)==0) : ?>
  <tr>
    <td width="75" align="left">Agregar</td>
    <td width="47"><img src="../images/mc/agregar.png" /></td>
  </tr>
  <tr>
    <td align="left">Eliminar</td>
    <td><img src="../images/mc/eliminar.png" /></td>
  </tr>
  <tr>
    <td align="left">Regresar</td>
    <td width="47"><img src="../images/mc/volver.png" /></td>
  </tr>
  <tr>
    <td align="left">Previsualizar</td>
    <td align="left"><a href="<?php echo $lista[$i]['enlace'];?>"><img src="../images/mc/home.png" alt="" /></a></td>
  </tr>
  <tr>
    <td align="left">Editar</td>
    <td align="left"><img src="../images/mc/editar.png" /></td>
  </tr>
  <tr>
    <td align="left">Activar</td>
    <td align="left"><img src="../images/mc/green.jpg" alt="Desactivado" /></td>
  </tr>
  <tr>
    <td align="left">Desactivar</td>
    <td align="left"><img src="../images/mc/red.jpg" alt="Activo" /></td>
  </tr>
  <tr>
    <td align="left">Ir a Url</td>
    <td align="left"><img src="../images/mc/url.png" /></td>
  </tr>
  <tr>
    <td align="left">Aceptar</td>
    <td align="left"><a href="<?php echo $lista[$i]['enlace'];?>"><img src="../images/mc/ok.png" alt="" /></a></td>
  </tr>
  <tr>
    <td align="left">Cancelar</td>
    <td align="left"><a href="<?php echo $lista[$i]['enlace'];?>"><img src="../images/mc/cancelar.png" /></a></td>
  </tr>
  <tr>
    <td align="left">Buscar</td>
    <td><a href="<?php echo $lista[$i]['enlace'];?>"><img src="../images/mc/buscar.png" /></a></td>
  </tr>
  <?php else : ?>
  <tr>
    <td width="75" align="left">Agregar</td>
    <td width="47"><img src="../../images/mc/agregar.png" /></td>
  </tr>
  <tr>
    <td align="left">Eliminar</td>
    <td><img src="../../images/mc/eliminar.png" /></td>
  </tr>
  <tr>
    <td align="left">Regresar</td>
    <td width="47"><img src="../../images/mc/volver.png" /></td>
  </tr>
  <tr>
    <td align="left">Previsualizar</td>
    <td align="left"><a href="<?php echo $lista[$i]['enlace'];?>"><img src="../../images/mc/home.png" alt="" /></a></td>
  </tr>
  <tr>
    <td align="left">Editar</td>
    <td align="left"><img src="../../images/mc/editar.png" /></td>
  </tr>
  <tr>
    <td align="left">Activar</td>
    <td align="left"><img src="../../images/mc/green.jpg" alt="Desactivado" /></td>
  </tr>
  <tr>
    <td align="left">Desactivar</td>
    <td align="left"><img src="../../images/mc/red.jpg" alt="Activo" /></td>
  </tr>
  <tr>
    <td align="left">Ir a Url</td>
    <td align="left"><img src="../../images/mc/url.png" /></td>
  </tr>
  <tr>
    <td align="left">Aceptar</td>
    <td align="left"><a href="<?php echo $lista[$i]['enlace'];?>"><img src="../../images/mc/ok.png" alt="" /></a></td>
  </tr>
  <tr>
    <td align="left">Cancelar</td>
    <td align="left"><a href="<?php echo $lista[$i]['enlace'];?>"><img src="../../images/mc/cancelar.png" /></a></td>
  </tr>
  <tr>
    <td align="left">Buscar</td>
    <td><a href="<?php echo $lista[$i]['enlace'];?>"><img src="../../images/mc/buscar.png" /></a></td>
  </tr>
  <?php endif; ?>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>

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
                <?php
						tep_db_connect();

						$criterio = "id='".$_REQUEST["id"]."'";
						$listaSel = searchList($criterio,NULL,NULL,NULL,"*",TABLE_PRODUCTO,1);

					$categorias= searchList("","posicion",NULL,NULL,"*",TABLE_CATEGORIA);
					$suelas= searchList("","name",NULL,NULL,"*",TABLE_SUELA);
					$material= searchList("","name",NULL,NULL,"*",TABLE_MATERIAL);
					$tallas= searchList("","name",NULL,NULL,"*",TABLE_TALLA);
					tep_db_close();
				?>

          	<table width="800" border="0" cellpadding="2" cellspacing="0" style="margin-left:50px">
            	<tr>
				  <td width="152" ><strong>PRODUCTO</strong></td>
   					 <td colspan="4" >&nbsp;</td>

		      </tr>
              <form action="exec.php" method="post">
              <tr >
                  <td>&nbsp;</td>
                  <td width="97" style="border: #CCC solid 1px;"> <input type="checkbox" name="nuevo" id="nuevo" value="1" <?php echo ($listaSel[0]['nuevo']=='1') ? 'checked' : ''; ?>>Nuevo</td>
                  <td width="146" style="border: #CCC solid 1px;"><input type="text" name="descuento" id="descuento" placeholder="Descuento" value="<?php  echo $listaSel[0]['descuento']; ?>"></td>
                  <td width="129" style="border: #CCC solid 1px;">Ocultar Plantilla <input type="checkbox" name="plantilla" id="plantilla" value="1" <?php echo ($listaSel[0]['plantilla']=='1') ? 'checked' : ''; ?>></td>
                  <td width="256" ><input type="image" src="../../images/mc/editar.png" width="26" height="26">
                  <input type="hidden" id="action" name="action" value="modestado" />
             		<input type="hidden" id="id" name="id" value="<?php echo $listaSel[0]['id']; ?>" /></td>
              </tr>
              </form>
              <tr>
                  <td>&nbsp;</td>
                  <td colspan="4">&nbsp;</td>

              </tr>
               <tr>
              <td >Categor&iacute;a</td>
              <td colspan="4"><select name="categoria"  id="categoria"><?php for($i=0;$i<count($categorias);$i++) : ?>
                         <option value="<?php echo $categorias[$i]["id"]; ?>"  <?php if ($listaSel[0]['categoria']==$categorias[$i]["id"]): echo 'selected="selected"'; endif; ?>><?php echo $categorias[$i]["nombre"]; ?></option>
                         <?php endfor; ?></select></td>

            </tr>
            <tr>
              <td >Nombre</td>
              <td colspan="4"><input name="nombre" type="text" id="nombre" size="40" maxlength="255"  value="<?php  echo $listaSel[0]['nombre']; ?>" /></td>

            </tr>

            <tr>
              <td >Tipo Suela</td>
              <td colspan="4"><select name="suela"  id="suela"><?php for($i=0;$i<count($suelas);$i++) : ?>
                         <option value="<?php echo $suelas[$i]["id"]; ?>"  <?php if ($listaSel[0]['suela']==$suelas[$i]["id"]): echo 'selected="selected"'; endif; ?>><?php echo $suelas[$i]["name"]; ?></option>
                         <?php endfor; ?></select></td>

            </tr>

                        <tr>
              <td >Tipo Acabado</td>
              <td colspan="4"><select name="material"  id="material"><?php for($i=0;$i<count($material);$i++) : ?>
                         <option value="<?php echo $material[$i]["id"]; ?>"  <?php if ($listaSel[0]['material']==$material[$i]["id"]): echo 'selected="selected"'; endif; ?>><?php echo $material[$i]["name"]; ?></option>
                         <?php endfor; ?></select></td>

            </tr>

            </tr>
 <tr>
        	      <td valign="top">Imagen Referencial</td>
        	      <td colspan="4">
                  <?php if (strlen($listaSel[0]['zoom'])>0) : ?>
                  <img src="<?php echo IMAGENES.'producto/zoom/'.$listaSel[0]['zoom'];?>" alt="" height="190">
                  <?php endif; ?>
                  </td>
                  </tr>

                  </tr>
 <tr>
               <td align="right"></td>
               <td colspan="4" ></td>
             </tr>
              <tr>


              <tr>
                      <td align="right"></td>
                      <td colspan="4" ></td>
                    </tr>
              <tr>


                              <tr>
                      <td colspan="5" align="left">Tallas del producto</td>
                    </tr>
                    <tr>
                      <td align="right">&nbsp;</td>
                      <td colspan="4" ><iframe src="tallas.php?id=<?php echo $listaSel[0]['id']; ?>" width="100%" height="300px"></iframe></td>
                    </tr>

            </table>
             <input type="hidden" id="action" name="action" value="<?php echo $_REQUEST['action']; ?>" />
             <input type="hidden" id="id" name="id" value="<?php echo $listaSel[0]['id']; ?>" />

</DIV></DIV></DIV></DIV></DIV>

</body>
</HTML>
