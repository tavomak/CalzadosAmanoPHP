<?php
class talla
{
	function talla() {
		$this->info=array();
	}

	function load($id){
		tep_db_connect();
		$this->info = searchList("id='" . $id . "'",NULL,0,NULL,"*", TABLE_TALLA);
		tep_db_close();
	}

	function mod($id,$name,$precio,$peso){
		tep_db_connect();
		$sql_data_array = array('name'=>$name,
								'precio'=>$precio,
								'peso'=>$peso);
		tep_db_perform(TABLE_TALLA,$sql_data_array, 'update', "id='" . $id . "'");
		tep_db_close();
	}

	function add($name,$precio,$peso){
		tep_db_connect();

		$sql_data_array = array('name'=>$name,
								'precio'=>$precio,
								'peso'=>$peso);
		tep_db_perform(TABLE_TALLA, $sql_data_array);

		tep_db_close();
	}

	function del($id) {
		tep_db_connect();
		tep_db_perform(TABLE_TALLA,'', 'drop', "id='" . $id . "'");
		tep_db_close();
	}

}//fin class
?>
