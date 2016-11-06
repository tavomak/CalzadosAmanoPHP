<?php
class agencia
{
	function agencia() {
		$this->info=array();
	}

	function load($id){
		tep_db_connect();
		$this->info = searchList("id='" . $id . "'",NULL,0,NULL,"*", TABLE_AGENCIA);
		tep_db_close();
	}

	function loadEstado($estado){
		tep_db_connect();
		$this->info = searchList("estado='" . $estado . "'","ciudad",0,NULL,"*", TABLE_AGENCIA);
		tep_db_close();
	}

	function mod($id,$id_ruta,$nombre,$direccion){
		tep_db_connect();
		$sql_data_array = array('id_ruta'=>$id_ruta,
								'nombre'=>$nombre,
								'direccion'=>$direccion);
		tep_db_perform(TABLE_AGENCIA,$sql_data_array, 'update', "id='" . $id . "'");
		tep_db_close();
	}

	function add($id_ruta,$nombre,$direccion){
		tep_db_connect();

		$sql_data_array = array('id_ruta'=>$id_ruta,
								'nombre'=>$nombre,
								'direccion'=>$direccion);
		tep_db_perform(TABLE_AGENCIA, $sql_data_array);

		tep_db_close();
	}

	function del($id) {
		tep_db_connect();
		tep_db_perform(TABLE_AGENCIA,'', 'drop', "id='" . $id . "'");
		tep_db_close();
	}

}//fin class
?>
