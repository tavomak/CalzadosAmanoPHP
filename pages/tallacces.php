<?php include "../include/configure.php";
include "../include/database_tables.php";
include "../include/functions/database.php";
include "../include/class/producto.php";

$colorprod= new producto();
$colorprod->loadCT($_GET['id'],$_GET['elcolor']) ;
$c=count($colorprod->infoColorTalla);
echo $c;?>

 Color:   <select name="talla"  id="talla" onchange="javascript: llenado(this.value)">
   <option value="0" id="nulo" >Selecciona</option>
    <?php for($i=0;$i<count($colorprod->infoColorTalla);$i++) : ?>
   <option value="<?php echo $colorprod->infoColorTalla[$i]["idTalla"].'-'.$colorprod->infoColorTalla[$i]["cantidad"]."-".number_format($colorprod->infoColorTalla[$i]["precio"],2)."-".$colorprod->infoColorTalla[$i]["dimensiones"]; ?>"> <?php echo $colorprod->infoColorTalla[$i]["nombre"]; ?> </option>
   <?php endfor; ?>
</select>
<script>
document.getElementById("medidas").innerHTML ='<?php echo $colorprod->infoColorTalla[0]["dimensiones"]; ?>';
</script>
