<?php

class producto
{
	function producto() {
		$this->info=array();
		$this->infoTalla=array();
		$this->infoColorTalla=array();
		$this->infoTallaDistinct=array();
		$this->next =array();
		$this->prev =array();
		$this->catalogo=array();
			}

	function load($id){
		tep_db_connect();
		$this->info = searchList("id='" . $id . "'","posicion",0,NULL,"*", TABLE_PRODUCTO);
		tep_db_close();
	}

	function loadNext($id,$categoria){
		tep_db_connect();
		$this->next = searchList("posicion>'" . $id . "' and categoria='".$categoria."' and activado='1'","posicion",0,NULL,"*", TABLE_PRODUCTO);
		tep_db_close();
	}

	function loadPrev($id,$categoria){
		tep_db_connect();
		$this->prev = searchList("posicion<'" . $id . "' and categoria='".$categoria."' and activado='1'","posicion DESC",0,NULL,"*", TABLE_PRODUCTO);
		tep_db_close();
	}
	function loadCategoria($id) {
		tep_db_connect();
		$this->info = searchList("categoria='" . $id . "' and activado='1'","posicion DESC",0,NULL,"*", TABLE_PRODUCTO);
		tep_db_close();
	}

	function loadZapatos() {
		tep_db_connect();
		$this->info = searchList("categoria IN ('1','2','3','4') and activado='1'","posicion DESC",0,NULL,"*", TABLE_PRODUCTO);
		tep_db_close();
	}

	function loadAccesorios($id) {
		tep_db_connect();
		$this->info = searchList("categoria='" . $id . "' and activado='1'","nombre",0,NULL,"*", TABLE_PRODUCTO);
		tep_db_close();
	}
	function loadTalla($id) {
		tep_db_connect();
		$query="SELECT t.name as nombre, t.id as id, p.cantidad as cantidad FROM ". TABLE_PRODTALLA . " as p, " . TABLE_TALLA ." as t WHERE p.id_producto='" . $id . "' and p.id_talla=t.id and p.activado='1' ORDER BY t.name" ;
		$record = tep_db_query($query);
		tep_db_close();
		$end = tep_db_num_rows($record);

		$result=array();
		for($i=0;$i<$end;$i++){
			$result[$i] = tep_db_fetch_assoc($record);
		}
		$this->infoTalla =$result;

	}

	function loadAllTalla($id) {
		tep_db_connect();
		$query="SELECT t.name as nombre, t.id as id, p.activado as activado, p.cantidad as cantidad, p.precio as precio FROM ". TABLE_PRODTALLA . " as p, " . TABLE_TALLA ." as t WHERE p.id_producto='" . $id . "' and p.id_talla=t.id ORDER BY t.name" ;
		$record = tep_db_query($query);
		tep_db_close();
		$end = tep_db_num_rows($record);

		$result=array();
		for($i=0;$i<$end;$i++){
			$result[$i] = tep_db_fetch_assoc($record);
		}
		$this->infoTalla =$result;

	}

	function loadTallaDistinct($id) {
		tep_db_connect();
		$query="SELECT DISTINCT t.name as nombre, t.id as id FROM ". TABLE_PRODTALLA . " as p, " . TABLE_TALLA ." as t WHERE p.id_producto='" . $id . "' and p.id_talla=t.id ORDER BY t.id" ;
		$record = tep_db_query($query);
		tep_db_close();
		$end = tep_db_num_rows($record);

		$result=array();
		for($i=0;$i<$end;$i++){
			$result[$i] = tep_db_fetch_assoc($record);
		}
		$this->infoTallaDistinct =$result;

	}

	function loadColorTalla($id,$talla) {
		tep_db_connect();
		$r=searchList("id='" . $id . "'",NULL,NULL,NULL,"*", TABLE_PRODUCTO);

		$query="SELECT  t.id as idTalla, p.id_color as id_color, c.nombre as nombrecolor, p.cantidad as cantidad, p.precio as precio, p.dimensiones as dimensiones, p.activado as activado FROM ". TABLE_PRODTALLA . " as p, " . TABLE_TALLA ." as t, ". TABLE_COLOR ." as c, ". TABLE_PRODUCTO ." as r WHERE r.nombre='".$r[0]['nombre']."' and r.categoria='".$r[0]['categoria']."'  and p.id_producto=r.id and p.id_talla=t.id and p.id_color=c.id and t.id='".$talla."' ORDER BY c.nombre" ;
		$record = tep_db_query($query);
		tep_db_close();
		$end = tep_db_num_rows($record);

		$result=array();
		for($i=0;$i<$end;$i++){
			$result[$i] = tep_db_fetch_assoc($record);
		}
		$this->infoColorTalla =$result;

	}

	function loadCT($id,$color) {
		tep_db_connect();
		$r=searchList("id='" . $id . "'",NULL,NULL,NULL,"*", TABLE_PRODUCTO);

		$query="SELECT  t.id as idTalla, t.name as nombre,  p.cantidad as cantidad, p.precio as precio, p.dimensiones as dimensiones, p.activado as activado FROM ". TABLE_PRODTALLA . " as p, " . TABLE_TALLA ." as t WHERE p.id_producto='".$id."' and p.id_talla=t.id and p.id_color='".$color."' and p.activado='1' ORDER BY t.id" ;
		$record = tep_db_query($query);
		tep_db_close();
		$end = tep_db_num_rows($record);

		$result=array();
		for($i=0;$i<$end;$i++){
			$result[$i] = tep_db_fetch_assoc($record);
		}
		$this->infoColorTalla =$result;

	}

	function loadColorDistinct($id) {
		tep_db_connect();
		$r=searchList("id='" . $id . "'",NULL,NULL,NULL,"*", TABLE_PRODUCTO);

		$query="SELECT DISTINCT p.id_color as id_color, c.nombre as nombre, p.id_producto as id FROM ". TABLE_PRODTALLA . " as p, ". TABLE_COLOR ." as c, ". TABLE_PRODUCTO ." as r WHERE r.nombre='".$r[0]['nombre']."' and r.categoria='".$r[0]['categoria']."'  and p.id_producto=r.id and  p.id_color=c.id  ORDER BY c.nombre" ;
		$record = tep_db_query($query);
		tep_db_close();
		$end = tep_db_num_rows($record);

		$result=array();
		for($i=0;$i<$end;$i++){
			$result[$i] = tep_db_fetch_assoc($record);
		}
		$this->infoColorTalla =$result;

	}

	function loadColorAcc($id){
		tep_db_connect();

		$query="SELECT DISTINCT p.id_color as id_color FROM ". TABLE_PRODTALLA . " as p  WHERE p.id_producto='" .$id ."'" ;
		$record = tep_db_query($query);
		tep_db_close();
		$end = tep_db_num_rows($record);

		$result=array();
		for($i=0;$i<$end;$i++){
			$result[$i] = tep_db_fetch_assoc($record);
		}
		return $result[0];

	}


	function loadColor($id,$nombre,$material,$cat) {
		tep_db_connect();
		$query="SELECT t.color as color, t.id as id FROM " . TABLE_PRODUCTO ." as t WHERE t.nombre='" . $nombre . "' and t.material='".$material."' and t.categoria='".$cat."' and t.activado='1' ORDER BY t.posicion" ;
		$record = tep_db_query($query);
		tep_db_close();
		$end = tep_db_num_rows($record);

		$result=array();
		for($i=0;$i<$end;$i++){
			$result[$i] = tep_db_fetch_assoc($record);
		}
		$this->infoColor =$result;

	}

	function loadTallaProd($id,$size) {
		tep_db_connect();
		$query="SELECT * FROM ". TABLE_PRODTALLA ." WHERE id_producto='" . $id . "' and id_talla='".$size."' and activado='1'" ;
		$record = tep_db_query($query);
		tep_db_close();
		$end = tep_db_num_rows($record);

		$result=array();
		for($i=0;$i<$end;$i++){
			$result[$i] = tep_db_fetch_assoc($record);
		}

		return $result;

	}

	function loadCatalogo($id){
		tep_db_connect();
		$this->catalogo = searchList("id_producto='" . $id . "' and activado='1' ","posicion",0,NULL,"*", TABLE_CATALOGO);
		tep_db_close();
	}

	function mod($id,$categoria,$nombre,$ibig,$ithumb,$suela,$material,$posicion,$preview,$activated,$zoom,$color,$precio,$nuevo,$descuento,$plantilla,$codigo=''){
		tep_db_connect();
		$sql_data_array = array('categoria'=>$categoria,
								'nombre'=>$nombre,
								'suela'=>$suela,
								'material'=>$material,
								'precio'=>$precio,
								'posicion'=>$posicion,
								'preview'=>$preview,
								'activado'=>($activated=='1')?$activated:'0',
								'nuevo'=>$nuevo,
								'descuento'=>$descuento,
								'plantilla'=>$plantilla,
								'codigo'=>$codigo);
		tep_db_perform(TABLE_PRODUCTO, $sql_data_array, 'update', "id='".$id."'");
		$this->load($id);
		tep_db_connect();
		if (strlen($ibig)>0){
			if (strlen($this->info[0]['ibig'])>0){
				chmod(IMAGENES."producto/big/".$this->info[0]["big"], 0755);
				unlink(IMAGENES."producto/big/". $this->info[0]["big"] );
			}
			$new_name_im=$this->info[0]["id"].substr($ibig, -4);
			chmod(IMAGENES."producto/big/".$ibig, 0755);
			rename(IMAGENES."producto/big/".$ibig, IMAGENES."producto/big/".$new_name_im);
			$sql_data_array = array('big'=>$new_name_im);
			tep_db_perform(TABLE_PRODUCTO, $sql_data_array, 'update', "id='". $id. "'");
		}

		if (strlen($ithumb)>0){
			if (strlen($this->info[0]['ithumb'])>0){
				chmod(IMAGENES."producto/thumb/".$this->info[0]["thumb"], 0755);
				unlink(IMAGENES."producto/thumb/". $this->info[0]["thumb"] );
			}
			$new_name_im=$this->info[0]["id"].substr($ithumb, -4);
			chmod(IMAGENES."producto/thumb/".$ithumb, 0755);
			rename(IMAGENES."producto/thumb/".$ithumb, IMAGENES."producto/thumb/".$new_name_im);
			$sql_data_array = array('thumb'=>$new_name_im);
			tep_db_perform(TABLE_PRODUCTO, $sql_data_array, 'update', "id='". $id. "'");
		}
			if (strlen($zoom)>0){
				if (strlen($this->info[0]['zoom'])>0){
				chmod(IMAGENES."producto/zoom/".$this->info[0]["zoom"], 0755);
				unlink(IMAGENES."producto/zoom/". $this->info[0]["zoom"] );
			}
			$new_name_im=$this->info[0]["id"].substr($zoom, -4);
			chmod(IMAGENES."producto/zoom/".$zoom, 0755);
			rename(IMAGENES."producto/zoom/".$zoom, IMAGENES."producto/zoom/".$new_name_im);
			$sql_data_array = array('zoom'=>$new_name_im);
			tep_db_perform(TABLE_PRODUCTO, $sql_data_array, 'update', "id='". $id. "'");
		}

		if (strlen($color)>0){
			if (strlen($this->info[0]['color'])>0){
				chmod(IMAGENES."producto/color/".$this->info[0]["color"], 0755);
				unlink(IMAGENES."producto/color/". $this->info[0]["color"] );
			}
			$new_name_im=$this->info[0]["id"].substr($color, -4);
			chmod(IMAGENES."producto/color/".$color, 0755);
			rename(IMAGENES."producto/color/".$color, IMAGENES."producto/color/".$new_name_im);
			$sql_data_array = array('color'=>$new_name_im);
			tep_db_perform(TABLE_PRODUCTO, $sql_data_array, 'update', "id='". $id. "'");
		}
		tep_db_close();

	}



	function addProducto(){

		tep_db_connect();
		//Agregando en la tabla de aliado
		$sql_data_array = array('nombre'=>'');
		tep_db_perform(TABLE_PRODUCTO, $sql_data_array);

		$ultimate_product=tep_db_query("SELECT MAX(id) FROM " . TABLE_PRODUCTO);
		$row=tep_db_fetch_row($ultimate_product);

		tep_db_close();
		return $row[0];
	}


	function del($id) {
		tep_db_connect();
		//Eliminar imagenes
		$this->info = searchList("id='" . $id . "'",NULL,0,NULL,"*", TABLE_PRODUCTO);
		if (strlen($this->info[0]["thumb"])>0){
					chmod(IMAGENES."producto/thumb/".$this->info[0]["thumb"], 0777);
					unlink(IMAGENES."producto/thumb/". $this->info[0]["thumb"] ); //Eliminar Foto
				}
		if (strlen($this->info[0]["big"])>0){
					chmod(IMAGENES."producto/big/".$this->info[0]["big"], 0777);
					unlink(IMAGENES."producto/big/". $this->info[0]["big"] ); //Eliminar Foto
				}
		if (strlen($this->info[0]["zoom"])>0){
					chmod(IMAGENES."producto/zoom/".$this->info[0]["zoom"], 0777);
					unlink(IMAGENES."producto/zoom/". $this->info[0]["zoom"] ); //Eliminar Foto
				}
		if (strlen($this->info[0]["color"])>0){
					chmod(IMAGENES."producto/color/".$this->info[0]["color"], 0777);
					unlink(IMAGENES."producto/color/". $this->info[0]["color"] ); //Eliminar Foto
				}
		tep_db_perform(TABLE_PRODUCTO,'', 'drop', "id='$id'");

		tep_db_close();
	}



	function del_t($id) {
		tep_db_connect();
		//Eliminar imagenes
		$this->info = searchList("id='" . $id . "'",NULL,0,NULL,"*", TABLE_PRODUCTO);
		if (strlen($this->info[0]["thumb"])>0){
			chmod(IMAGENES."producto/thumb/".$this->info[0]["thumb"], 0777);
			unlink(IMAGENES."producto/thumb/". $this->info[0]["thumb"] ); //Eliminar Foto
		}

		$sql_data_array = array('thumb'=>'');
		tep_db_perform(TABLE_PRODUCTO, $sql_data_array, 'update', "id='".$id."'");
		tep_db_close();
	}

	function del_b($id) {
		tep_db_connect();
		//Eliminar imagenes
		$this->info = searchList("id='" . $id . "'",NULL,0,NULL,"*", TABLE_PRODUCTO);

		if (strlen($this->info[0]["big"])>0){
			chmod(IMAGENES."producto/big/".$this->info[0]["big"], 0777);
			unlink(IMAGENES."producto/big/". $this->info[0]["big"] ); //Eliminar Foto
		}
		$sql_data_array = array('big'=>'');
		tep_db_perform(TABLE_PRODUCTO, $sql_data_array, 'update', "id='".$id."'");
		tep_db_close();
	}

	function del_z($id) {
		tep_db_connect();
		//Eliminar imagenes
		$this->info = searchList("id='" . $id . "'",NULL,0,NULL,"*", TABLE_PRODUCTO);

		if (strlen($this->info[0]["zoom"])>0){
			chmod(IMAGENES."producto/zoom/".$this->info[0]["zoom"], 0777);
			unlink(IMAGENES."producto/zoom/". $this->info[0]["zoom"] ); //Eliminar Foto
		}
		$sql_data_array = array('zoom'=>'');
		tep_db_perform(TABLE_PRODUCTO, $sql_data_array, 'update', "id='".$id."'");
		tep_db_close();
	}

	function del_c($id) {
		tep_db_connect();
		//Eliminar imagenes
		$this->info = searchList("id='" . $id . "'",NULL,0,NULL,"*", TABLE_PRODUCTO);

		if (strlen($this->info[0]["color"])>0){
			chmod(IMAGENES."producto/color/".$this->info[0]["color"], 0777);
			unlink(IMAGENES."producto/color/". $this->info[0]["color"] ); //Eliminar Foto
		}
		$sql_data_array = array('color'=>'');
		tep_db_perform(TABLE_PRODUCTO, $sql_data_array, 'update', "id='".$id."'");
		tep_db_close();
	}

	function act($id){

		tep_db_connect();
		$this->info = searchList("id='" . $id . "'",NULL,0,NULL,"*", TABLE_PRODUCTO);
		if ($this->info[0]["activado"]==0){
			$sql_data_array = array('activado'=>1);
		} else {
			$sql_data_array = array('activado'=>0);
		}
		tep_db_perform(TABLE_PRODUCTO, $sql_data_array, 'update', "id='$id'");
		tep_db_close();
	}


	function addcolor($id_producto,$id_color){
		tep_db_connect();
		$sql_data_array = array('id_producto'=>$id_producto,
								'id_color'=>$id_color);
		tep_db_perform(TABLE_PRODCOLOR, $sql_data_array);
		tep_db_close();
	}

	function modposi($id,$posicion,$precio){
		tep_db_connect();
		$sql_data_array = array('precio'=>$precio,
								'posicion'=>$posicion);
		tep_db_perform(TABLE_PRODCOLOR, $sql_data_array, 'update', "id='$id'");
		tep_db_close();
	}

	function actcolor($id){

		tep_db_connect();
		$this->info = searchList("id='" . $id . "'",NULL,0,NULL,"*", TABLE_PRODCOLOR);
		if ($this->info[0]["activado"]==0){
			$sql_data_array = array('activado'=>1);
		} else {
			$sql_data_array = array('activado'=>0);
		}
		tep_db_perform(TABLE_PRODCOLOR, $sql_data_array, 'update', "id='$id'");
		tep_db_close();
	}

	function del_color($id) {
		tep_db_connect();
		tep_db_perform(TABLE_PRODCOLOR,'', 'drop', "id='$id'");
		tep_db_close();
	}

	function addtalla($id_producto,$id_talla){
		tep_db_connect();
		for($i=0;$i<count($id_talla);$i++):
		   $latalla=searchList("id='" . $id_talla[$i] . "'",NULL,0,NULL,"*", TABLE_TALLA);
			$sql_data_array = array('id_producto'=>$id_producto,
								'id_talla'=>$id_talla[$i],
								'precio'=>$latalla[0]['precio'],
								'peso'=>$latalla[0]['peso'],
								'cantidad'=>'0',
								'activado'=>'1');
			tep_db_perform(TABLE_PRODTALLA, $sql_data_array);
		endfor;
		tep_db_close();
	}

	function modposit($id,$posicion,$precio,$cantidad,$peso,$color='0',$dimension=""){
		tep_db_connect();
		$sql_data_array = array('precio'=>$precio,
								'peso'=>$peso,
								'id_color'=>$color,
								'dimensiones'=>$dimension,
								'cantidad'=>$cantidad,
								'posicion'=>$posicion);
		tep_db_perform(TABLE_PRODTALLA, $sql_data_array, 'update', "id='$id'");
		tep_db_close();
	}

	function modCantidad($id,$cantidad){
		tep_db_connect();
		$sql_data_array = array('cantidad'=>$cantidad);
		tep_db_perform(TABLE_PRODTALLA, $sql_data_array, 'update', "id='$id'");
		tep_db_close();
	}

	function acttalla($id){

		tep_db_connect();
		$this->info = searchList("id='" . $id . "'",NULL,0,NULL,"*", TABLE_PRODTALLA);
		if ($this->info[0]["activado"]==0){
			$sql_data_array = array('activado'=>1);
		} else {
			$sql_data_array = array('activado'=>0);
		}
		tep_db_perform(TABLE_PRODTALLA, $sql_data_array, 'update', "id='$id'");
		tep_db_close();
	}

	function del_talla($id) {
		tep_db_connect();
		tep_db_perform(TABLE_PRODTALLA,'', 'drop', "id='$id'");
		tep_db_close();
	}

	function uploadFile($filename,$extension,$filesize,$tmp,$path){
		if (!((strpos($filename, "gif") || strpos($filename, "jpg") || strpos($filename, "png") || strpos($filename, "flv")) )) {
				return false;
		}else{
    		if (move_uploaded_file($tmp, IMAGENES. 'producto/'.$path .'/'. $filename)){
       			return true;
    		}else{
       			return false;
    		}
		}
	}

	 function addCatalogo($id_producto){

		tep_db_connect();
		//Agregando en la tabla de aliado
		$sql_data_array = array('id_producto'=>$id_producto);
		tep_db_perform(TABLE_CATALOGO, $sql_data_array);

		$ultimate_product=tep_db_query("SELECT MAX(id) FROM " . TABLE_CATALOGO);
		$row=tep_db_fetch_row($ultimate_product);

		tep_db_close();
		return $row[0];
	}

	function modc($id,$ibig,$ithumb,$posicion,$activated){
		tep_db_connect();
		$sql_data_array = array('posicion'=>$posicion,
								'activado'=>($activated=='1')?$activated:'0');
		tep_db_perform(TABLE_CATALOGO, $sql_data_array, 'update', "id='".$id."'");

		$this->info = searchList("id='" . $id . "'","posicion",0,NULL,"*", TABLE_CATALOGO);

		if (strlen($ibig)>0){
			if (strlen($this->info[0]['ibig'])>0){
				chmod(IMAGENES."producto/vistas/big/".$this->info[0]["ibig"], 0755);
				unlink(IMAGENES."producto/vistas/big/". $this->info[0]["ibig"] );
			}
			$new_name_im=$this->info[0]["id"].substr($ibig, -4);
			chmod(IMAGENES."producto/vistas/big/".$ibig, 0755);
			rename(IMAGENES."producto/vistas/big/".$ibig, IMAGENES."producto/vistas/big/".$new_name_im);
			$sql_data_array = array('big'=>$new_name_im);
			tep_db_perform(TABLE_CATALOGO, $sql_data_array, 'update', "id='". $id. "'");
		}

		if (strlen($ithumb)>0){
			if (strlen($this->info[0]['ithumb'])>0){
				chmod(IMAGENES."producto/vistas/thumb/".$this->info[0]["ithumb"], 0755);
				unlink(IMAGENES."producto/vistas/thumb/". $this->info[0]["ithumb"] );
			}
			$new_name_im=$this->info[0]["id"].substr($ithumb, -4);
			chmod(IMAGENES."producto/vistas/thumb/".$ithumb, 0755);
			rename(IMAGENES."producto/vistas/thumb/".$ithumb, IMAGENES."producto/vistas/thumb/".$new_name_im);
			$sql_data_array = array('thumb'=>$new_name_im);
			tep_db_perform(TABLE_CATALOGO, $sql_data_array, 'update', "id='". $id. "'");
		}


		tep_db_close();

	}

	function actc($id){

		tep_db_connect();
		$this->info = searchList("id='" . $id . "'",NULL,0,NULL,"*", TABLE_CATALOGO);
		if ($this->info[0]["activado"]==0){
			$sql_data_array = array('activado'=>1);
		} else {
			$sql_data_array = array('activado'=>0);
		}
		tep_db_perform(TABLE_CATALOGO, $sql_data_array, 'update', "id='$id'");
		tep_db_close();
	}

	function del_ic($id) {
		tep_db_connect();
		$this->cata= searchList("id='" . $id . "'",NULL,0,NULL,"*", TABLE_CATALOGO);

		if (strlen($this->cata[0]["thumb"])>0){
			chmod(IMAGENES."producto/vistas/thumb/".$this->cata[0]["thumb"], 0777);
			unlink(IMAGENES."producto/vistas/thumb/". $this->cata[0]["thumb"] ); //Eliminar Foto
		}
		if (strlen($this->cata[0]["big"])>0){
			chmod(IMAGENES."producto/vistas/big/".$this->cata[0]["big"], 0777);
			unlink(IMAGENES."producto/vistas/big/". $this->cata[0]["big"] ); //Eliminar Foto

		}

		tep_db_perform(TABLE_CATALOGO,'', 'drop', "id='$id'");

		tep_db_close();
	}

	function actualizaPrecio($categoria,$talla,$precio){
		$this->loadCategoria($categoria);

		tep_db_connect();
		for ($i=0; $i<count($this->info);$i++) {
			if ($this->info[$i]['activado']==0) continue;
			$id=$this->info[$i]['id'];
			$sql_data_array = array('precio'=>$precio);
			tep_db_perform(TABLE_PRODTALLA, $sql_data_array, 'update', "id_producto='".$id."' and id_talla='".$talla."'");
		}

		tep_db_close();
	}

		function modestado($id,$nuevo,$descuento,$plantilla){
		tep_db_connect();
		$sql_data_array = array('nuevo'=>$nuevo,
								'descuento'=>$descuento,
								'plantilla'=>$plantilla);
		tep_db_perform(TABLE_PRODUCTO, $sql_data_array, 'update', "id='".$id."'");
		tep_db_close();
	}

}

?>
