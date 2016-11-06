<?php
$title_html="Manejador de contenido";
include "../../include/headers2.php";
$class="producto";

if (isset($_POST['categoria'])){

	include "../../include/class/producto.php";

	if (settype($_POST['categoria'],'int') && settype($_POST['talla'],'int')&& settype($_POST['precio'],'float') ){
		$obj = new producto();
		$obj->actualizaPrecio($_POST['categoria'],$_POST['talla'],$_POST['precio']); ?>
        <script>
		alert('Precios Actualizados');
		</script>
	<?php }
}
?>

</head>
<BODY>


<div id="wrapper">

    <header><div  id="logo" > Administrador de Contenido</div></header>
         <div id="intwrapper">
         <div id="menu" >
		 <?php include "../menu.php"; ?>
        </div>
		<div id="content">
<table width="800" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td><table class="fr" width="150" border="0" cellspacing="0" cellpadding="5">
        <tr>
          <td align="right"></td>
          <td width="30"></td>
        </tr>
      </table></td>
    </tr>
  </table>
        	<form  name="frm_mod_banner" id="frm_mod_banner" method="post" >
               <?php
						tep_db_connect();
					$categorias= searchList("","nombre",NULL,NULL,"*",TABLE_CATEGORIA);
					$tallas= searchList("","name",NULL,NULL,"*",TABLE_TALLA);
					tep_db_close();
				?>

          	<table width="800" border="0" cellpadding="2" cellspacing="0" style="margin-left:50px">
            	<tr>
				  <td width="161" ><strong>PRODUCTO</strong></td>
   					 <td width="631" >&nbsp;</td>

		      </tr>
              <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>

              </tr>
               <tr>
              <td >Categor&iacute;a</td>
              <td><select name="categoria"  id="categoria"><?php for($i=0;$i<count($categorias);$i++) : ?>
                         <option value="<?php echo $categorias[$i]["id"]; ?>"  <?php if ($listaSel[0]['categoria']==$categorias[$i]["id"]): echo 'selected="selected"'; endif; ?>><?php echo $categorias[$i]["nombre"]; ?></option>
                         <?php endfor; ?></select></td>

            </tr>

              <tr>
                 <td align="right">Talla</td>
                 <td ><select name="talla"  id="talla"><?php for($i=0;$i<count($tallas);$i++) : ?>
                         <option value="<?php echo $tallas[$i]["id"]; ?>" ><?php echo $tallas[$i]["name"]; ?></option>
                         <?php endfor; ?></select></td>
              </tr>

              <tr>
                <td align="right">Precio</td>
                <td ><input name="precio" type="text" id="precio" value="<?php  echo $listaSel[0]['precio']; ?>" /></td>
              </tr>

            </table>
             <input type="hidden" id="action" name="action" value="<?php echo $_REQUEST['action']; ?>" />
             <input type="hidden" id="id" name="id" value="<?php echo $listaSel[0]['id']; ?>" />
          <p class="botones">

        Aceptar   <input type="image" src="../../images/mc/ok.png" />


          </p>
        </form>
</DIV></DIV></DIV></DIV></DIV>

</body>
</HTML>
