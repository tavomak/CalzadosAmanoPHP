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
		<table>

    <tr>

      <td><strong><u>Cat&aacute;logo</u></strong></td>

    </tr>



    <tr>

      <td><strong><u>Zapatos</u></strong></td>

    </tr>

    <?php tep_db_connect(); $categorias= searchList("","posicion",NULL,NULL,"*",TABLE_CATEGORIA);

	tep_db_close();

	for ($i=0;$i<4; $i++) :?>

      <tr>

		<td><a href="<?php echo CMS; ?>inventario/zapatos.php?cat=<?php echo $categorias[$i]["id"]; ?>" <?php if ($class=="productos") { echo "class='selected'"; } ?>><?php echo $categorias[$i]["nombre"]; ?></a></td>

    </tr>

    <?php endfor; ?>
<tr>
      <td><strong><u>Plantillas</u></strong></td>
  </tr>
        <tr><td><a href="<?php echo CMS; ?>inventario/accesorios.php?cat=5" <?php if ($class=="plantillas") { echo "class='selected'"; } ?>>Beb&eacute;s</a></td></tr>
        <tr><td><a href="<?php echo CMS; ?>inventario/accesorios.php?cat=9" <?php if ($class=="plantillas") { echo "class='selected'"; } ?>>Ni&ntilde;as</a></td></tr>
        <tr><td><a href="<?php echo CMS; ?>inventario/accesorios.php?cat=8" <?php if ($class=="plantillas") { echo "class='selected'"; } ?>>Ni&ntilde;os</a></td></tr>
  <tr>
      <td><strong><u>Cintillos</u></strong></td>
  </tr>
  <tr>
      <td><a href="<?php echo CMS; ?>inventario/accesorios.php?cat=7" <?php if ($class=="cintillos") { echo "class='selected'"; } ?>>Beb&eacute;s</a>
      </td></tr>
       <tr>
      <td><a href="<?php echo CMS; ?>inventario/accesorios.php?cat=11" <?php if ($class=="cintillos") { echo "class='selected'"; } ?>>Ni&ntilde;as</a>
      </td></tr>
   <tr>
      <td><strong><u>Lazos</u></strong></td>
  </tr>
   <tr>
      <td><a href="<?php echo CMS; ?>inventario/accesorios.php?cat=6" <?php if ($class=="lazos") { echo "class='selected'"; } ?>>Beb&eacute;s</a></td>
      </tr>
       <tr>
      <td><a href="<?php echo CMS; ?>inventario/accesorios.php?cat=10" <?php if ($class=="lazos") { echo "class='selected'"; } ?>>Ni&ntilde;as</a></td>
      </tr>
  <tr>
      <td><strong><u>Pijamas</u></strong></td>
  </tr>

 <tr><td><a href="<?php echo CMS; ?>inventario/accesorios.php?cat=12" <?php if ($class=="pijamas") { echo "class='selected'"; } ?>>Beb&eacute;s</a></td></tr>
        <tr><td><a href="<?php echo CMS; ?>inventario/accesorios.php?cat=13" <?php if ($class=="pijamas") { echo "class='selected'"; } ?>>Ni&ntilde;as</a></td></tr>
        <tr><td><a href="<?php echo CMS; ?>inventario/accesorios.php?cat=14" <?php if ($class=="pijamas") { echo "class='selected'"; } ?>>Ni&ntilde;os</a></td></tr>
    <tr>

      <td><strong><u>Pedidos</u></strong></td>

    </tr>

     <tr><td><a href="<?php echo CMS; ?>inventario/poranular.php" <?php if ($class=="pedidos") { echo "class='selected'"; } ?>>Pedidos por anular</a></td></tr>

 </table>
<table width="130" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td colspan="2" align="left"><hr /></td>
  </tr>
  <tr>
    <td colspan="2" align="center">Leyenda</td>
  </tr>
  <?php if (strlen($class)==0) : ?>

  <tr>
    <td align="left">Eliminar</td>
    <td><img src="../images/mc/eliminar.png" /></td>
  </tr>
  <tr>
    <td align="left">Regresar</td>
    <td width="47"><img src="../images/mc/volver.png" /></td>
  </tr>

  <tr>
    <td align="left">Activar</td>
    <td align="left"><img src="../images/mc/green.jpg" alt="Desactivado" /></td>
  </tr>
  <tr>
    <td align="left">Desactivar</td>
    <td align="left"><img src="../images/mc/red.jpg" alt="Activo" /></td>
  </tr>
  <tr>
    <td align="left">Ir a Url</td>
    <td align="left"><img src="../images/mc/url.png" /></td>
  </tr>
  <tr>
    <td align="left">Aceptar</td>
    <td align="left"><a href="<?php echo $lista[$i]['enlace'];?>"><img src="../images/mc/ok.png" alt="" /></a></td>
  </tr>
  <tr>
    <td align="left">Cancelar</td>
    <td align="left"><a href="<?php echo $lista[$i]['enlace'];?>"><img src="../images/mc/cancelar.png" /></a></td>
  </tr>
  <tr>
    <td align="left">Buscar</td>
    <td><a href="<?php echo $lista[$i]['enlace'];?>"><img src="../images/mc/buscar.png" /></a></td>
  </tr>
  <?php else : ?>
  <tr>
    <td width="75" align="left">Agregar</td>
    <td width="47"><img src="../../images/mc/agregar.png" /></td>
  </tr>
  <tr>
    <td align="left">Eliminar</td>
    <td><img src="../../images/mc/eliminar.png" /></td>
  </tr>
  <tr>
    <td align="left">Regresar</td>
    <td width="47"><img src="../../images/mc/volver.png" /></td>
  </tr>
  <tr>
    <td align="left">Previsualizar</td>
    <td align="left"><a href="<?php echo $lista[$i]['enlace'];?>"><img src="../../images/mc/home.png" alt="" /></a></td>
  </tr>
  <tr>
    <td align="left">Editar</td>
    <td align="left"><img src="../../images/mc/editar.png" /></td>
  </tr>
  <tr>
    <td align="left">Activar</td>
    <td align="left"><img src="../../images/mc/green.jpg" alt="Desactivado" /></td>
  </tr>
  <tr>
    <td align="left">Desactivar</td>
    <td align="left"><img src="../../images/mc/red.jpg" alt="Activo" /></td>
  </tr>
  <tr>
    <td align="left">Ir a Url</td>
    <td align="left"><img src="../../images/mc/url.png" /></td>
  </tr>
  <tr>
    <td align="left">Aceptar</td>
    <td align="left"><a href="<?php echo $lista[$i]['enlace'];?>"><img src="../../images/mc/ok.png" alt="" /></a></td>
  </tr>
  <tr>
    <td align="left">Cancelar</td>
    <td align="left"><a href="<?php echo $lista[$i]['enlace'];?>"><img src="../../images/mc/cancelar.png" /></a></td>
  </tr>
  <tr>
    <td align="left">Buscar</td>
    <td><a href="<?php echo $lista[$i]['enlace'];?>"><img src="../../images/mc/buscar.png" /></a></td>
  </tr>
  <?php endif; ?>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>

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
