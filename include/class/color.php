<?php
class color
{
	function color() {
		$this->info=array();
	}

	function load($id){
		tep_db_connect();
		$this->info = searchList("id='" . $id . "'",NULL,0,NULL,"*", TABLE_COLOR);
		tep_db_close();
	}

	function mod($id_color,$name,$posicion,$activado){
		tep_db_connect();
		$sql_data_array = array('nombre'=>$name,
								'posicion'=>$posicion,
								'activado'=>$activado);
		tep_db_perform(TABLE_COLOR,$sql_data_array, 'update', "id='" . $id_color . "'");
		tep_db_close();
	}

	function add($name,$posicion,$activado){
		tep_db_connect();

		$sql_data_array = array('nombre'=>$name,
								'posicion'=>$posicion,
								'activado'=>$activado);
		tep_db_perform(TABLE_COLOR, $sql_data_array);
		tep_db_close();
	}

	function del($id) {
		tep_db_connect();
		tep_db_perform(TABLE_COLOR,'', 'drop', "id='" . $id . "'");
		tep_db_close();
	}

		function act($id){

		tep_db_connect();
		$this->info = searchList("id='" . $id . "'",NULL,0,NULL,"*", TABLE_COLOR);
		if ($this->info[0]["activado"]==0){
			$sql_data_array = array('activado'=>1);
		} else {
			$sql_data_array = array('activado'=>0);
		}
		tep_db_perform(TABLE_COLOR, $sql_data_array, 'update', "id='$id'");
		tep_db_close();
	}

}//fin class
?>
