<?php
$title_html="Manejador de contenido";
		include "../../include/headers2.php";
	$criterio= "";
	$table=TABLE_TARIFA;
	$cant = 200; //cantidad maxima de elementos a buscar
	include "../../include/functions/top_paginator.php";
	$class="Tarifas";
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
		         <td colspan="4" id="about_titulo">Tarifas Zoom *<small>favor usar punto decimal</small></td>
              </tr>

	         </table>


                <table border="0" align="left" cellspacing="10" >
                 <tr>
                    <td>Peso desde (gr)</td>
                    <td>Peso hasta(gr)</td>
                    <td>Precio </td>
                    <td>Franqueo Postal</td>
                    <td>Iva</td>
                    <td>Tipo Envio</td>
                    <td>Ruta</td>
                    <td></td>
                     <td></td>
                    <?php for($i=0;$i<count($lista);$i++) : ?>
                     <form id="mod<?php echo $lista[$i]['id']; ?>" action="exec.php" method="post">
		            <tr>
		               <td><input name="desde" type="text" size="10" value="<?php echo $lista[$i]['desde']; ?>" required="required" max="10000" pattern="\d*" title="Solo numeros" /></td>
                    <td><input name="hasta" type="text" size="10" value="<?php echo $lista[$i]['hasta']; ?>" required="required" max="10000" pattern="\d*" title="Solo numeros" /></td>
                    <td><input name="precio" type="text" size="10" value="<?php echo $lista[$i]['precio']; ?>" required="required"  pattern="\d+(\.\d{2})?" title="Numero con 2 decimales (use punto decimal)"/></td>
                    <td><input name="franqueo" type="text" size="10" value="<?php echo $lista[$i]['franqueo']; ?>" required="required" pattern="\d+(\.\d{2})?" title="Numero con 2 decimales (use punto decimal)"/></td>
                    <td><input name="iva" type="text" size="6"  value="<?php echo $lista[$i]['iva']; ?>" required="required" pattern="\d+(\.\d{2})?" title="Numero con 2 decimales (use punto decimal)"/></td>
                    <td><select name="local" >
                      <option value="1" <?php if ($lista[$i]['local']=='1'): echo 'selected="selected"'; endif; ?>>Metropolitano</option>
                      <option value="0" <?php if ($lista[$i]['local']=='0'): echo 'selected="selected"'; endif; ?>>Nacional</option>
                    </select></td>
                    <td><select name="ruta" id="ruta">
                      <option value="1" <?php if ($lista[$i]['ruta']=='1'): echo 'selected="selected"'; endif; ?>>1</option>
                      <option value="2" <?php if ($lista[$i]['ruta']=='2'): echo 'selected="selected"'; endif; ?>>2</option>
                      <option value="3" <?php if ($lista[$i]['ruta']=='3'): echo 'selected="selected"'; endif; ?>>3</option>
                      <option value="4" <?php if ($lista[$i]['ruta']=='4'): echo 'selected="selected"'; endif; ?>>4</option>
                      </select></td>

		             <td align="center"><input name="" type="image"  src="../../images/mc/editar.png" ></td>
		              <td ><span style="padding-left:30px"><a href="exec.php?id=<?php echo $lista[$i]['id'];?>&amp;action=del" onClick="if (! confirm('Seguro que requiere eliminar la tarifa  ?')) { return false; }" ><img src="../../image/mc/eliminar.jpg" width="26" height="26" alt="Eliminar" /></a></span></td>
	                </tr><input name="action" type="hidden" value="mod" /><input name="id" type="hidden" value="<?php echo $lista[$i]['id'];?>" />
                    </form>
		            <?php endfor; ?>

                    <tr>
                    <td>Peso desde (gr)</td>
                    <td>Peso hasta(gr)</td>
                    <td>Precio </td>
                    <td>Franqueo Postal</td>
                    <td>Iva</td>
                    <td>Tipo Envio</td>
                    <td>Ruta</td>
                    <td></td>
                     <td></td>

                    </tr>
                    <form action="exec.php" method="post">
                    <tr>
                    <td><input name="desde" type="text" size="10" required="required" max="10000" pattern="\d*" title="Solo numeros"/></td>
                    <td><input name="hasta" type="text" size="10" required="required"  max="10000" pattern="\d*" title="Solo numeros"/></td>
                    <td><input name="precio" type="text" size="10"  required="required" pattern="\d+(\.\d{2})?" title="Numero con 2 decimales (use punto decimal)"/></td>
                    <td><input name="franqueo" type="text" size="10"  required="required" pattern="\d+(\.\d{2})?" title="Numero con 2 decimales (use punto decimal)"/></td>
                    <td><input name="iva" type="text" size="6" required="required" pattern="\d+(\.\d{2})?" title="Numero con 2 decimales (use punto decimal)"/></td>
                    <td><select name="local">
                      <option value="1">Metropolitano</option>
                      <option value="0">Nacional</option>
                    </select></td>
                    <td><select name="ruta" id="ruta">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      </select></td>
                    <td><input name="" type="image" src="../../images/mc/agregar.png" /><input name="action" type="hidden" value="add" /></td> <td></td>
                    </tr></form>
	              </table>


				<br>
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
