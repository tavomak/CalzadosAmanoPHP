<?php
	include "zsession.php";
	include "../../include/headers2.php";
	$cant = 200;
	$table=TABLE_BANNER;
	$order="activado DESC, posicion";
	include "../../include/functions/top_paginator.php";
	$class="banner";
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
		         <td colspan="2" id="about_titulo">Banners</td>
                 <td align="right" id="about_titulo">&nbsp;</td>
		       	  <td id="about_titulo">&nbsp;</td>
              </tr>
		       <tr>
		         <td width="550" align="right"><a href="mod.php?action=add" style="float:right">Agregar</a></td>
		         <td><a href="mod.php?action=add" ><img src="<?php echo IMAGENES; ?>mc/agregar.png" ></a></td>
		         <td align="right">&nbsp;</td>
		         <td width="30">&nbsp;</td>
	           </tr>
               		       <tr>
		         <td width="550" align="right"></td>
		         <td></td>
		         <td align="right">&nbsp;</td>
		         <td width="30">&nbsp;</td>
	           </tr>
	         </table>
		       <?php if(count($lista)>0) {
				   ?>
		       <table width="800" border="0" cellpadding="8" cellspacing="0"  >
                <tr>


                   <td >titulo</td>
		           <td >Imagen</td>
                  <td align="center" ></td>
                    <td width="30" align="center"></td>
                    <td width="150" align="center"></td>
                    <td width="150" align="center"></td>

                </tr>

		       <?php for ($i=0;$i<count($lista);$i++): ?>
		          <tr>

 	              <td><?php echo $lista[$i]['titulo']; ?></td>
                   <td><img src="<?php echo IMAGENES."banner/".$lista[$i]['imagen']; ?>" height="100"></td>

		           <td width="50" align="center"><a href="mod.php?id=<?php echo $lista[$i]['id'];?>&action=mod" ><img src="<?php echo IMAGENES; ?>mc/editar.png" ></a></td>
                   <td align="center" >&nbsp;</td>
                   <td><a href="exec.php?id=<?php echo $lista[$i]['id'];?>&action=del" onClick="if (! confirm('Seguro que requiere eliminar este banner?')) { return false; }"><img src="<?php echo IMAGENES; ?>mc/eliminar.png" alt="Eliminar"></a></td>

                     <td><a href="exec.php?id=<?php echo $lista[$i]['id'];?>&action=act" onClick="if (! confirm('Seguro que requiere cambiar el estado ?')) { return false; }"><?php if ($lista[$i]['activado']==0) {
					  	?><img src="<?php echo IMAGENES; ?>mc/red.jpg" alt="Activo">

				    <?php } else {?>
                         <img src="<?php echo IMAGENES; ?>mc/green.jpg" alt="Desactivado">
				    <?php
					  }?></a></td>
                       </tr>

                      <?php endfor; ?>
                       </table>
				<?php } ?></td>
	        </tr>
      </table>
      			<div id="footer_paginator" align="center" style="font-size:14px">
          	<p class="paginator">
          <?php
		 $var="";
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
</BODY>
</HTML>
