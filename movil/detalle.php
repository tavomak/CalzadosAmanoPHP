<?php
	include "../include/configure.php";
	include "../include/database_tables.php";
	include "../include/functions/database.php";
	include "../include/class/producto.php";
	include "../include/class/suela.php";
	include "../include/class/material.php";

	settype($_GET['id'],'integer')	;
	$id=$_GET['id'];
	$obj = new producto();
	$obj->load($id);
	$obj->loadCatalogo($id);
	$obj->loadAllTalla($id);
	$n=count($obj->infoTalla);
	$obj->loadColor($id,$obj->info[0]['nombre'],$obj->info[0]['material'],$obj->info[0]['categoria']);
	$c=count($obj->infoColor);

	$sue=new suela();
	$sue->load( $obj->info[0]['suela']);

	$mat=new material();
	$mat->load( $obj->info[0]['material']);

	$objCat = new producto();
	$objCat->loadCategoria($obj->info[0]['categoria']);

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
		case '1':
			$volver='bebes.php';
		break;
		case '2':
			$volver='girls.php';
		break;
		case '3':
			$volver='boys.php';
		break;
		case '4':
			$volver='colegial.php';
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

function selTalla(v){
	document.getElementById('talla').value=v;
	 var x = document.getElementsByClassName("itemTalla hay");
	for (i=0;i<x.length;i++) {
		x[i].style.backgroundColor='#FFF';
		x[i].style.color='#01b7c2';
	}
	document.getElementById('t'+v).style.backgroundColor='#01b7c2';
	document.getElementById('t'+v).style.color='#FFF';

}

function cargar(div, destino){
  	 $(div).load(destino);

}

/*function llenado(n, precio){*/
	function llenado(str){

	var res = str.split("-");
		var i=0;
		document.getElementById("descuento").innerHTML ="BsF. "+res[3];
		document.getElementById("pp").innerHTML ="BsF. "+res[2];
		document.getElementById("cantidad").options.length = 0;

		j=0;
		n=parseInt(res[1])+1;
		for (var i=0; i < n; i++){
			j=i;
			document.getElementById("cantidad").options.add(new Option(j,j));

		}

		document.forms[0].cantidad[0].selected = true;
		document.getElementById("precio").value=res[2];
		if (parseFloat(res[3])>0) {
		document.getElementById("precio").value=res[3];
		} else {document.getElementById("precio").value=res[2];}
		document.getElementById("talla").value=res[0];
}

function muestraLista(){ $('#listaColores').fadeToggle();}

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
  <?php  for ($i=0;$i<count($obj->catalogo)+1;$i++): ?>
    <li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" <?php echo ($i==0) ? 'class="active"' : ''; ?>></li>
  <?php endfor; ?>
  </ol>
  <div class="carousel-inner">
  <?php  for ($i=0;$i<count($obj->catalogo);$i++):
  	$nomImage=$obj->catalogo[$i]['thumb'];?>
    <div class="item <?php echo ($i==0) ? 'active' : ''; ?>"> <img src="../images/producto/vistas/big/<?php echo  $nomImage;?>">
     </div>
    <?php endfor;

	if ($obj->info[0]['plantilla']==0) {
     switch ($obj->info[0]['categoria']){
		case '1':
				  	$link='plantillas.php?id_zapato='.$id.'&id_categoria=5';
					break;
			default:
				  	$link='plantillas.php?id_zapato='.$id.'&id_categoria=9';
					break;

	  }  ?>
      <div class="item" ><a href="<?php echo $link; ?>" target="_top"><img src="../images/movil/plantilla.jpg" ></a></div>
      <?php } ?>
  </div>


  <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>

   <?php if ($obj->info[0]['nuevo']=='1') : ?><div class="nuevo" id="nuevo">NUEVO</div><?php endif; ?>

   <?php if (strlen($obj->info[0]['descuento'])>0) : ?><div class="descuento" id="globDescuento"><?php echo $obj->info[0]['descuento']; ?></div><?php endif; ?>

</div>

<div class="datos">
	<form id='myform' action="areacliente.php" method="post" target="_top">
		<h1><?php echo $obj->info[0]['nombre'] ; ?></h1>
        <p class="descripcion"><strong><span id="pp" <?php if (strlen($obj->info[0]['descuento'])>0) : ?>style="text-decoration:line-through;"<?php endif; ?>></span><br><span id="descuento" style="margin-left:-1px; display:none; <?php if (strlen($obj->info[0]['descuento'])>0) : ?>display:block;<?php endif; ?>"></span></strong></p>
        <p class="descripcion">Suela: <?php echo $sue->info[0]['name']; ?></p>
		<p class="descripcion">Tipo: <?php echo $mat->info[0]['name']; ?></p>
 <div class="fondoCampo" style="text-align:left; padding-left:20px"><p class="descripcion" >Tallas: <select name="latalla" onChange="javascript: llenado(this.value);" style="width:60px;">
                			<option disable value="">Selec.</option>
                			<?php for ($i=0;$i<$n; $i++):
							if ($obj->infoTalla[$i]['activado']==0): continue; endif;
							$back=""; $descuento=$obj->infoTalla[$i]['precio']*$porcentaje; ?>
                            <option value="<?php echo $obj->infoTalla[$i]['id']."-".$obj->infoTalla[$i]['cantidad']."-".number_format($obj->infoTalla[$i]['precio'],2)."-".number_format($descuento,2);?>" <?php if (($obj->infoTalla[$i]['activado']==1)&&($obj->infoTalla[$i]['cantidad']>0)):?>  <?php else: ?> style="color:#999;" <?php endif; ?>><?php echo $obj->infoTalla[$i]['nombre']; ?></option>
                        <?php    endfor; ?>
                			</select></p></div>

 <div class="fondoCampo" style="margin-top:2px;text-align:left; padding-left:20px;"><p class="descripcion" >
                   Cantidad: <select name="cantidad" id="cantidad" onChange="javascript: activaAgregar(this.value);"  style="width:60px;">
	</select></p></div>

<div class="fondoCampo" style="text-align:left; padding-left:20px"> <p class="descripcion" ><a href="javascript: muestraLista();" style="text-decoration:none; color:#fff;">Otros colores disponibles</a></p> </div>
<div id="listaColores">
                 <?php for ($i=0;$i<$c; $i++): ?>
                	<a href="detalle.php?id=<?php echo $obj->infoColor[$i]['id']; ?>" target="_self"><img  src="../images/producto/color/<?php echo $obj->infoColor[$i]['color']; ?>" width="10%" height="10%"></a>
                <?php endfor; ?>
</div>
         <div id="botonp">

                <a href="javascript: enviarDatos();" class="btn_add" id="btn_add" style=" visibility:hidden "></a><a href="conversion.php" class="btn_conversion" target="_top"></a>
        </div><br>
        <input type="text" id="id_zapato" name="id_zapato" style="visibility:hidden" value="<?php echo $id; ?>"><input type="text" id="precio" name="precio" style="visibility:hidden"><input type="text" id="talla" name="talla" style="visibility:hidden">
    </form>
    <br><br>
</div>

</div>
</div>
</body>
</html>
