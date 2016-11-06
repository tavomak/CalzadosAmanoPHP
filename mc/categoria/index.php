<?php

	include "zsession.php";
	include "../../include/headers2.php";
	$cant = 200;
	$table=TABLE_CATEGORIA;
	$order="activado DESC, posicion";
	include "../../include/functions/top_paginator.php";
	$class="categoria";
?>

<BODY>
<div id="wrapper">

<header><div  id="logo" > Administrador de Contenido</div></header>
    <div id="intwrapper">
    <div id="menu" >
		<?php include "../menu.php"; ?>
    </div>
	<div id="content">
		<table border="0" cellspacing="0" cellpadding="0" width="100%" >
		<tr>
		   <td ><table width="800" border="0" cellspacing="0" cellpadding="5">
	          <tr>
		         <td colspan="4" id="about_titulo">Categoría</td>
              </tr>
		       <tr>
		         <td width="550" align="right"><a href="mod.php?action=add" style="float:right">Agregar Categoría <?php echo $obj->info[0]['nombre']; ?></a></td>
		         <td><a href="mod.php?action=add" ><img src="../../images/mc/agregar.png" ></a></td>
		         <td align="right">&nbsp;</td>
		         <td width="30">&nbsp;</td>
	           </tr>
	         </table>
		       <?php if(count($lista)>0) {?>
		       <table width="800" border="0" cellpadding="8" cellspacing="0"  >
                <tr>
                	<th ></th>
                    <th ></th>
		           <th >Nombre Banner</th>
                   <td width="30" align="center" >&nbsp;</td>
                    <td width="30" align="center">&nbsp;</td>
                    <td width="150" align="center">&nbsp;</td>
                    <td width="30">&nbsp;</td>
                     <th width="150">&nbsp;</th>
                </tr>
              <?php
			  tep_db_connect();
			  for($i=0;$i<count($lista);$i++) : ?>
		        <tr>
                <td></td>
		           <td> <img src="<?php echo IMAGENES."categoria/".$lista[$i]['image_off']; ?>" style="max-width:150px;"/></td>

                   <td><?php echo $lista[$i]['nombre']; ?></td>

		           <td width="50" align="center"><a href="mod.php?id=<?php echo $lista[$i]['id'];?>&action=mod" ><img src="../../images/mc/editar.png" ></a></td>
                   <td width="50" align="center" ><a href="exec.php?id=<?php echo $lista[$i]['id'];?>&action=act" onClick="if (! confirm('Seguro que requiere cambiar el estado de esta categoria?')) { return false; }"><?php if ($lista[$i]['activado']==0) {
					  	?><img src="../../images/mc/red.jpg" alt="Activo">

				    <?php } else {?>
                         <img src="../../images/mc/green.jpg" alt="Desactivado">
				    <?php
					  }?></a></td>

                     <td width="50" align="center"><a href="exec.php?id=<?php echo $lista[$i]['id'];?>&action=del" onClick="if (! confirm('Seguro que requiere eliminar esta categoria?')) { return false; }"><img src="../../images/mc/eliminar.png" alt="Eliminar"></a></td>
                     <td>&nbsp;</td>
                     <td>&nbsp;</td>
                      </tr>
		            <?php endfor;
					tep_db_close(); ?>
 	             			 </table>
				<?php } else { ?>
        	 <p class="Lista">Proceda a registrar banners</p>
		        <?php }?></td>
	        </tr>
      </table>
		 </div>
    </div>
</div>
</BODY>
</HTML>
