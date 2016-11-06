<?php
	$title_html="Manejador de contenido";
	include "../../include/headers2.php";
	include "../../include/class/usuario.php";
	//$criterio= "activado='1' and estado='0' and DATE_SUB(CURDATE(),INTERVAL 2 DAY) > fecha";
	$criterio= "";
	$order="id DESC";
	$table=TABLE_PEDIDO;
	$cant = 50; //cantidad maxima de elementos a buscar
	include "../../include/functions/top_paginator.php";
	$class="pedidos";
?><script type="text/javascript" src="../../js/jquery.js"></script>
<script>
function cargar(div, destino){

  	 $(div).load(destino);

}
</script>
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
		         <td colspan="4" id="about_titulo">Pedidos abiertos</td>
              </tr>

	         </table>
		        <?php if(count($lista)>0) :
				$obj= new usuario(); ?>

                <table border="0" align="left" cellspacing="10" >
                  <tbody>
                  <tr>
                  <td>#Pedido</td>
                  <td>Fecha</td>
                  <td>Cliente</td>
                  <td>Telefono</td>
                  <td>Estado</td>
                  <td></td>
                  <td></td>
                  </tr>
                    <?php for($i=0;$i<count($lista);$i++) :
					$obj->infoUser($lista[$i]['id_usuario']) ?>
		            <tr>
                    <td><?php echo $lista[$i]['id'];  ?></td>
		              <td align="center"><?php $time = strtotime($lista[$i]['fecha']);echo date('d-m-Y',$time);  ?></td>
		              <td ><a href="javascript: cargar('#pedido<?php echo $i; ?>','elpedido.php?id=<?php echo $lista[$i]['id'];?>');" ><?php echo $obj->info[0]['nombre'];  ?></a></td>
		             <td><?php echo $obj->info[0]['telefono'];  ?></td>
		             <td><?php switch($lista[$i]['estado']) {
					 		case '0':
								echo 'En espera';
							break;
							case '1':
								echo 'Pagada';
							break;
							case '2':
								echo 'Anulada';
							break;
					 }?></td>
		             <td><a href="exec.php?id=<?php echo $lista[$i]['id'];?>&amp;action=anu&ini=<?php echo $ini; ?>" onClick="if (! confirm('Seguro que requiere anular el pedido Nro. <?php echo $lista[$i]['id']; ?>? Se actualizara el inventario!')) { return false; }" ><img src="../../images/mc/volver.png" width="26" height="26" title="Anular" /></a></td>
                  <td><a href="exec.php?id=<?php echo $lista[$i]['id'];?>&amp;action=del&ini=<?php echo $ini; ?>" onClick="if (! confirm('Seguro que requiere eliminar el pedido Nro. <?php echo $lista[$i]['id']; ?> sin modificar el inventario  ?')) { return false; }" ><img src="../../images/mc/eliminar.png" width="26" height="26" title="Eliminar" /></a></td>

	                </tr>
                    <tr>
                  <td colspan="7"><div id="pedido<?php echo $i; ?>"></div></td>
                  </tr>
		            <?php endfor; ?>
                    </tbody>
	              </table>


				<?php else : ?>
	        	<p  id="mensaje">No se encontraron productos cargados</p>
		        <?php endif; ?><br>
		     </td>
	        </tr>
      </table>
			<div id="footer_paginator" align="center" style="font-size:14px">
          		<p class="paginator">
          <?php

		  if($actual != $li) : ?>
          <a href="<?php echo $page.'ini='.max(($ini-$cant),0); ?>" style="text-decoration:none; color:#999">&lt;</a>
          <?php endif; ?>
          <?php
          	for($i=$li;$i<=$ls;$i++) : // para pintar las ventanas
				if($i==$actual) :
					echo '<strong>'.$i.'</strong>'.(($i == $ls) ? '' : ' ');
				else :
		  ?>
          <a href="<?php echo $page.'ini='.(($i - 1) * $cant); ?>" style="text-decoration:none; color:#999"><?php echo $i; ?></a>
          <?php
          			echo ($i == $ls) ? '' : ' ';
				endif;
			endfor;
		  ?>
          <?php if($actual < $ls) : ?>

          <a href="<?php echo $page.'ini='.($ini+$parc); ?>" style="text-decoration:none; color:#999">&gt;</a>
          <?php endif; ?>
</p>
        	</div>
		</div>
    </div>
</div>

</body>
</HTML>
