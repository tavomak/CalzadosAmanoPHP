<?php include "../include/configure.php";
include "../include/database_tables.php";
include "../include/functions/database.php";

tep_db_connect();
$agencia = searchList("id_ruta='" . $_GET['ruta'] . "'",NULL,0,NULL,"*", TABLE_AGENCIA);
tep_db_close();?>
<select name="agencia"  id="agencia" onchange="javascript: vaciarDireccion(this.value)">
   <option value="" id="nulo" >Selecciona</option>
    <?php for($i=0;$i<count($agencia);$i++) : ?>
   <option value="<?php echo $agencia[$i]["id"]; ?>" title=" <?php echo $agencia[$i]["direccion"]; ?>"  > <?php echo $agencia[$i]["nombre"]; ?> </option>
   <?php endfor; ?>
</select>
