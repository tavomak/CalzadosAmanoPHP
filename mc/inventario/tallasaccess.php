<?php
	include "../../include/configure.php";
	include "../../include/database_tables.php";
	include "../../include/functions/database.php";
	$criterio = "id_producto=".$_GET["id"];
	$table=TABLE_PRODTALLA;
	$order="posicion";
	$cant = 100; //cantidad maxima de elementos a buscar
	include "../../include/functions/top_paginator.php";
	include "../../include/class/producto.php";
	tep_db_connect();
	$listaTalla = searchList('',NULL,NULL,NULL,"*",TABLE_TALLA);
	$listaColor = searchList('',NULL,NULL,NULL,"*",TABLE_COLOR);
	tep_db_close();
?>

<div id="wrapper">

	<div id="intwrapper">

		<div id="content">
		<table border="0" cellspacing="0" cellpadding="0" >
		<tr><td ><?php echo $ini + 1 ;?> - <?php echo $ini + $parc; ?> de <?php echo $total; ?></td></tr>
       <tr><td ><form action="exec.php" method="post">
       <select name="id_talla[]"  id="id_talla" multiple="MULTIPLE">
       <option value='0' disabled="disabled">Seleccione una o varias tallas</option>
	   <?php for($i=0;$i<count($listaTalla);$i++) : ?>

                         <option value="<?php echo $listaTalla[$i]["id"]; ?>" ><?php echo $listaTalla[$i]["name"]; ?></option>
                         <?php endfor; ?></select>
        <input type="hidden" id="action" name="action" value="addtalla_a" />
        <input type="hidden" id="id_producto" name="id_producto" value="<?php echo $_GET["id"]; ?>" />
      	<input type="image"  src="../../images/mc/agregar.png" />
       </form></td></tr>
		        <?php if(count($lista)>0) : ?>


               <table border="0" align="center" cellspacing="1" >
                     <tbody>
                     <tr>
                     <td align="center"></td>
                      <td align="center"></td>
                      <td align="center">Peso(gr)</td>
                      <td align="center">Dimensi&oacute;n</td>
                       <td align="center">Precio</td>
                       <td align="center">Cantidad</td>
                       <td align="center">Posición</td>
                       <td align="center"></td>
                       <td align="center"></td>
                       <td align="center"></td>
                      </tr>
                    <?php for($i=0;$i<count($lista);$i++) : ?>
                    <form id="posi<?php echo $i;?>" name="posi<?php echo $i;?>" action="exec.php?id=<?php  echo $lista[$i]['id']; ?>" method="post">
		            <tr>

		              <td ><?php for ($j=0;$j<count($listaTalla); $j++):
					  		if ($listaTalla[$j]['id']==$lista[$i]['id_talla']):
								$nombre=$listaTalla[$j]["name"];
							endif;
					  endfor;
					  echo $nombre; ?></td>
                      <td align="left"> <select name="id_color"  id="id_color" >
       <option value='0' disabled="disabled" selected="selected">Color</option>
	   <?php for($j=0;$j<count($listaColor);$j++) : ?>

                         <option value="<?php echo $listaColor[$j]["id"]; ?>" <?php echo ($listaColor[$j]['id']==$lista[$i]['id_color'])? "selected":"";?> ><?php echo $listaColor[$j]["nombre"]; ?></option>
                         <?php endfor; ?></select></td>
                      <td align="left" ><input name="peso" id="peso" type="text"  value="<?php echo $lista[$i]['peso']; ?>" />
                      </td>
                      <td align="left" ><input name="dimensiones" id="dimensiones" type="text"  value="<?php echo $lista[$i]['dimensiones']; ?>" />
                      </td>
		              <td align="left" ><input name="precio" id="precio" type="text"  value="<?php echo $lista[$i]['precio']; ?>" />
                      </td>
                      <td align="left" ><input name="cantidad" id="cantidad" type="text" size="5" value="<?php echo $lista[$i]['cantidad']; ?>" />
                      </td>
                      <td align="left" >

                      	<input name="posicion" id="posicion" type="text" size="4" value="<?php echo $lista[$i]['posicion']; ?>" />
                       </td><td> <input type="image"  src="../../images/mc/editar.jpg" >
                        <input type="hidden" id="id" name="id" value="<?php echo $lista[$i]['id']; ?>" />
                         <input type="hidden" id="id_producto" name="id_producto" value="<?php echo $_GET["id"]; ?>" />

                         <input type="hidden" id="action" name="action" value="modaccess" />

                        </td>

                      <td ><span style="padding-left:5px"><a href="exec.php?id=<?php echo $lista[$i]['id'];?>&amp;action=acttallacces&amp;id_producto=<?php echo $lista[$i]['id_producto'];?>">

					  		 <?php 	if ($lista[$i]['activado']==0) { 	?>
                                <img src="../../images/mc/red.jpg" alt="Desactivado">

					 <?php } else {?>
                          <img src="../../images/mc/green.png" alt="Activado">
					 <?php
					  }

					 ?></a></span></td>

		              <td ></td>


	                </tr></form>
		            <?php endfor;
					?>
                    </tbody>
	              </table>



				<?php else : ?>
		        	<p id="mensaje">No se encontraron tallas</p>
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
