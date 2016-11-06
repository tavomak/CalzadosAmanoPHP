<?php
	include "../include/configure.php";
	include "../include/database_tables.php";
	include "../include/functions/database.php";
	include "../include/class/producto.php";
	include "../include/class/material.php";

	settype($_GET['id'],'integer')	;
	$id=$_GET['id'];
	$obj = new producto();
	$obj->load($id);
	$obj->loadCatalogo($id);
	$obj->loadColorDistinct($_GET['id']) ;
	$m=count($obj->infoColorTalla);
	$colorActual=$obj->loadColorAcc($_GET['id']);

	if (($obj->info[0]['categoria']!='5')&&($obj->info[0]['categoria']!='9')&&($obj->info[0]['categoria']!='8')):
		$mat=new material();
		$mat->load( $obj->info[0]['material']);
	endif;

	$objCat = new producto();
	$objCat->loadAccesorios($obj->info[0]['categoria']);

	for ($i=0;$i<count($objCat->info); $i++){
		if ($objCat->info[$i]['id']==$id){
			$next=$i+1;
			$prev=$i-1;
			break;
		}
	}

	if (strlen($obj->info[0]['descuento'])>0) {
		$porcentaje =(100 - intval(preg_replace('/[^0-9]+/', '', $obj->info[0]['descuento']), 10))/100;
	} else {
		$porcentaje =0;
	}

	switch ($obj->info[0]['categoria']){
		case '5':
			$volver='plantillasb.php';
		break;
		case '6':
			$volver='lazosb.php';
		break;
		case '7':
			$volver='cintillosb.php';
		break;
		case '8':
			$volver='plantillaso.php';
		break;
		case '9':
			$volver='plantillasg.php';
		break;
		case '10':
			$volver='lazosg.php';
		break;
		case '11':
			$volver='cintillosg.php';
		break;
		case '12':
			$volver='pijamasb.php';
		break;
		case '13':
			$volver='pijamasg.php';
		break;
		case '14':
			$volver='pijamaso.php';
		break;
	}

?>
<!DOCTYPE html>
<html lang="en" >
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="../css/stylesmovil.css">
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<link href="../css/jquerysctipttop.css" rel="stylesheet" type="text/css">
 <link href="../css/responsive.css" rel="stylesheet" type="text/css">
<script>
		var objeto = false;

		function crearObjeto() {
 		// --- Crear el Objeto dependiendo los diferentes Navegadores y versiones ---
 		try { objeto = new ActiveXObject("Msxml2.XMLHTTP");  }
 		catch (e) {
			 try { objeto = new ActiveXObject("Microsoft.XMLHTTP"); }
 			 catch (E) {
				objeto = false; }
		}
 		// --- Si no se pudo crear... intentar este ultimo metodo ---
 		if (!objeto && typeof XMLHttpRequest!='undefined') {
   			objeto = new XMLHttpRequest();
 		}
		}

// ------------------------------

	function leerDatos() {

 	crearObjeto();

 	if (objeto.readyState != 0) {
   		alert('Error al crear el objeto XML. El Navegador no soporta AJAX');
 	} else {
   		// Preparar donde va a recibir el Resultado
   		objeto.onreadystatechange = procesaResultado;
   		// Enviar la consulta
   		objeto.open("POST", "areacliente.php", true);
		objeto.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

  		objeto.send(retornarDatos());
 	}
	}

// ------------------------------

	function retornarDatos()
	{
		var cad='';
 		var id_zapato=document.getElementById('id_zapato').value;
  		var indice = document.getElementById('talla').selectedIndex;
        var talla = document.getElementById('talla').options[indice].value ;
		cad='id_zapato='+encodeURIComponent(id_zapato)+'&talla='+encodeURIComponent(talla);

		return cad;
}

function procesaResultado() {
// Si aun esta revisando los datos...
if (objeto.readyState == 1) {
 document.getElementById('resultado').innerHTML = "Cargando datos...";
}
// Si el estado es 4 significa que ya termino
if (objeto.readyState == 4) {
 // objeto.responseText trae el Resultado que metemos al DIV de arriba
 document.getElementById('resultado').style.display="block";
 document.getElementById('resultado').innerHTML = objeto.responseText;
}
}

function enviarDatos(){
	document.forms["myform"].submit();
}

function cargar(div, destino){
  	 $(div).load(destino);
	 document.getElementById("cantidad").options.length = 0;
}

/*function llenado(n, precio){*/
	function llenado(str){

	var res = str.split("-");
		var i=0;

		document.getElementById("cantidad").options.length = 0;

		j=0;
		n=parseInt(res[1])+1;

		for (var i=0; i < n; i++){
			j=i;
			document.getElementById("cantidad").options.add(new Option(j,j));

		}

		document.getElementById("descuento").innerHTML ="BsF. "+res[4];
		document.getElementById("pp").innerHTML ="BsF. "+res[2];
		document.getElementById("medidas").innerHTML =res[3];


		document.forms[0].cantidad[0].selected = true;
		document.getElementById("precio").value=res[2];
		if (parseFloat(res[4])>0) {
		document.getElementById("precio").value=res[4];
		} else {document.getElementById("precio").value=res[2];}

}

function activaAgregar(x){
	if (parseInt(x)>0) {
		document.getElementById('btn_add').style.visibility="visible";
	}
}

	</script>
</head>

<body>
<div id="wrapper">
<div id="intwrapper">
	<div class="titulo" ><a href="<?php echo $volver; ?>" target="_top">< Volver</a></div>
	<div id="myCarousel" class="carousel slide" data-ride="carousel" style="background:none;">
  <!-- Indicators -->
  	<ol class="carousel-indicators">
  <?php  for ($i=0;$i<count($obj->catalogo);$i++): ?>
    <li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" <?php echo ($i==0) ? 'class="active"' : ''; ?>></li>
  <?php endfor; ?>
  	</ol>
  	<div class="carousel-inner">
  <?php  for ($i=0;$i<count($obj->catalogo);$i++):
  	 	$nomImage=$obj->catalogo[$i]['thumb'];?>
    <div class="item <?php echo ($i==0) ? 'active' : ''; ?>"> <img src="../images/producto/vistas/big/<?php echo  $nomImage;?>">
     </div>
    <?php endfor; ?>
  </div>
  <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
     <?php if ($obj->info[0]['nuevo']=='1') : ?><div class="nuevo">NUEVO</div><?php endif; ?>

   <?php if (strlen($obj->info[0]['descuento'])>0) : ?><div class="descuento"><?php echo $obj->info[0]['descuento']; ?></div><?php endif; ?>
</div>

<div class="datos">
	<form id='myform' action="areacliente.php" method="post" target="_top">
		<h1><?php echo $obj->info[0]['nombre'] ; ?></h1>
        <p class="descripcion"><strong><span id="pp" <?php if (strlen($obj->info[0]['descuento'])>0) : ?>style="text-decoration:line-through;"<?php endif; ?>></span><br><span id="descuento" style="margin-left:-1px; display:none; <?php if (strlen($obj->info[0]['descuento'])>0) : ?>display:block;<?php endif; ?>"></span></strong></p>
        <?php if (($obj->info[0]['categoria']!='5')&&($obj->info[0]['categoria']!='9')&&($obj->info[0]['categoria']!='8')):?>
        <p class="descripcion">Tipo: <?php echo $mat->info[0]['name']; ?></p>
		<?php endif; ?>
        <?php if (($obj->info[0]['categoria']=='6')||($obj->info[0]['categoria']=='7')||($obj->info[0]['categoria']=='10')||($obj->info[0]['categoria']=='11')):?>
        <p class="descripcion">Medidas: <span id="medidas"></span></p>
		<?php endif; ?>
        <div class="fondoCampo" style="text-align:left; padding-left:20px" > <p class="descripcion" >Tallas: <select name="talla" onchange="javascript: llenado(this.value)"  style="width:100px;" >
                			<option disable value="">Selec.</option>
                			<?php $obj->loadCT($id,$colorActual['id_color']);
	$n=count($obj->infoColorTalla);
	for ($i=0;$i<$n; $i++):
							if ($obj->infoColorTalla[$i]['activado']==0): continue; endif;
							$descuento=$obj->infoColorTalla[$i]['precio']*$porcentaje; ?>
                            <option value="<?php echo $obj->infoColorTalla[$i]["idTalla"].'-'.$obj->infoColorTalla[$i]["cantidad"]."-".number_format($obj->infoColorTalla[$i]["precio"],2)."-".$obj->infoColorTalla[$i]["dimensiones"] ."-".number_format($descuento,2); ?>"> <?php echo $obj->infoColorTalla[$i]["nombre"]; ?></option>
                        <?php    endfor; ?>
                			</select></p></div>

   <div class="fondoCampo" style="text-align:left; padding-left:20px" > <p class="descripcion" > Cantidad: <select name="cantidad" id="cantidad" onChange="javascript: activaAgregar(this.value);" style="width:100px;">
	</select>
                </p></div>

 		<div class="fondoCampo" style="text-align:left; padding-left:20px"><p class="descripcion" >Otros colores disponibles: <select name="el_color"  id="el_color" onChange="javascript: window.location.href='detaccesorio.php?id='+ this.value;"  style="width:100px;" >
                <?php $obj->loadColorDistinct($_GET['id']) ;
	$m=count($obj->infoColorTalla);
	for ($i=0;$i<$m; $i++):
							$back=""; ?>
                            <option value="<?php echo $obj->infoColorTalla[$i]['id'];?>" <?php echo ($obj->infoColorTalla[$i]['id']==$id) ? 'selected="selected"':''; ?>   ><?php echo $obj->infoColorTalla[$i]['nombre']; ?></option>
                        <?php    endfor; ?>
                </select></p></div>






                <p id="botonp" style="width:61px;">

                <a href="javascript: enviarDatos();" class="btn_add" id="btn_add" style="visibility:hidden;"></a>
                <input type="text" id="id_zapato" name="id_zapato" style="visibility:hidden" value="<?php echo $id; ?>">
                <input type="text" id="precio" name="precio" style="visibility:hidden">
               <input type="text" id="id_color" name="id_color" style="visibility:hidden" value="<?php echo $colorActual['id_color']; ?>">

                </p>
                </form>
	</div>

</div>  <!-- fin intwrapper -->
</div>       <!-- fin wrapper -->
</body>
</html>
