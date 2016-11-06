<?php
$title_html="Manejador de contenido";
		include "../../include/headers2.php";
	$criterio= "";
	$table=TABLE_MATERIAL;
	$cant = 10; //cantidad maxima de elementos a buscar
	include "../../include/functions/top_paginator.php";
	$class="material";
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
		         <td colspan="4" id="about_titulo">Tipos de Material</td>
              </tr>
		       <tr>
		         <td width="550" align="right"><a href="mod.php?action=add" style="float:right">Agregar Tipo de Material </a></td>
		         <td><a href="mod.php?action=add" ><img src="../../images/mc/agregar.png" ></a></td>
		         <td align="right">&nbsp;</td>
		         <td width="30">&nbsp;</td>
	           </tr>
	         </table>
		        <?php if(count($lista)>0) : ?>

                <table border="0" align="left" cellspacing="10" >
                  <tbody>
                    <?php for($i=0;$i<count($lista);$i++) : ?>
		            <tr>
		              <td align="center">&nbsp;</td>
		              <td ><a href="mod.php?id=<?php echo $lista[$i]['id'];?>&amp;action=mod" ><?php echo $lista[$i]['name'];  ?></a></td>
		             <td align="center"><a href="mod.php?id=<?php echo $lista[$i]['id'];?>&action=mod" ><img src="../../images/mc/editar.png" ></a></td>
		              <td ><span style="padding-left:30px"><a href="exec.php?id=<?php echo $lista[$i]['id'];?>&amp;action=del" onClick="if (! confirm('Seguro que requiere eliminar la suela <?php echo $lista[$i]['name']; ?> ?')) { return false; }" ><img src="../../image/mc/eliminar.jpg" width="26" height="26" alt="Eliminar" /></a></span></td>
	                </tr>
		            <?php endfor; ?>
                    </tbody>
	              </table>


				<?php else : ?>
		        	<p  id="mensaje">No se encontraron tipos de material cargados</p>
		        <?php endif; ?><br>
		     </td>
	        </tr>
      </table>
			<div id="footer_paginator" align="center" style="font-size:14px">
          		<p class="paginator">
          <?php

		  if($actual != $li) : ?>
          <a href="<?php echo $page.'ini='.max(($ini-$cant),0).'&idc='.$_REQUEST["idc"]; ?>" style="text-decoration:none; color:#999">&lt;</a>
          <?php endif; ?>
          <?php
          	for($i=$li;$i<=$ls;$i++) : // para pintar las ventanas
				if($i==$actual) :
					echo '<strong>'.$i.'</strong>'.(($i == $ls) ? '' : ' ');
				else :
		  ?>
          <a href="<?php echo $page.'ini='.(($i - 1) * $cant).'&idc='.$_REQUEST["idc"]; ?>" style="text-decoration:none; color:#999"><?php echo $i; ?></a>
          <?php
          			echo ($i == $ls) ? '' : ' ';
				endif;
			endfor;
		  ?>
          <?php if($actual < $ls) : ?>

          <a href="<?php echo $page.'ini='.($ini+$parc).'&idc='.$_REQUEST["idc"]; ?>" style="text-decoration:none; color:#999">&gt;</a>
          <?php endif; ?>
</p>
        	</div>
		</div>
    </div>
</div>

</body>
</HTML>
