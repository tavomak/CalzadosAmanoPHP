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


?>
<!DOCTYPE html>
<html lang="en" >
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="../css/basic.css" />
    <link rel="stylesheet" type="text/css" href="../css/producto.css" />
	<script src="../js/jquery.js"></script>
    <script src="../js/jquery.imageLens.js"></script>
    <script type="text/javascript" language="javascript">
		$(function () {
			$("#zapato").imageLens({ lensSize: 300, borderSize: 0 });
		});
	</script>

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
		//document.getElementById("pp").innerHTML = precio
		document.getElementById("pp").innerHTML ="Bs.F "+res[2];
		document.getElementById("cantidad").options.length = 0;
		//document.getElementById("cantidad").options.length = n;
		j=0;
		n=parseInt(res[1])+1;
		for (var i=0; i < n; i++){
			j=i;
			document.getElementById("cantidad").options.add(new Option(j,j));

		}

		document.forms[0].cantidad[0].selected = true;
		document.getElementById("precio").value=res[2];
		document.getElementById("talla").value=res[0];
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

		<div class="container fade-in one">
        <div id="izquierda">

            <?php if ($prev>=0): ?>
            	<a href="detalle.php?id=<?php /*echo $obj->prev[0]['id']*/; echo $objCat->info[$prev]['id'];  ?>"><img src="../images/botones/flecha_der.png" width="26" height="26" style="position:absolute; top:50%; left:0; z-index:99"></a>
            <?php endif;?>
           <div id="cargazapato">
        	  <img  src="../images/producto/zoom/<?php echo $obj->info[0]['zoom']; ?>" id="zapato" >
 <?php if ($obj->info[0]['nuevo']=='1') : ?><div class="nuevo">NUEVO</div><?php endif; ?>

   <?php if (strlen($obj->info[0]['descuento'])>0) : ?><div class="descuento"><?php echo $obj->info[0]['descuento']; ?></div><?php endif; ?>
           </div>
              <div style="float:left; width:60px; height:100%; margin-left:20px; margin-top:40px">
              <?php for ($i=0;$i<count($obj->catalogo);$i++):
			  $nomImage=$obj->catalogo[$i]['thumb'];?>
              <a href="javascript: cargar('#cargazapato','cargazapato.php?zapato=<?php echo  $nomImage;?>&nuevo=<?php echo $obj->info[0]['nuevo'];?>&descuento=<?php echo $obj->info[0]['descuento']; ?>');"><img src="../images/producto/vistas/thumb/<?php echo  $nomImage;?>" width="60"></a>
              <?php endfor;

			switch ($obj->info[0]['categoria']){
			 case '1':
				  	$link='plantillas.php?id_zapato='.$id.'&id_categoria=5';
					break;
			default:
				  	$link='plantillas.php?id_zapato='.$id.'&id_categoria=9';
					break;

			}
			  ?>
              <a href="<?php echo $link; ?>" target="_top"><img src="../images/botones/plantilla.jpg" width="60"></a>
              </div>
         </div>
			<div id="derecha">
            	<div id="datos">
                <form id='myform' action="areacliente.php" method="post" target="_top">
            	<h1><?php echo $obj->info[0]['nombre'] ; ?></h1>
                <br><strong><span id="pp"></span></strong>
                <br><br>
                <p>Suela: <?php echo $sue->info[0]['name']; ?></p>
                <br>
                <p>Tipo: <?php echo $mat->info[0]['name']; ?></p>
                <br>

                <p>Tallas: <select name="latalla" onChange="javascript: llenado(this.value);">
                			<option disable value="">Seleccione</option>
                			<?php for ($i=0;$i<$n; $i++):
							$back=""; ?>
                            <option value="<?php echo $obj->infoTalla[$i]['id']."-".$obj->infoTalla[$i]['cantidad']."-".number_format($obj->infoTalla[$i]['precio'],2);?>" <?php if (($obj->infoTalla[$i]['activado']==1)&&($obj->infoTalla[$i]['cantidad']>0)):?>  <?php else: ?> style="color:#999;" <?php endif; ?>><?php echo $obj->infoTalla[$i]['nombre']; ?></option>
                        <?php    endfor; ?>
                			</select></p><br>

                  <div style="clear:both"></div>

                  Cantidad: <select name="cantidad" id="cantidad" onChange="javascript: activaAgregar(this.value);">
	</select>
                <br><br>
                 <p style="display:block">Colores</p><br>
                 <?php for ($i=0;$i<$c; $i++): ?>
                	<a href="detalle.php?id=<?php echo $obj->infoColor[$i]['id']; ?>" target="_self"><img  src="../images/producto/color/<?php echo $obj->infoColor[$i]['color']; ?>" width="10%" height="10%"></a>
                <?php endfor; ?>
                <br>
                <p id="botonp">

                <a href="javascript: enviarDatos();" class="btn_add" id="btn_add" style=" visibility:hidden "></a><a href="conversion.php" class="btn_conversion" target="_top"></a> <input type="text" id="id_zapato" name="id_zapato" style="visibility:hidden" value="<?php echo $id; ?>"><input type="text" id="precio" name="precio" style="visibility:hidden"><input type="text" id="talla" name="talla" style="visibility:hidden"> </p>
                </form>
                </div>
            <?php if (count($objCat->info)>$next): ?>
            	<a href="detalle.php?id=<?php echo $objCat->info[$next]['id']; ?>"><img src="../images/botones/flecha_izq.png" width="26" height="26" style="position:absolute; top:50%;right:0; z-index:99"></a>
            <?php endif;?>
                <div>

                </div>

            </div>
		</div> <!--fin container -->

        </div>  <!-- fin intwrapper -->

	</div>       <!-- fin wrapper -->

</body>
</html>
