<?php
$title_html="Manejador de contenido";
	include "../../include/headers2.php";
	$class="material";
?>
<script type="text/javascript" >
function isempty() {
		if (document.getElementById("name").value.length==0) {
		alert("Coloque el nombre");
		return false;
	} else {
		return true;
	}

}
</script>
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
          <td align="right"><a href="index.php">Volver</a></td>
          <td width="30"><a href="index.php"><img src="../../images/mc/volver.png" /></a></td>
        </tr>
      </table></td>
    </tr>
  </table>
        	<form action="exec.php" name="frm_mod_banner" id="frm_mod_banner" method="post"  onSubmit="javascript: return isempty();" >
               <?php

					if($_REQUEST['action']  == "mod") :
					tep_db_connect();
						$criterio = "id='".$_REQUEST["id"]."'";
						$listaSel = searchList($criterio,NULL,NULL,NULL,"*",TABLE_MATERIAL,1);
						tep_db_close();
					endif;

				?>

          	<table width="800" border="0" cellpadding="2" cellspacing="0" style="margin-left:50px">
            	<tr>
				  <td ><strong>MAETRIAL</strong></td>
   					 <td >&nbsp;</td>

		      </tr>
              <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>

              </tr>

            <tr>
              <td >Nombre</td>
              <td><input name="name" type="text" id="name" size="40" maxlength="255"  value="<?php  echo $listaSel[0]['name']; ?>" /></td>
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
