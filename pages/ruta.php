<?php include "../include/configure.php";
include "../include/database_tables.php";
include "../include/functions/database.php";
include "../include/class/ruta.php";
$ruta=new ruta();
$ruta->loadEstado($_GET['estado']);?>
<select name="ciudad"  id="ciudad" onchange="javascript:cargar('#laagencia','agencia.php?ruta='+this.value);">
   <option value="">Selecciona</option>
    <?php for($i=0;$i<count($ruta->info);$i++) : ?>
   <option value="<?php echo $ruta->info[$i]["id"]; ?>" > <?php echo $ruta->info[$i]["ciudad"]; ?> </option>
   <?php endfor; ?>
</select>
