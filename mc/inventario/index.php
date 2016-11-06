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

   <tr>

    <td align="left">Regresar</td>

    <td width="47"><img src="../../images/mc/volver.png" /></td>

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



		     </td>

	        </tr>

      </table>



		</div>

    </div>

</div>



</body>

</HTML>

