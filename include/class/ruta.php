<?php
class ruta
{
	function ruta() {
		$this->info=array();
	}

	function load($id){
		tep_db_connect();
		$this->info = searchList("id='" . $id . "'",NULL,0,NULL,"*", TABLE_RUTA);
		tep_db_close();
	}

	function loadEstado($estado){
		tep_db_connect();
		$this->info = searchList("estado='" . $estado . "'","ciudad",0,NULL,"*", TABLE_RUTA);
		tep_db_close();
	}

	function mod($id,$estado,$ciudad,$ruta,$local){
		tep_db_connect();
		$sql_data_array = array('estado'=>$estado,
								'ciudad'=>$ciudad,
								'local'=>$local,
								'ruta'=>$ruta);
		tep_db_perform(TABLE_RUTA,$sql_data_array, 'update', "id='" . $id . "'");
		tep_db_close();
	}

	function add($estado,$ciudad,$ruta,$local){
		tep_db_connect();

		$sql_data_array = array('estado'=>$estado,
								'ciudad'=>$ciudad,
								'local'=>$local,
								'ruta'=>$ruta);
		tep_db_perform(TABLE_RUTA, $sql_data_array);

		tep_db_close();
	}

	function del($id) {
		tep_db_connect();
		tep_db_perform(TABLE_RUTA,'', 'drop', "id='" . $id . "'");
		tep_db_close();
	}

}//fin class
?>
