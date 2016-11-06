<?php include "zsession.php";
	include "../../include/headers2.php";
	include "../../include/class/usuario.php";

	if (($_GET['action']=='mod')||($_GET['action']=='modClave')) :
		if (strlen($_GET['id'])>10) :
			exit();
		endif;
		$obj = new usuario();
		$obj->load_usuario($_GET['id']);
	endif;
	$class="usuario";
?>

<script type="text/javascript">

function isempty_datos(modalidad) {
	if ((modalidad =='add')||(modalidad =='mod')) {
	if (document.getElementById("nombre_usuario").value.length==0){
		alert("Indique el nombre del usuario");
		return false;
	}

	if (document.getElementById("telefono").value.length==0){
		alert("Indique el telefono");
		return false;
	}

	re=/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/
    if(!re.exec(document.getElementById("email").value.toLowerCase()))    {
		alert("La direcci\u00f3n de email es incorrecta");
        return false;
    }

	for(i=0;i<document.getElementById("email").value.length;i++) {

		if(document.getElementById("email").value.charAt(i)==",") {
			alert("La direcci\u00f3n de email es incorrecta");
			return false;
		}
		if(document.getElementById("email").value.charAt(i)==";") {
			alert("La direcci\u00f3n de email es incorrecta");
			return false;
		}
		if(document.getElementById("email").value.charAt(i)==" ") {
			alert("La direcci\u00f3n de email es incorrecta");
			return false;
		}
	}
	}
	if ((modalidad =='add')||(modalidad =='modClave')) {

	if (document.getElementById("contrasena").value.length==0){
		alert("Escriba la contrasena");
		return false;
	}
	if (document.getElementById("clave").value.length==0){
		alert("Confirme la contrasena");
		return false;
	}

	if (document.getElementById("preguntseg").value.length==0){
		alert("La pregunta secreta le ayudara a recuperar su contrasena en caso de olvido");
		return true;
	}

	if (document.getElementById("respuesta").value.length==0){
		alert("Debe colocar una respuesta a la pregunta secreta para mayor seguridad");
		return false;
	}

	}
	return true;

}

//-->


</script>


<body>
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
  <table width="800" border="0" cellpadding="2" cellspacing="0" style="margin-left:50px">
            	<tr>
   					 <td colspan="2"><strong>DATOS DEL USUARIO</strong></td>
			  </tr>
 				 <tr>
 				   <td>&nbsp;</td>
 				   <td>&nbsp;</td>
		      </tr>
              <form action='exec.php' method="post" onSubmit="return isempty_datos(<?php echo $_GET['action']; ?>)">
 				 <?php if (($_GET['action']=='add') || ($_GET['action']=='mod')): ?>
                 <tr>
    				<td>Nombre Completo</td>
   					<td>                     	<input name="nombre" type="text" id="nombre" size="50" maxlength="50" value="<?php echo $obj->info[0]['nombre']; ?>"/>

                        </td>
  				</tr>

 				<tr>
    				<td>Teléfono</td>
    				<td>
                    <input name="telefono" type="text" id="telefono" size="30" maxlength="30" value="<?php echo $obj->info[0]['telefono']; ?>"/></td>
  				</tr>
  				<tr>
    				<td>Email</td>
    				<td>
   				    <input name="email" type="text" id="email" size="50" value="<?php echo $obj->info[0]['correo']; ?>"/></td>
  				</tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                 <?php endif; ?>
                <tr>
                   					 <td colspan="2"><strong>DATOS DE SEGURIDAD</strong></td>
   				 </tr>
 				 <tr>
 				   <td>&nbsp;</td>
 				   <td>&nbsp;</td>
			    </tr>
                <tr>
    				<td>Usuario</td>
    				<td>
                    <?php if ($_GET['action']=='add') : ?>
   				    <input name="usuario" type="text" id="usuario" size="50" value="<?php echo $obj->info[0]['usuario']; ?>"/></td>
  					<?php else :
							echo $obj->info[0]['usuario']; ?>
                         <input name="usuario" type="hidden" id="usuario" size="50" maxlength="50" value="<?php echo $obj->info[0]['usuario']; ?>"/>
						 <?php endif; ?>
                </tr>
 				 <tr>
 				   <td>Nivel</td>
 				   <td><select name="empleado" id="empleado">
 				     <option value="1" <?php echo ($obj->info[0]['empleado']=='1')?'selected':''; ?>>Administrador</option>
 				     <option value="2" <?php echo ($obj->info[0]['empleado']=='2')?'selected':''; ?>>Empleado</option>
 				     <option value="3" <?php echo ($obj->info[0]['empleado']=='3')?'selected':''; ?>>P&uacute;blico</option>
 				     </select></td>
		      </tr>
                <?php if (($_GET['action']=='add') || ($_GET['action']=='modClave')): ?>
 				 <tr>
   					 <td>Contrase&ntilde;a</td>
    				 <td>
   				     <input name="contrasena" type="text" id="contrasena" size="16" maxlength="16" /></td>
  				 </tr>
 				 <tr>
    				<td>Repetir Contraseña</td>
   					<td><input name="clave" type="text" id="clave" size="16" maxlength="16" /></td>
  				</tr>

  				 <?php endif; ?>

  				<tr>
  				  <td>&nbsp;</td>
  				  <td><input name="action" type="hidden" value="<?php echo $_GET['action']; ?>" />
                  <input type="image" src="../../images/mc/ok.png"  /></td>
				  </tr>
                </form>
			</table>


  </div>
 </div>
</div><!-- Fin Wrapper -->
</body>
</html>
