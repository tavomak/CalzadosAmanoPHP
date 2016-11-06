<?php
	include "../include/configure.php";
	include "../include/database_tables.php";
	include "../include/functions/database.php";
	include "../include/class/producto.php";
	include "../include/class/material.php";

	settype($_GET['id'],'integer')	;
	$id=$_GET['id'];
	$obj = new producto();

	settype($_GET['id_zapato'],'integer')	;
	$id_zapato=$_GET['id_zapato'];

	$obj->load($id);
	$obj->loadCatalogo($id_zapato);
	$obj->loadColorDistinct($_GET['id']) ;
	$m=count($obj->infoColorTalla);
	$colorActual=$obj->loadColorAcc($_GET['id']);

	$mat=new material();
	$mat->load( $obj->info[0]['material']);

	$objCat = new producto();
	$objCat->loadAccesorios($obj->info[0]['categoria']);

	for ($i=0;$i<count($objCat->info); $i++){
		if ($objCat->info[$i]['id']==$id){
			$next=$i+1;
			$prev=$i-1;
			break;
		}
	}


?>
<!DOCTYPE html>
<html lang="en" >
<head>
	<meta charset="UTF-8" />
<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="pragma" content="no-cache" />
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

}

/*function llenado(n, precio){*/
	function llenado(str){

	var res = str.split("-");
		var i=0;


		document.getElementById("pp").innerHTML ="BsF. "+res[2];
		//document.getElementById("medidas").innerHTML =res[3];
		document.getElementById("cantidad").options.length = 0;

		j=0;
		n=parseInt(res[1])+1;
		for (var i=0; i < n; i++){
			j=i;
			document.getElementById("cantidad").options.add(new Option(j,j));

		}

		document.forms[0].cantidad[0].selected = true;
		document.getElementById("precio").value=res[2];
		document.getElementById("talla").value=res[0];
		//document.getElementById("id_color").value=res[0];
		//document.getElementById("id_talla").value=res[0];
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
	<div id="myCarousel" class="carousel slide" data-ride="carousel" style="background:none;">
   <ol class="carousel-indicators">
  <?php  for ($i=0;$i<count($obj->catalogo)+1;$i++): ?>
    <li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" <?php echo ($i==0) ? 'class="active"' : ''; ?>></li>
  <?php endfor; ?>
  </ol>
  <div class="carousel-inner">
  <div class="item active" ><img src="../images/movil/plantilla.jpg" ></div>
  <?php  for ($i=0;$i<count($obj->catalogo);$i++):
  	$nomImage=$obj->catalogo[$i]['thumb'];?>
    <div class="item"><a href="detalle.php?id=<?php echo $id_zapato; ?>"> <img src="../images/producto/vistas/big/<?php echo  $nomImage;?>"></a>
     </div>
    <?php endfor; ?>
  </div>
  <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
</div>

<div class="datos">
	<form id='myform' action="areacliente.php" method="post" target="_top">
 		<h1><?php echo $obj->info[0]['nombre'] ; ?></h1>
        <p class="descripcion"><strong><span id="pp"></span></strong></p>
  <?php 	$obj->loadAllTalla($id);
	$n=count($obj->infoTalla); ?>
         <div class="fondoCampo" style="text-align:left; padding-left:20px"><p class="descripcion" >Tallas: <select name="latalla" onchange="javascript: llenado(this.value)" >
                			<option disable value="">Selec.</option>
                			<?php for ($i=0;$i<$n; $i++):
							$back=""; ?>
                            <option value="<?php echo $obj->infoTalla[$i]['id']."-".$obj->infoTalla[$i]['cantidad']."-".number_format($obj->infoTalla[$i]['precio'],2);?>" <?php if (($obj->infoTalla[$i]['activado']==1)&&($obj->infoTalla[$i]['cantidad']>0)):?>  <?php else: ?> style="color:#999;" <?php endif; ?>><?php echo $obj->infoTalla[$i]['nombre']; ?></option>
                        <?php    endfor; ?>
                			</select></p></div>

          <div class="fondoCampo" style="text-align:left; padding-left:20px"><p class="descripcion" >Cantidad: <select name="cantidad" id="cantidad" onChange="javascript: activaAgregar(this.value);">
	</select></p></div>

                <p id="botonp" style="width:61px;">

                <a href="javascript: enviarDatos();" class="btn_add" id="btn_add" style=" visibility:hidden "></a>
                <input type="text" id="id_zapato" name="id_zapato" style="visibility:hidden" value="<?php echo $id; ?>">
                <input type="text" id="precio" name="precio" style="visibility:hidden">
                <input type="text" id="talla" name="talla" style="visibility:hidden">
                </p>
                </form>
                </div>
</div>  <!-- fin intwrapper -->
</div>       <!-- fin wrapper -->
</body>
</html>
