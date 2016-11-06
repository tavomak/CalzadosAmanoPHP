<?php
	include "../../include/configure.php";
	include "../../include/database_tables.php";
	include "../../include/functions/database.php";
	$criterio = "id_producto=".$_GET["id"];
	$table=TABLE_CATALOGO;
	$cant = 100; //cantidad maxima de elementos a buscar
	include "../../include/functions/top_paginator.php";

?>

<div id="wrapper">

	<div id="intwrapper">

		<div id="content">
		<table border="0" cellspacing="0" cellpadding="0" >
		<tr><td ><?php echo $ini + 1 ;?> - <?php echo $ini + $parc; ?> de <?php echo $total; ?></td></tr>
       <tr><td ><a href="exec.php?action=addc&id_producto=<?php echo $_GET["id"];?>" >Agregar imagen <img src="../../images/mc/agregar.png" width="26" height="26" /></a>
	          </td></tr>
		        <?php if(count($lista)>0) : ?>


               <table border="0" align="center" cellspacing="1" >
                     <tbody>
                    <?php for($i=0;$i<count($lista);$i++) : ?>
		            <tr>
		              <td align="center"></td>
		              <td ><a href="modc.php?id=<?php echo $lista[$i]['id'];?>&amp;action=modc&amp;id_producto=<?php echo $_GET["id"];?>" ><img src="<?php echo IMAGENES.'producto/vistas/thumb/'.$lista[$i]['thumb'];?>" height="80" ></a></td>
		              <td align="left" ><a href="modc.php?id=<?php echo $lista[$i]['id'];?>&amp;action=modc&amp;id_producto=<?php echo $_GET["id"];?>"  > <img src="../../images/mc/editar.jpg" ></a></td>

                      <td ><span style="padding-left:30px"><a href="exec.php?id=<?php echo $lista[$i]['id'];?>&amp;id_producto=<?php echo $_GET["id"];?>&amp;action=actc">

					  		 <?php 	if ($lista[$i]['activado']==0) { 	?>
                                <img src="../../images/mc/red.jpg" alt="Desactivado">

					 <?php } else {?>
                          <img src="../../images/mc/green.png" alt="Activado">
					 <?php
					  }

					 ?></a></span></td>

		              <td ><span style="padding-left:30px"><a href="exec.php?id=<?php echo $lista[$i]['id'];?>&amp;action=del_ic&amp;id_producto=<?php echo $_GET["id"];?>" onClick="if (! confirm('Seguro que requiere eliminar la imagen ?')) { return false; }"><img src="../../images/mc/eliminar.png"  alt="Eliminar" /></a></span></td>
                      <td ></td>
                       <td></td>
	                </tr>
		            <?php endfor;
					?>
                    </tbody>
	              </table>



				<?php else : ?>
		        	<p id="mensaje">No se encontraron imágenes</p>
		        <?php endif; ?><br>
		        </td>
	        </tr>
      </table>
			<div id="footer_paginator" align="center" style="font-size:14px">
          	<p class="paginator">
          <?php
		 $var="id=".$_GET["id"];
		  if($actual != $li) : ?>
          <a href="<?php echo $page.'ini='.max(($ini-$cant),0).'&'.$var; ?>" style="text-decoration:none; color:#999">&lt;</a>
          <?php endif; ?>
          <?php
          	for($i=$li;$i<=$ls;$i++) : // para pintar las ventanas
				if($i==$actual) :
					echo '<strong>'.$i.'</strong>'.(($i == $ls) ? '' : ' ');
				else :
		  ?>
          <a href="<?php echo $page.'ini='.(($i - 1) * $cant).'&'.$var; ?>" style="text-decoration:none; color:#999"><?php echo $i; ?></a>
          <?php
          			echo ($i == $ls) ? '' : ' ';
				endif;
			endfor;
		  ?>
          <?php if($actual < $ls) : ?>

          <a href="<?php echo $page.'ini='.($ini+$parc).'&'.$var; ?>" style="text-decoration:none; color:#999">&gt;</a>
          <?php endif; ?>
</p>
        	</div>
		</div>
        	</div>
		</div>
    </div>
</div>

</body>
</HTML>
