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
$class="cintillos";
?>
</HEAD>

<div id="wrapper">
    	<header><div  id="logo" > Administrador de Contenido</div></header>
         <div id="intwrapper">
         <div id="menu" >
		<?php include "../menu.php"; ?>
        </div>
		<div id="content">
		  <table border="0" cellspacing="0" cellpadding="0" >
		    <tr>
		      <td > <table width="800" border="0" cellspacing="0" cellpadding="5">
	          <tr>
		         <td colspan="4" id="about_titulo">Cintillos</td>
              </tr>
		       <tr>
		         <td width="550" align="right"><a href="exec.php?action=add&cat=<?php echo $_GET['cat']; ?>" style="float:right">Agregar Cintillo </a></td>
		         <td><a href="exec.php?action=add&cat=<?php echo $_GET['cat']; ?>" ><img src="../../images/mc/agregar.png" width="26" height="26" /></a></td>
	         <td align="right">&nbsp;</td>
	         <td width="30">&nbsp;</td>
	           </tr>
	         </table>

		        <?php if(count($lista)>0) : ?>
                <table border="0" align="left" cellspacing="10" >
                  <tbody>
                   <?php for($i=0;$i<count($lista);$i++) : ?>
		            <tr>

		              <td align="center"><img src="<?php echo IMAGENES."producto/thumb/".$lista[$i]['thumb']; ?>" style="max-width:150px;"/></td><td align="center"><?php echo $lista[$i]['posicion'];?></td>

		              <td ><a href="mod.php?id=<?php echo $lista[$i]['id'];?>&amp;action=mod&cat=<?php echo $_GET['cat']; ?>" ><?php echo $lista[$i]['nombre'];  ?></a></td>

		             <td align="center"><a href="mod.php?id=<?php echo $lista[$i]['id'];?>&action=mod&cat=<?php echo $_GET['cat']; ?>" ><img src="../../images/mc/editar.png" ></a></td>

                     <td align="center" ><a href="exec.php?id=<?php echo $lista[$i]['id'];?>&action=act&cat=<?php echo $_GET['cat']; ?>" onClick="if (! confirm('Seguro que requiere cambiar el estado del producto?')) { return false; }"><?php if ($lista[$i]['activado']==0) { ?><img src="../../images/mc/red.jpg" alt="Activo"><?php } else {?><img src="../../images/mc/green.jpg" alt="Desactivado"><?php  } ?></a></td>

		              <td ><span style="padding-left:30px"><a href="exec.php?id=<?php echo $lista[$i]['id'];?>&amp;action=del&cat=<?php echo $_GET['cat']; ?>" onClick="if (! confirm('Seguro que requiere eliminar el producto <?php echo $lista[$i]['name']; ?> ?')) { return false; }" ><img src="../../images/mc/eliminar.png" width="26" height="26" alt="Eliminar" /></a></span></td>

                      <td align="center"></td>

	                </tr>

		            <?php endfor; ?>

                    </tbody>

	              </table>

				<?php else : ?>
		        	<p  id="mensaje">No se encontraron productos cargados</p>
		        <?php endif; ?><br>
		     </td>	        </tr>

      </table>

			<div id="footer_paginator" align="center" style="font-size:14px">
          		<p class="paginator">

          <?php
		  if($actual != $li) : ?>
          <a href="<?php echo $page.'ini='.max(($ini-$cant),0).'&cat='.$_GET["cat"]; ?>" style="text-decoration:none; color:#999">&lt;</a>
          <?php endif;

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
        	</div>		</div>
   </div>
</div>
</body>
</HTML>
