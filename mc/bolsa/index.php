<?php
$title_html="Manejador de contenido";
include "../../include/headers2.php";
if ((isset($_POST['costo'])) && (strlen($_POST['costo']>0)) && (is_numeric($_POST['costo'])) && (isset($_POST['seguro'])) && (strlen($_POST['seguro']<1.0)) && (is_numeric($_POST['seguro'])) ){
	tep_db_connect();
		$sql_data_array = array('costo'=>$_POST['costo'],'seguro'=>$_POST['seguro']);
		tep_db_perform(TABLE_BOLSA,$sql_data_array, 'update', "1=1");
	tep_db_close();
}

	$criterio= "";
	$table=TABLE_BOLSA;
	$cant = 10; //cantidad maxima de elementos a buscar
	include "../../include/functions/top_paginator.php";
	$class="bolsa";


?>

</HEAD>
<div id="wrapper">
<header><div  id="logo" > Administrador de Contenido</div></header>
<div id="intwrapper">
	<div id="menu" ><?php include "../menu.php"; ?></div>
	<div id="content">
		<table border="0" cellspacing="0" cellpadding="0" >
		<tr><td >
		     <table border="0" align="left" cellspacing="10" >
              <tr>
		         <td colspan="4"><strong>Bolsa Zoom</strong></td>
              </tr>
              <form action="" name="edit<?php echo $i;?>" id="edit<?php echo $i;?>" method="post">
		       <tr>
		          <td align="center">Costo Bolsa</td>
                  <td ><input name="costo" type="text" value="<?php echo $lista[0]["costo"]; ?>" /></td>
                  <td></td>

		              <td ></td>
	                </tr>
                     <tr>
		          <td align="center">Seguro</td>
                  <td ><input name="seguro" type="text" value="<?php echo $lista[0]["seguro"]; ?>" /></td>
                  <td></td>

		              <td ></td>
	                </tr>
                     <tr>
		          <td align="center"></td>
                  <td ><input type="image" src="../../images/mc/editar.png" ><input name="id" type="hidden" value="<?php echo $lista[0]["id"]; ?>" /></td>
                  <td></td>

		              <td ></td>
	                </tr></form>

	           </table>

		     </td>
	        </tr>
      </table>

		</div>
    </div>
</div>

</body>
</HTML>
