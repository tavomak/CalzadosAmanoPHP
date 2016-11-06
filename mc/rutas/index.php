<?php
$title_html="Manejador de contenido";
		include "../../include/headers2.php";
	$criterio= "";
	if (isset($_REQUEST['idc'])):
		if (strlen($_REQUEST['idc'])>0):
			$criterio="estado='".$_REQUEST['idc']. "'";
		endif;
	endif;
	$table=TABLE_RUTA;
	$cant = 10; //cantidad maxima de elementos a buscar
	include "../../include/functions/top_paginator.php";
	$class="rutas";
	tep_db_connect();
	$lista_city = searchList("","city_name",NULL,NULL,"*",TABLE_ESTADO);
	tep_db_close();
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
                 <select name="idc"  id="idc" style="width:300px;">
                 	<option value="" disabled="disabled">Filtrar aqui</option>
                    <option value="" >Sin filtro</option>
                	 <?php for($i=0;$i<count($lista_city);$i++) : ?>
                       <option value="<?php echo $lista_city[$i]["id_city"]; ?>" > <?php echo $lista_city[$i]["city_name"]; ?> </option>
                		<?php endfor; ?>
                	</select>
                <input name="ok" type="submit" value="ok" >
                </form></td>
              </tr>
                                   <tr>
                   <td>Estado</td>
                   <td>Ciudad</td>
                   <td>Ruta</td>
                   <td></td>
                   </tr>
                    <?php for($i=0;$i<count($lista);$i++) : ?>
                    <form action="exec.php" name="edit<?php echo $i;?>" id="edit<?php echo $i;?>" method="post">
		            <tr>
		              <td align="center"><select name="id_city" id="id_city">
                       <?php for($j=0;$j<count($lista_city);$j++) : ?>
                       <option value="<?php echo $lista_city[$j]["id_city"]; ?>"  <?php if ($lista[$i]["estado"]==$lista_city[$j]["id_city"]){ echo 'selected="selected"'; } ?> > <?php echo $lista_city[$j]["city_name"]; ?> </option>
                       <?php endfor; ?>
                   </select></td>
		              <td ><input name="ciudad" type="text" value="<?php echo $lista[$i]["ciudad"]; ?>" /></td>
                       <td><select name="local">
                      <option value="1" <?php if ($lista[$i]["local"]=='1'){ echo 'selected="selected"'; } ?>>Metropolitano</option>
                      <option value="0" <?php if ($lista[$i]["local"]=='0'){ echo 'selected="selected"'; } ?>>Nacional</option>
                    </select></td>
                       <td>
                      <select name="ruta" id="ruta">
                        <option value="1" <?php if ($lista[$i]["ruta"]=='1'){ echo 'selected="selected"'; } ?> >1</option>
                        <option value="2" <?php if ($lista[$i]["ruta"]=='2'){ echo 'selected="selected"'; } ?> >2</option>
                        <option value="3" <?php if ($lista[$i]["ruta"]=='3'){ echo 'selected="selected"'; } ?> >3</option>
                        <option value="4" <?php if ($lista[$i]["ruta"]=='4'){ echo 'selected="selected"'; } ?> >4</option>
                      </select>
                     </td>
		             <td align="center"><input type="image" src="../../images/mc/editar.png" ><input name="action" type="hidden" value="mod" /><input name="id" type="hidden" value="<?php echo $lista[$i]["id"]; ?>" /></td>
		              <td ><span style="padding-left:30px"><a href="exec.php?id=<?php echo $lista[$i]['id'];?>&amp;action=del" onClick="if (! confirm('Seguro que requiere eliminar la ruta <?php echo $lista[$i]['city_name']; ?> ?')) { return false; }" ><img src="../../images/mc/eliminar.png" width="26" height="26" alt="Eliminar" /></a></span></td>
	                </tr></form>
		            <?php endfor; ?>
                   <tr>
                   <td>Estado</td>
                   <td>Ciudad</td>
                   <td>Tipo Envio</td>
                   <td>Ruta</td>
                   <td></td>
                   <td></td>
                   </tr>
                   <form action="exec.php" name="nuevo" id="nuevo" method="post"><tr>
                   <td><select name="id_city" id="id_city">
                       <?php for($i=0;$i<count($lista_city);$i++) : ?>
                       <option value="<?php echo $lista_city[$i]["id_city"]; ?>" > <?php echo $lista_city[$i]["city_name"]; ?> </option>
                       <?php endfor; ?>
                   </select></td>
                   <td>
                     <input type="text" name="ciudad" id="ciudad" />
                  </td>
                  <td><select name="local">
                      <option value="1">Metropolitano</option>
                      <option value="0">Nacional</option>
                    </select></td>
                   <td>
                      <select name="ruta" id="ruta">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                      </select>
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
