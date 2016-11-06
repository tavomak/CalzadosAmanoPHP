<table>
    <tr>
		<td><strong><u>Configuraci&oacute;n</u></strong></td>
    </tr>

    <tr>
		<td><a href="<?php echo CMS; ?>talla/index.php" <?php if ($class=="talla") { echo "class='selected'"; } ?>>Tallas</a></td>
    </tr>
          <tr>
		<td><a href="<?php echo CMS; ?>suela/index.php" <?php if ($class=="suela") { echo "class='selected'"; } ?>>Tipos de Suela</a></td>
    </tr>
              <tr>
		<td><a href="<?php echo CMS; ?>material/index.php" <?php if ($class=="material") { echo "class='selected'"; } ?>>Tipos de Material</a></td>
    </tr>
    <tr>
      <td><a href="<?php echo CMS; ?>color/index.php" <?php if ($class=="color") { echo "class='selected'"; } ?>>Colores</a></td>
  </tr>
  <tr>
      <td><a href="<?php echo CMS; ?>banner/index.php" <?php if ($class=="banner") { echo "class='selected'"; } ?>>Banner</a></td>
  </tr>
     <tr>
		<td><strong><u>Zapatos</u></strong></td>
    </tr>
    <?php tep_db_connect(); $categorias= searchList("posicion<5","posicion",NULL,NULL,"*",TABLE_CATEGORIA);
	tep_db_close();
	for ($i=0;$i<count($categorias); $i++) :?>
      <tr>
		<td><a href="<?php echo CMS; ?>productos/index.php?cat=<?php echo $categorias[$i]["id"]; ?>" <?php if ($class=="productos") { echo "class='selected'"; } ?>><?php echo $categorias[$i]["nombre"]; ?></a></td>
    </tr>
    <?php endfor; ?>
    <tr>
      <td><strong><u>Plantillas</u></strong></td>
  </tr>
        <tr><td><a href="<?php echo CMS; ?>plantillas/index.php?cat=5" <?php if ($class=="plantillas") { echo "class='selected'"; } ?>>Beb&eacute;s</a></td></tr>
        <tr><td><a href="<?php echo CMS; ?>plantillas/index.php?cat=9" <?php if ($class=="plantillas") { echo "class='selected'"; } ?>>Ni&ntilde;as</a></td></tr>
        <tr><td><a href="<?php echo CMS; ?>plantillas/index.php?cat=8" <?php if ($class=="plantillas") { echo "class='selected'"; } ?>>Ni&ntilde;os</a></td></tr>
  <tr>
      <td><strong><u>Bandanas</u></strong></td>
  </tr>
  <tr>
      <td><a href="<?php echo CMS; ?>cintillos/index.php?cat=7" <?php if ($class=="cintillos") { echo "class='selected'"; } ?>>Beb&eacute;s</a>
      </td></tr>
       <tr>
      <td><a href="<?php echo CMS; ?>cintillos/index.php?cat=11" <?php if ($class=="cintillos") { echo "class='selected'"; } ?>>Ni&ntilde;as</a>
      </td></tr>
   <tr>
      <td><strong><u>Lazos</u></strong></td>
  </tr>
   <tr>
      <td><a href="<?php echo CMS; ?>lazos/index.php?cat=6" <?php if ($class=="lazos") { echo "class='selected'"; } ?>>Beb&eacute;s</a></td>
      </tr>
       <tr>
      <td><a href="<?php echo CMS; ?>lazos/index.php?cat=10" <?php if ($class=="lazos") { echo "class='selected'"; } ?>>Ni&ntilde;as</a></td>
      </tr>
  <tr>
      <td><strong><u>Pijamas</u></strong></td>
  </tr>

 <tr><td><a href="<?php echo CMS; ?>pijamas/index.php?cat=12" <?php if ($class=="pijamas") { echo "class='selected'"; } ?>>Beb&eacute;s</a></td></tr>
        <tr><td><a href="<?php echo CMS; ?>pijamas/index.php?cat=13" <?php if ($class=="pijamas") { echo "class='selected'"; } ?>>Ni&ntilde;as</a></td></tr>
        <tr><td><a href="<?php echo CMS; ?>pijamas/index.php?cat=14" <?php if ($class=="pijamas") { echo "class='selected'"; } ?>>Ni&ntilde;os</a></td></tr>


 <tr>
		<td><strong><u>Zoom</u></strong></td>
    </tr>
    <tr>
		<td><a href="<?php echo CMS; ?>rutas/index.php" <?php if ($class=="rutas") { echo "class='selected'"; } ?>>Rutas</a></td>
    </tr>
    <tr>
		<td><a href="<?php echo CMS; ?>tarifas/index.php" <?php if ($class=="Tarifas") { echo "class='selected'"; } ?>>Tarifas</a></td>
    </tr>
    <tr>
		<td><a href="<?php echo CMS; ?>agencias/index.php" <?php if ($class=="agencias") { echo "class='selected'"; } ?>>Agencias</a></td>
    </tr>
     <tr>
		<td><a href="<?php echo CMS; ?>bolsa/index.php" <?php if ($class=="bolsa") { echo "class='selected'"; } ?>>Bolsa</a></td>
    </tr>
    <tr>
		<td><strong><u>Seguridad</u></strong></td>
    </tr>
   <tr>
  	<td><a href="<?php echo CMS; ?>usuarios/index.php" <?php if ($class=="usuario") { echo "class='selected'"; } ?>>Usuarios</a></td>
    </tr>
    <tr>
      <td><strong><u>Otros</u></strong></td>
    </tr>
    <tr>
  	<td><a href="<?php echo CMS; ?>basura/index.php" <?php if ($class=="basura") { echo "class='selected'"; } ?>>Registros hu&eacute;rfanos</a></td>
    </tr>
 <tr><td><a href="<?php echo CMS; ?>pedidos/poranular.php" <?php if ($class=="pedidos") { echo "class='selected'"; } ?>>Pedidos por anular</a></td></tr>
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
