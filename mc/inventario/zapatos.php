<?php

$title_html="Manejador de contenido";

		include "../../include/headers2.php";



	$criterio= "";

	if (isset($_GET['cat']) && strlen($_GET['cat'])>0):

		$criterio= "categoria='".$_GET['cat']."'";

	endif;

	$table=TABLE_PRODUCTO;

	$order="id DESC";

	$cant = 100; //cantidad maxima de elementos a buscar

	include "../../include/functions/top_paginator.php";

	$class="productos";

?>



</HEAD>

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

		  <table border="0" cellspacing="0" cellpadding="0" >

		    <tr>

		      <td > <table width="800" border="0" cellspacing="0" cellpadding="5">

	          <tr>

		         <td colspan="4" id="about_titulo">Productos</td>

              </tr>



	         </table>

		        <?php if(count($lista)>0) : ?>



                <table border="0" align="left" cellspacing="10" >

                  <tbody>

                    <?php for($i=0;$i<count($lista);$i++) : ?>

		            <tr>

		              <td align="center"><img src="<?php echo IMAGENES."producto/thumb/".$lista[$i]['thumb']; ?>" style="max-width:150px;"/></td><td align="center"><?php echo $lista[$i]['posicion'];?></td>

		              <td ><a href="mod.php?id=<?php echo $lista[$i]['id'];?>&amp;action=mod" ><?php echo $lista[$i]['nombre'];  ?></a></td>

		             <td align="center"><a href="mod.php?id=<?php echo $lista[$i]['id'];?>&action=mod" ><img src="../../images/mc/editar.png" ></a></td>

                     <td align="center" ><a href="exec.php?id=<?php echo $lista[$i]['id'];?>&action=act" onClick="if (! confirm('Seguro que requiere cambiar el estado del producto?')) { return false; }"><?php if ($lista[$i]['activado']==0) { ?><img src="../../images/mc/red.jpg" alt="Activo"><?php } else {?><img src="../../images/mc/green.jpg" alt="Desactivado"><?php  } ?></a></td>



	                </tr>

		            <?php endfor; ?>

                    </tbody>

	              </table>





				<?php else : ?>

		        	<p  id="mensaje">No se encontraron productos cargados</p>

		        <?php endif; ?><br>

		     </td>

	        </tr>

      </table>

			<div id="footer_paginator" align="center" style="font-size:14px">

          		<p class="paginator">

          <?php



		  if($actual != $li) : ?>

          <a href="<?php echo $page.'ini='.max(($ini-$cant),0).'&cat='.$_REQUEST["cat"]; ?>" style="text-decoration:none; color:#999">&lt;</a>

          <?php endif; ?>

          <?php

          	for($i=$li;$i<=$ls;$i++) : // para pintar las ventanas

				if($i==$actual) :

					echo '<strong>'.$i.'</strong>'.(($i == $ls) ? '' : ' ');

				else :

		  ?>

          <a href="<?php echo $page.'ini='.(($i - 1) * $cant).'&cat='.$_REQUEST["cat"]; ?>" style="text-decoration:none; color:#999"><?php echo $i; ?></a>

          <?php

          			echo ($i == $ls) ? '' : ' ';

				endif;

			endfor;

		  ?>

          <?php if($actual < $ls) : ?>



          <a href="<?php echo $page.'ini='.($ini+$parc).'&cat='.$_REQUEST["cat"]; ?>" style="text-decoration:none; color:#999">&gt;</a>

          <?php endif; ?>

</p>

        	</div>

		</div>

    </div>

</div>



</body>

</HTML>

