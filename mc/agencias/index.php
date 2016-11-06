<?php
$title_html="Manejador de contenido";
		include "../../include/headers2.php";
	$criterio= "";
	if (isset($_REQUEST['idr'])):
		if (strlen($_REQUEST['idr'])>0):
			$criterio="id='".$_REQUEST['idr']. "'";
		endif;
	endif;
	$table=TABLE_AGENCIA;
	$cant = 10; //cantidad maxima de elementos a buscar
	include "../../include/functions/top_paginator.php";
	$class="agencias";
	tep_db_connect();
	$lista_ruta = searchList("","estado, ciudad",NULL,NULL,"*",TABLE_RUTA);
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
		    <tr>  <td >

             <table border="0" align="left" cellspacing="10" >
              <tr>
		         <td colspan="4">
                <form method="post" action="index.php" >
                 <select name="idr"  id="idr">
                 	<option value="" disabled="disabled">Filtrar Ruta aqui</option>
                    <option value="" >Sin filtro</option>
                	 <?php
					 tep_db_connect();
					 for($i=0;$i<count($lista_ruta);$i++) :

					 	$lista_city = searchList("id_city='".$lista_ruta[$i]["estado"]."'","city_name",NULL,NULL,"*",TABLE_ESTADO);?>

                       <option value="<?php echo $lista_ruta[$i]['id']; ?>" > <?php echo $lista_city[0]["city_name"]."-".$lista_ruta[$i]["ciudad"]."-".$lista_ruta[$i]["ruta"]; ?> </option>
                		<?php endfor; ?>
                	</select>
                <input name="ok" type="submit" value="ok" >
                </form></td>
              </tr>
                                   <tr>
                   <td>Ruta</td>
                   <td>Nombre</td>
                   <td>Direcci&oacute;n</td>
                   <td></td>
                   </tr>
                    <?php for($i=0;$i<count($lista);$i++) : ?>
                    <form action="exec.php" name="edit<?php echo $i;?>" id="edit<?php echo $i;?>" method="post">
		            <tr>
		              <td align="center">
                                             <select name="id_ruta"  id="id_ruta">

                	 <?php for($j=0;$j<count($lista_ruta);$j++) :
					 	$lista_city = searchList("id_city='".$lista_ruta[$j]["estado"]."'","",NULL,NULL,"*",TABLE_ESTADO);?>

                       <option value="<?php echo $lista_ruta[$j]['id']; ?>"  <?php if ($lista[$i]["id_ruta"]==$lista_ruta[$j]["id"]){ echo 'selected="selected"'; } ?>> <?php echo $lista_city[0]["city_name"]."-".$lista_ruta[$j]["ciudad"]."-".$lista_ruta[$j]["ruta"]; ?> </option>
                		<?php endfor; ?>
                	</select>

                      </td>
		              <td ><input name="nombre" type="text" value="<?php echo $lista[$i]["nombre"]; ?>" /></td>
                       <td><textarea name="direccion"><?php echo $lista[$i]["direccion"]; ?></textarea>
                      </td>
		             <td align="center"><input type="image" src="../../images/mc/editar.png" ><input name="id" type="hidden" value="<?php echo $lista[$i]["id"]; ?>" /><input name="action" type="hidden" value="mod" /></td>
		              <td ><span style="padding-left:30px"><a href="exec.php?id=<?php echo $lista[$i]['id'];?>&amp;action=del" onClick="if (! confirm('Seguro que requiere eliminar esta agencia?')) { return false; }" ><img src="../../images/mc/eliminar.png" width="26" height="26" alt="Eliminar" /></a></span></td>
	                </tr></form>
		            <?php endfor; ?>
                   <tr>
                    <td>Ruta</td>
                   <td>Nombre</td>
                   <td>Direcci&oacute;n</td>
                   <td></td>
                   <td></td>
                   </tr>
                   <form action="exec.php" name="nuevo" id="nuevo" method="post"><tr>
                   <td> <select name="id_ruta"  id="id_ruta">

                 <option value=""  selected="selected" >Seleccione ruta</option>
                	 <?php for($j=0;$j<count($lista_ruta);$j++) :
					 	$lista_city = searchList("id_city='".$lista_ruta[$j]["estado"]."'","",NULL,NULL,"*",TABLE_ESTADO);?>
                       <option value="<?php echo $lista_ruta[$j]["id"]; ?>"  > <?php echo $lista_city[0]["city_name"]."-".$lista_ruta[$j]["ciudad"]."-".$lista_ruta[$j]["ruta"]; ?> </option>
                		<?php endfor; ?>
                	</select></td>
                   <td>
                     <input type="text" name="nombre" id="nombre" />
                  </td>
                   <td>
                      <textarea name="direccion"></textarea>
                     </td>
                   <td><input name="action" type="hidden" value="add" />
                   <input type="image" src="../../images/mc/agregar.png" ></td>
                   <td></td>
                   </tr></form>
	           </table>

		     </td>
	        </tr>
      </table>
			<div id="footer_paginator" align="center" style="font-size:14px">
          		<p class="paginator">
          <?php
		  tep_db_close();
		  if($actual != $li) : ?>
          <a href="<?php echo $page.'ini='.max(($ini-$cant),0).'&idr='.$_REQUEST["idr"]; ?>" style="text-decoration:none; color:#999">&lt;</a>
          <?php endif; ?>
          <?php
          	for($i=$li;$i<=$ls;$i++) : // para pintar las ventanas
				if($i==$actual) :
					echo '<strong>'.$i.'</strong>'.(($i == $ls) ? '' : ' ');
				else :
		  ?>
          <a href="<?php echo $page.'ini='.(($i - 1) * $cant).'&idr='.$_REQUEST["idr"]; ?>" style="text-decoration:none; color:#999"><?php echo $i; ?></a>
          <?php
          			echo ($i == $ls) ? '' : ' ';
				endif;
			endfor;
		  ?>
          <?php if($actual < $ls) : ?>

          <a href="<?php echo $page.'ini='.($ini+$parc).'&idr='.$_REQUEST["idr"]; ?>" style="text-decoration:none; color:#999">&gt;</a>
          <?php endif; ?>
</p>
        	</div>
		</div>
    </div>
</div>

</body>
</HTML>
