<?php
class usuario
{
	function usuario() {
		$this->info=array();
	}


	function load_usuario($usuario){
		tep_db_connect();
		$this->info = searchList("usuario='" . $usuario . "'",NULL,0,NULL,"*", TABLE_USUARIO);
		tep_db_close();
	}

	function loadFromCorreo($correo){
		tep_db_connect();
		$this->info = searchList("correo='" . $correo . "'",NULL,0,NULL,"*", TABLE_USUARIO);
		tep_db_close();
	}

	function mod_clave($usuario,$contrasena){
		tep_db_connect();
		$clave=md5($contrasena);
		$sql_data_array =  array('clave'=>$clave);
		tep_db_perform(TABLE_USUARIO, $sql_data_array, 'update', "usuario='" . $usuario . "'");
		tep_db_close();
	}


	function add($usuario,$nombre,$birth,$sexo,$empleado,$profesion="",$ciudad="",$telefono="",$correo,$clave,$cedula='0',$logface=0){
		//1-Administrador, 2-Banners, 3-Menu, 4-Contenido
		tep_db_connect();
		$clave=md5($clave);
		$sql_data_array =  array('birth'=>$birth,
			'usuario'=>$usuario,
			'nombre'=>$nombre,
			'cedula'=>$cedula,
			'telefono'=>$telefono,
			'correo'=>$correo,
			'ciudad'=>$ciudad,
			'empleado'=>$empleado,
  			'clave'=>$clave,
  			'profesion'=>$profesion,
			'sexo'=>$sexo,
			'logface'=>$logface);
		tep_db_perform(TABLE_USUARIO, $sql_data_array);

		tep_db_close();
	}



	function mod($usuario,$nombre,$birth,$sexo,$empleado,$profesion,$ciudad,$telefono,$correo){

		tep_db_connect();
		$sql_data_array =  array('birth'=>$birth,
			'nombre'=>$nombre,
			'telefono'=>$telefono,
			'correo'=>$correo,
			'ciudad'=>$ciudad,
			'empleado'=>$empleado,
  			'profesion'=>$profesion,
			'sexo'=>$sexo);
		tep_db_perform(TABLE_USUARIO, $sql_data_array, 'update', "usuario='" . $usuario . "'");
		tep_db_close();
	}

	function del($usuario){
		tep_db_connect();
		tep_db_perform(TABLE_USUARIO, $sql_data_array, 'drop', "usuario='" . $usuario . "'");
		tep_db_close();
	}

	function infoUser($usuario){
		tep_db_connect();
		$this->info = searchList("id='" . $usuario . "'",NULL,0,NULL,"*", TABLE_USUARIO);
		tep_db_close();
	}


}//fin class
?>
