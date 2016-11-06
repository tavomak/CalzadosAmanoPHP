<?php

class categoria
{
	function categoria() {
		$this->info=array();
			}

	function load($id){
		tep_db_connect();
		$this->info = searchList("id='" . $id . "'",NULL,0,NULL,"*", TABLE_CATEGORIA);
		tep_db_close();
	}


	function mod($id,$nombre,$im1,$im2,$posicion,$preview,$activated){
		tep_db_connect();
		$sql_data_array = array('nombre'=>$nombre,
								'posicion'=>$posicion,
								'preview'=>$preview,
								'activado'=>($activated=='1')?$activated:'0');
		tep_db_perform(TABLE_CATEGORIA, $sql_data_array, 'update', "id='$id'");

		if (strlen($im1)>0){
			if (strlen($this->info[0]['image_off'])>0){
				chmod(IMAGENES."categoria/".$this->info[0]["image_off"], 0755);
				unlink(IMAGENES."categoria/". $this->info[0]["image_off"] );
			}
			$new_name_im=$this->info[0]["id"]."_off".substr($im1, -4);
			chmod(IMAGENES."categoria/".$im1, 0755);
			rename(IMAGENES."categoria/".$im1, "../../images/categoria/".$new_name_im);
			$sql_data_array = array('image_off'=>$new_name_im);
			tep_db_perform(TABLE_CATEGORIA, $sql_data_array, 'update', "id='$id'");
		}

		if (strlen($im2)>0){
			if (strlen($this->info[0]['image_on'])>0){
				chmod(IMAGENES."categoria/".$this->info[0]["image_on"], 0755);
				unlink(IMAGENES."categoria/". $this->info[0]["image_on"] );
			}
			$new_name_im=$this->info[0]["id"]."_on".substr($im2, -4);
			chmod(IMAGENES."categoria/".$im2, 0755);
			rename(IMAGENES."categoria/".$im2, "../../images/categoria/".$new_name_im);
			$sql_data_array = array('image_on'=>$new_name_im);
			tep_db_perform(TABLE_CATEGORIA, $sql_data_array, 'update', "id='$id'");
		}
		tep_db_close();
	}

	function add($nombre,$im1,$im2,$posicion,$preview,$activated){

		tep_db_connect();
		//Agregando en la tabla de aliado
		$sql_data_array = array('nombre'=>$nombre,
								'posicion'=>$posicion,
								'preview'=>$preview,
								'activado'=>($activated=='1')?$activated:'0');
		tep_db_perform(TABLE_CATEGORIA, $sql_data_array);

		$ultimate_product=tep_db_query("SELECT MAX(id) FROM " . TABLE_CATEGORIA);
		$row=tep_db_fetch_row($ultimate_product);

		$new_name_im="";

		if (strlen($im1)>0){

			$new_name_im=$row[0]."_off".substr($im1, -4);
			chmod(IMAGENES."categoria/".$im1, 0755);
			rename(IMAGENES."categoria/".$im1, IMAGENES."categoria/".$new_name_im);
			$sql_data_array = array('image_off'=>$new_name_im);
			tep_db_perform(TABLE_CATEGORIA, $sql_data_array, 'update', "id='".$row[0]."'");
		}
		if (strlen($im2)>0){

			$new_name_im=$row[0]."_on".substr($im2, -4);
			chmod(IMAGENES."categoria/".$im2, 0755);
			rename(IMAGENES."categoria/".$im2, IMAGENES."categoria/".$new_name_im);
			$sql_data_array = array('image_on'=>$new_name_im);
			tep_db_perform(TABLE_CATEGORIA, $sql_data_array, 'update', "id='".$row[0]."'");
		}

		tep_db_close();

	}

	function del($id) {
		tep_db_connect();
		//Eliminar imagenes
		$this->info = searchList("id='" . $id . "'",NULL,0,NULL,"*", TABLE_CATEGORIA);
		if (strlen($this->info[0]["image_on"])>0){
			chmod(IMAGENES."categoria/".$this->info[0]["image_on"], 0777);
			unlink(IMAGENES."categoria/". $this->info[0]["image_on"] ); //Eliminar Foto
		}
		if (strlen($this->info[0]["image_off"])>0){
			chmod(IMAGENES."categoria/".$this->info[0]["image_off"], 0777);
			unlink(IMAGENES."categoria/". $this->info[0]["image_off"] ); //Eliminar Foto
		}
		tep_db_perform(TABLE_CATEGORIA,'', 'drop', "id='$id'");

		tep_db_close();
	}


	function act($id){

		tep_db_connect();
		$this->info = searchList("id='" . $id . "'",NULL,0,NULL,"*", TABLE_CATEGORIA);
		if ($this->info[0]["activado"]==0){
			$sql_data_array = array('activado'=>1);
		} else {
			$sql_data_array = array('activado'=>0);
		}
		tep_db_perform(TABLE_CATEGORIA, $sql_data_array, 'update', "id='$id'");
		tep_db_close();
	}


	function uploadFile($filename,$extension,$filesize,$tmp,$path){
		if (!((strpos($filename, "gif") || strpos($filename, "jpg") || strpos($filename, "png") || strpos($filename, "flv")) )) {
				return false;
		}else{
    		if (move_uploaded_file($tmp, IMAGENES."categoria/" . $filename)){
       			return true;
    		}else{
       			return false;
    		}
		}
	}

}

?>
