<?php

class galeria
{
	function galeria() {
		$this->info=array();
			}

	function load($id){
		tep_db_connect();
		$this->info = searchList("id='" . $id . "'",NULL,0,NULL,"*", TABLE_GALERIA);
		tep_db_close();
	}


	function mod($id,$categoria,$nombre,$im1,$posicion,$preview,$activated,$enlace){
		tep_db_connect();
		$sql_data_array = array('categoria'=>$categoria,
								'nombre'=>$nombre,
								'enlace'=>$enlace,
								'posicion'=>$posicion,
								'preview'=>$preview,
								'activado'=>($activated=='1')?$activated:'0');
		tep_db_perform(TABLE_GALERIA, $sql_data_array, 'update', "id='$id'");

		if (strlen($im1)>0){
			if (strlen($this->info[0]['banner_image'])>0){
				chmod(IMAGENES."banner/".$this->info[0]["banner_image"], 0755);
				unlink(IMAGENES."banner/". $this->info[0]["banner_image"] );
			}
			$new_name_im=$this->info[0]["id"].substr($im1, -4);
			chmod(IMAGENES."banner/".$im1, 0755);
			rename(IMAGENES."banner/".$im1, "../../images/banner/".$new_name_im);
			$sql_data_array = array('banner_image'=>$new_name_im);
			tep_db_perform(TABLE_GALERIA, $sql_data_array, 'update', "id='$id'");
		}

		tep_db_close();
	}

	function add($categoria,$nombre,$im1,$posicion,$preview,$activated,$enlace){

		tep_db_connect();
		//Agregando en la tabla de aliado
		$sql_data_array = array('categoria'=>$categoria,
								'nombre'=>$nombre,
								'enlace'=>$enlace,
								'posicion'=>$posicion,
								'preview'=>$preview,
								'activado'=>($activated=='1')?$activated:'0');
		tep_db_perform(TABLE_GALERIA, $sql_data_array);

		$ultimate_product=tep_db_query("SELECT MAX(id) FROM " . TABLE_GALERIA);
		$row=tep_db_fetch_row($ultimate_product);

		$new_name_im="";

		if (strlen($im1)>0){

			$new_name_im=$row[0].substr($im1, -4);
			chmod(IMAGENES."banner/".$im1, 0755);
			rename(IMAGENES."banner/".$im1, IMAGENES."banner/".$new_name_im);
			$sql_data_array = array('banner_image'=>$new_name_im);
			tep_db_perform(TABLE_GALERIA, $sql_data_array, 'update', "id='".$row[0]."'");
		}


		tep_db_close();

	}

	function del($id) {
		tep_db_connect();
		//Eliminar imagenes
		$this->info = searchList("id='" . $id . "'",NULL,0,NULL,"*", TABLE_GALERIA);
		if (strlen($this->info[0]["banner_image"])>0){
			chmod(IMAGENES."banner/".$this->info[0]["banner_image"], 0777);
			unlink(IMAGENES."banner/". $this->info[0]["banner_image"] ); //Eliminar Foto
		}

		tep_db_perform(TABLE_GALERIA,'', 'drop', "id='$id'");

		tep_db_close();
	}


	function act($id){

		tep_db_connect();
		$this->info = searchList("id='" . $id . "'",NULL,0,NULL,"*", TABLE_GALERIA);
		if ($this->info[0]["activado"]==0){
			$sql_data_array = array('activado'=>1);
		} else {
			$sql_data_array = array('activado'=>0);
		}
		tep_db_perform(TABLE_GALERIA, $sql_data_array, 'update', "id='$id'");
		tep_db_close();
	}


	function uploadFile($filename,$extension,$filesize,$tmp,$path){
		if (!((strpos($filename, "gif") || strpos($filename, "jpg") || strpos($filename, "png") || strpos($filename, "flv")) )) {
				return false;
		}else{
    		if (move_uploaded_file($tmp, IMAGENES."banner/" . $filename)){
       			return true;
    		}else{
       			return false;
    		}
		}
	}

}

?>
