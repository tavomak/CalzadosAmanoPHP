<?php
	include "zsession.php";
	include "../../include/headers2.php";
	$criterio = "";
	$table=TABLE_USUARIO;

	if (isset($_GET['id'])):
		settype($_GET['id'],"integer");
		tep_db_connect();
		tep_db_perform($table,'', 'drop', "id='" . $_GET['id'] . "'");
		tep_db_close();
	endif;

	$cant = 100; //cantidad maxima de elementos a buscar
	$order='usuario';
	include "../../include/functions/top_paginator.php";
	$class="usuario";

?>

<body>
<div id="wrapper">

 <header><div  id="logo" > Administrador de Contenido</div></header>
    <div id="intwrapper">
    <div id="menu" >
				<?php include "../menu.php"; ?>
    </div>
	<div id="content">

		  <table border="0" cellspacing="0" cellpadding="0"  class="texto" width="100%">
          <tr>
          	<td align="right">&nbsp;</td>
          </tr>
		    <tr>
		      <td ><table width="800" border="0" cellspacing="0" cellpadding="5">
	            <tr>
		            <td colspan="4" id="about_titulo">Usuarios</td>
                </tr>
		          <tr>
		            <td width="550" align="right"><a href="mod.php?action=add" style="float:right">Agregar Usuario</a></td>
		            <td><a href="mod.php?action=add" ><img src="../../images/mc/agregar.png" ></a></td>
		            <td align="right">&nbsp;</td>
		            <td width="30">&nbsp;</td>
	              </tr>
                  <tr>
		            <td width="550" align="right"><a href="descargasuscritos.php" style="float:right">Descargar Usuarios</a></td>
		            <td></td>
		            <td align="right">&nbsp;</td>
		            <td width="30">&nbsp;</td>
	              </tr>
	            </table>
		        <?php if(count($lista)>0) : ?>

		          <table width="800"  border="0" cellpadding="5"  cellspacing="0" >
		            <tr>
		              <td width="1" align="center">&nbsp;</td>

                      <td><strong>Login</strong></td>
                      <td><strong>Nombre Usuario</strong></td>
                      <td ></td>
                      <td ></td><td ></td>
                      <td ></td>
                      <td ></td>
                    </tr>
		            <?php for($i=0;$i<count($lista);$i++) : ?>
		            <tr>
		              <td width="1" align="center">&nbsp;</td>

                      <td><?php echo $lista[$i]['usuario']; ?></td>
                      <td><?php echo $lista[$i]['nombre']; ?></td>
                       <td ><a href="mod.php?id=<?php echo $lista[$i]['usuario'];?>&action=mod"><img src="../../images/mc/editar.png" ></a></td>
                      <td ><a href="mod.php?id=<?php echo $lista[$i]['usuario'];?>&action=modClave" onClick="if (! confirm('Seguro que requiere cambiar la clave de este usuario?')) { return false; }">Modificar Clave</a></td>
                     <td ></td>
                     <td ><a href="exec.php?id=<?php echo $lista[$i]['usuario'];?>&action=del" onClick="if (! confirm('Seguro que requiere eliminar este usuario?')) { return false; }"><img src="../../images/mc/eliminar.png" ></a></td>
                     <td >&nbsp;</td>
                      </tr>
		            <?php endfor; ?>
	              </table>


				<?php else : ?>
	        	<p  id="mensaje">Proceda a registrar usuarios</p>
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
</html>
