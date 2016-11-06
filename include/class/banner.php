<?php
class banner
{
	function banner() {		$this->info=array();			}

	function load($id){
		tep_db_connect();
		$this->info = searchList("id='" . $id . "'",NULL,0,NULL,"*", TABLE_BANNER);
		tep_db_close();
	}

	function loadbanner(){
		tep_db_connect();
		$this->info = searchList("activado='1'",NULL,0,NULL,"*", TABLE_BANNER);
		tep_db_close();
	}


	function mod($id,$titulo,$im2,$enlace,$posicion,$activado){
		tep_db_connect();
		$sql_data_array = array('titulo'=>$titulo,
								'enlace'=>$enlace,
								'posicion'=>$posicion,
								'activado'=>($activado=='1')?$activado:'0');
		tep_db_perform(TABLE_BANNER, $sql_data_array, 'update', "id='$id'");

		$this->load($id);

		tep_db_connect();

		if (strlen($im2)>0){
			if (strlen($this->info[0]['imagen'])>0){
				chmod(IMAGENES."banner/".$this->info[0]["imagen"], 0755);
				unlink(IMAGENES."banner/". $this->info[0]["imagen"] );
			}
			$new_name_im=$this->info[0]["id"].substr($im2, -4);
			chmod(IMAGENES."banner/".$im2, 0755);
			rename(IMAGENES."banner/".$im2, IMAGENES."banner/".$new_name_im);
			$sql_data_array = array('imagen'=>$new_name_im);
			tep_db_perform(TABLE_BANNER, $sql_data_array, 'update', "id='$id'");
		}

		tep_db_close();
	}

	function add($titulo,$im2,$enlace,$posicion,$activado){
		tep_db_connect();
		$sql_data_array = array('titulo'=>$titulo,
								'enlace'=>$enlace,
								'posicion'=>$posicion,
								'activado'=>($activado=='1')?$activado:'0');
		tep_db_perform(TABLE_BANNER, $sql_data_array);

		$ultimate_product=tep_db_query("SELECT MAX(id) FROM " . TABLE_BANNER);
		$row=tep_db_fetch_row($ultimate_product);

		$new_name_im="";

		if (strlen($im2)>0){

			$new_name_im=$row[0].substr($im2, -4);
			chmod(IMAGENES."banner/".$im2, 0755);
			rename(IMAGENES."banner/".$im2, IMAGENES."banner/".$new_name_im);
			$sql_data_array = array('imagen'=>$new_name_im);
			tep_db_perform(TABLE_BANNER, $sql_data_array, 'update', "id='".$row[0]."'");
		}

		tep_db_close();
	}

	function del($id) {

		tep_db_connect();
		$this->info = searchList("id='" . $id . "'",NULL,0,NULL,"*", TABLE_BANNER);

		if (strlen($this->info[0]["imagen"])>0){
			chmod(IMAGENES."banner/".$this->info[0]["imagen"], 0777);
			unlink(IMAGENES."banner/". $this->info[0]["imagen"] ); //Eliminar Foto
		}

		tep_db_perform(TABLE_BANNER,'', 'drop', "id='$id'");
		tep_db_close();
	}


	function delt($id) {

		tep_db_connect();
		$this->info = searchList("id='" . $id . "'",NULL,0,NULL,"*", TABLE_BANNER);

		if (strlen($this->info[0]["imagen"])>0){
			chmod(IMAGENES."banner/".$this->info[0]["imagen"], 0777);
			unlink(IMAGENES."banner/". $this->info[0]["imagen"] ); //Eliminar Foto
		}
		$sql_data_array = array('imagen'=>'');
		tep_db_perform(TABLE_BANNER,$sql_data_array, 'update',"id='$id'");
		tep_db_close();
	}

	function act($id){

		tep_db_connect();
		$this->info = searchList("id='" . $id . "'",NULL,0,NULL,"*", TABLE_BANNER);
		if ($this->info[0]["activado"]==0){
			$sql_data_array = array('activado'=>1);
		} else {
			$sql_data_array = array('activado'=>0);
		}
		tep_db_perform(TABLE_BANNER, $sql_data_array, 'update', "id='$id'");
		tep_db_close();
	}

	function uploadFile($filename,$extension,$filesize,$tmp,$path){
		if (!((strpos($filename, "gif") || strpos($filename, "jpg") || strpos($filename, "png") ) )) {
				return false;
		}else{
    		if (move_uploaded_file($tmp, IMAGENES."banner/". $filename)){
       			return true;
    		}else{
       			return false;
    		}
		}
	}

}

?>
