<?php
define('WITHOUT_CONEXION', 'Imposible Conectar al Servidor de Bases de Datos');

  function tep_db_connect($server = DB_SERVER, $username = DB_SERVER_USERNAME, $password = DB_SERVER_PASSWORD, $database = DB_DATABASE, $link = 'db_link') {
    global $$link;

    if (USE_PCONNECT == 'true') {
      $$link = mysql_pconnect($server, $username, $password);
    } else {
      $$link = mysql_connect($server, $username, $password);
    }

    if ($$link) mysql_select_db($database);

    return $$link;
  }

  function tep_db_close($link = 'db_link') {
    global $$link;

    return mysql_close($$link);
  }

    function tep_db_input($string, $link = 'db_link') {
    global $$link;

    if (function_exists('mysql_real_escape_string')) {
      return mysql_real_escape_string($string, $$link);
    } elseif (function_exists('mysql_escape_string')) {
      return mysql_escape_string($string);
    }

    return addslashes($string);
  }

  function tep_db_error($query, $errno, $error) {
    die('<font color="#000000"><b>' . $errno . ' - ' . $error . '<br><br>' . $query . '<br><br><small><font color="#ff0000">[STOP]</font></small><br><br></b></font>');
  }

  function tep_db_query($query, $link = 'db_link') {
    global $$link;

    $result = mysql_query($query, $$link) or tep_db_error($query, mysql_errno(), mysql_error());

    return $result;
  }

  function tep_db_perform($table, $data, $action = 'insert', $parameters = '', $link = 'db_link') {
    if ($action=='drop') {
	} else {
   		reset($data);
	}
    if ($action == 'insert') {
      $query = 'insert into ' . $table . ' (';

      while (list($columns, ) = each($data)) {
        $query .= $columns . ', ';
      }
	  $query = substr($query, 0, -2) . ') values (';

      reset($data);
      while (list(, $value) = each($data)) {
        switch ((string)$value) {
          case 'now()':
            $query .= 'now(), ';

            break;
          case 'null':
            $query .= 'null, ';
            break;
          default:
            $query .= '\'' . tep_db_input($value) . '\', ';
            break;
        }
      }

      $query = substr($query, 0, -2) . ')';

    } elseif ($action == 'update') {
      $query = 'update ' . $table . ' set ';
      while (list($columns, $value) = each($data)) {
        switch ((string)$value) {
          case 'now()':
            $query .= $columns . ' = now(), ';
            break;
          case 'null':
            $query .= $columns .= ' = null, ';
            break;
          default:
            $query .= $columns . ' = \'' . tep_db_input($value) . '\', ';
            break;
        }
      }
      $query = substr($query, 0, -2) . ' where ' . $parameters;

    } elseif ($action == 'drop') {
		$query = 'delete from ' . $table . ' where ' . $parameters;

	}

    return tep_db_query($query, $link);
  }

 function tep_db_num_rows($record){
	 $numRows=mysql_num_rows($record);
	 return $numRows;
  }

  function tep_db_fetch_assoc($record){
	 $rows=mysql_fetch_assoc($record);
	 return $rows;
  }

     function tep_db_fetch_row($record){
	 $rows=mysql_fetch_row($record);
	 return $rows;
  }

  function searchList($criteria = NULL,$order = NULL,$ini = 0,$end = NULL,$show="*", $table,$all=0){
			/*
			parametros:
			$criteria = un arreglo de criterio(condiciones) de busqueda, en caso de ser NULL lista todos
			$order = el orden del listado y si es ascendente o descendente
			$ini = el inicio del listado
			$end = el fin del lsitado
			$show = campos que se quieren mostrar. si hay claves foraneas de otras tablas se carga la informacion de las otras tablas de forma automatica.
			$all= indica el tipo de objeto que se quiere. (con descripcion basica 0, descripcion completa)
			funcionamiento: retorna un arreglo de object_mysql
			*/

			$query = "SELECT ".$show." FROM $table WHERE (1=1) ";

			// Construye el WHERE
			if(($criteria!=NULL && count($criteria)>0)){
				$query .= " AND ". $criteria;
			}

			// Construye el ORDER BY
			if($order!=NULL){
				$query .= " ORDER BY ".$order;
			}

			// Construye el LIMIT XX,XX
			if($ini!=0 && $end != NULL){
				$query.=" LIMIT ".$ini.",".$end;
			}else if($end!=NULL && $ini==0){
				$query.=" LIMIT ".$end;
			}

			//echo $query." <br><br>";  //<-------------------------------------------
			$record = tep_db_query($query);

			if(($end == NULL)||($end > tep_db_num_rows($record))){
				$end = tep_db_num_rows($record);
			}
			$result=array();
			for($i=0;$i<$end;$i++){
				$result[$i] = tep_db_fetch_assoc($record);
			}
			return $result;
		}

function searchDistinct($criteria = NULL,$order = NULL,$ini = 0,$end = NULL,$show="*", $table,$all=0){
			/*
			parametros:
			$criteria = un arreglo de criterio(condiciones) de busqueda, en caso de ser NULL lista todos
			$order = el orden del listado y si es ascendente o descendente
			$ini = el inicio del listado
			$end = el fin del lsitado
			$show = campos que se quieren mostrar. si hay claves foraneas de otras tablas se carga la informacion de las otras tablas de forma automatica.
			$all= indica el tipo de objeto que se quiere. (con descripcion basica 0, descripcion completa)
			funcionamiento: retorna un arreglo de object_mysql
			*/

			$query = "SELECT DISTINCT ".$show." FROM $table WHERE (1=1) ";

			// Construye el WHERE
			if(($criteria!=NULL && count($criteria)>0)){
				$query .= " AND ". $criteria;
			}

			// Construye el ORDER BY
			if($order!=NULL){
				$query .= " ORDER BY ".$order;
			}

			// Construye el LIMIT XX,XX
			if($ini!=0 && $end != NULL){
				$query.=" LIMIT ".$ini.",".$end;
			}else if($end!=NULL && $ini==0){
				$query.=" LIMIT ".$end;
			}

			//echo $query." <br><br>";  //<-------------------------------------------
			$record = tep_db_query($query);

			if(($end == NULL)||($end > tep_db_num_rows($record))){
				$end = tep_db_num_rows($record);
			}
			$result=array();
			for($i=0;$i<$end;$i++){
				$result[$i] = tep_db_fetch_assoc($record);
			}
			return $result;
		}

?>
