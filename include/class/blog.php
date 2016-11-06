<?php
class blog
{
	function blog() {
		$this->info=array();
	}

	function load($id){
		tep_db_connect();
		$this->info = searchList("id='" . $id . "'",NULL,0,NULL,"*", TABLE_BLOG);
		tep_db_close();
	}


	function add(){

		tep_db_connect();
		//Agregando en la tabla de aliado
		$sql_data_array = array('titulo'=>'');
		tep_db_perform(TABLE_BLOG, $sql_data_array);

		$ultimate_product=tep_db_query("SELECT MAX(id) FROM " . TABLE_BLOG);
		$row=tep_db_fetch_row($ultimate_product);

		tep_db_close();
		return $row[0];
	}

	function mod($id,$titulo,$image,$texto,$posicion,$activado){
		tep_db_connect();

		$sql_data_array = array('titulo'=>$titulo,
								'texto'=>$texto,
								'posicion'=>$posicion,
								'activado'=>$activado);
		tep_db_perform(TABLE_BLOG, $sql_data_array, 'update', "id='" . $id . "'");


		$new_name_color=$id.substr($image, -4);

		chmod("../../images/blog/".$image, 0755);
		rename("../../images/blog/".$image, "../../images/blog/".$new_name_color);
		$sql_data_array = array('image'=>$new_name_color);

		tep_db_perform(TABLE_BLOG,$sql_data_array, 'update', "id='" . $id . "'");


		tep_db_close();
	}

	function del($id) {
	 if (strlen( $this->info[0]["image"])>0){
		chmod("../../images/blog/". $this->info[0]["image"],0755);
		unlink("../../images/blog/". $this->info[0]["image"] ); //Eliminar Foto
	 }
		tep_db_connect();
		tep_db_perform(TABLE_BLOG,'', 'drop', "id='" . $id . "'");
		tep_db_close();
	}

	function del_i($id) {
		tep_db_connect();
		//Eliminar imagenes
		$this->info = searchList("id='" . $id . "'",NULL,0,NULL,"*", TABLE_BLOG);
		if (strlen($this->info[0]["image"])>0){
			chmod(IMAGENES."blog/thumb/".$this->info[0]["image"], 0777);
			unlink(IMAGENES."blog/thumb/". $this->info[0]["image"] ); //Eliminar Foto
		}

		$sql_data_array = array('image'=>'');
		tep_db_perform(TABLE_BLOG, $sql_data_array, 'update', "id='".$id."'");
		tep_db_close();
	}

	function act($id){

		tep_db_connect();
		$this->info = searchList("id='" . $id . "'",NULL,0,NULL,"*", TABLE_BLOG);
		if ($this->info[0]["activado"]==0){
			$sql_data_array = array('activado'=>1);
		} else {
			$sql_data_array = array('activado'=>0);
		}
		tep_db_perform(TABLE_BLOG, $sql_data_array, 'update', "id='$id'");
		tep_db_close();
	}

	function uploadFile($filename,$extension,$filesize,$tmp,$path){
		if (!((strpos($filename, "gif") || strpos($filename, "jpg") || strpos($filename, "png")) )) {
				return false;
		}else{
    		if (move_uploaded_file($tmp, IMAGENES."blog/" . $filename)){
       			return true;
    		}else{
       			return false;
    		}
		}
	}

}//fin class
?>
