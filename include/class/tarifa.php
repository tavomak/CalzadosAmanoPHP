<?php
class tarifa
{
	function tarifa() {
		$this->info=array();
	}

	function load($id){
		tep_db_connect();
		$this->info = searchList("id='" . $id . "'",NULL,0,NULL,"*", TABLE_TARIFA);
		tep_db_close();
	}
	function loadAll(){
		tep_db_connect();
		$this->info = searchList("",NULL,0,NULL,"*", TABLE_TARIFA);
		tep_db_close();
	}
	function mod($id,$desde,$hasta,$precio,$franqueo,$iva,$local,$ruta){
		tep_db_connect();
		$sql_data_array = array('desde'=>$desde,
								'hasta'=>$hasta,
								'iva'=>$iva,
								'precio'=>$precio,
								'franqueo'=>$franqueo,
								'local'=>$local,
								'ruta'=>$ruta);
		tep_db_perform(TABLE_TARIFA,$sql_data_array, 'update', "id='" . $id . "'");
		tep_db_close();
	}

	function add($desde,$hasta,$precio,$franqueo,$iva,$local,$ruta){
		tep_db_connect();

		$sql_data_array = array('desde'=>$desde,
								'hasta'=>$hasta,
								'iva'=>$iva,
								'precio'=>$precio,
								'franqueo'=>$franqueo,
								'local'=>$local,
								'ruta'=>$ruta);
		tep_db_perform(TABLE_TARIFA, $sql_data_array);

		tep_db_close();
	}

	function del($id) {
		tep_db_connect();
		tep_db_perform(TABLE_TARIFA,'', 'drop', "id='" . $id . "'");
		tep_db_close();
	}

}//fin class
?>
