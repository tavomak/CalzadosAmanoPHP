<?php

class pedidos
{
	function pedidos() {
		$this->info=array();
		$this->items=array();
		$this->infoPedidos =array();
			}

	function load($id){
		tep_db_connect();
		$this->info = searchList("id='" . $id . "'","",0,NULL,"*", TABLE_PEDIDO);
		$this->items = searchList("id_pedido='" . $id . "'","",0,NULL,"*", TABLE_ITEMS);
		tep_db_close();
	}

	function loadPedidoUsuario($id,$usuario){
		tep_db_connect();
		$this->info = searchList("id='" . $id . "' and id_usuario='".$usuario."'","",0,NULL,"*", TABLE_PEDIDO);
		tep_db_close();
	}

	function pedidoUsuarioActivo($id,$usuario){
		tep_db_connect();
		$this->info = searchList("id='" . $id . "' and id_usuario='".$usuario."' and DATEDIFF(CURDATE(),DATE(fecha))<1","",0,NULL,"*", TABLE_PEDIDO);
		tep_db_close();
	}

	function loadPedidoOffline(){
		tep_db_connect();
		$this->info = searchList("fecha>='2015-14-12 00:00:00 and DATEDIFF(CURDATE(),DATE(fecha))>=1' and estado='0'","",0,NULL,"*", TABLE_PEDIDO);
		tep_db_close();
	}

	function loadItems($id){
		tep_db_connect();
		$this->items = searchList("id_pedido='" . $id . "'","",0,NULL,"*", TABLE_ITEMS);
		tep_db_close();
	}

	function loadPedidos($usuario){
		tep_db_connect();
		$this->infoPedidos = searchList("id_usuario='" . $usuario . "' and activado='1'","",0,NULL,"*", TABLE_PEDIDO);
		tep_db_close();
	}

	function addProducto($id_pedido,$id_producto,$id_talla,$cantidad){
		tep_db_connect();
		$sql_data_array = array('id_pedido'=>$id_pedido,
								'id_producto'=>$id_producto,
								'talla'=>$id_talla,
								'cantidad'=>$cantidad,
								'estado'=>'0');
		tep_db_perform(TABLE_ITEMS, $sql_data_array);
		tep_db_close();
	}



	function addPedido($usuario,$tot_zapato,$tot_envio){

		tep_db_connect();
		//Agregando en la tabla de aliado
		$sql_data_array = array('id_usuario'=>$usuario,
								'tot_zapato'=>$tot_zapato,
								'tot_envio'=>$tot_envio,
								'activado'=>'1',
								'estado'=>'0');
		tep_db_perform(TABLE_PEDIDO, $sql_data_array);

		$ultimate_product=tep_db_query("SELECT MAX(id) FROM " . TABLE_PEDIDO . " WHERE id_usuario='".$usuario."'");
		$row=tep_db_fetch_row($ultimate_product);

		tep_db_close();
		return $row[0];
	}


	function del($id) {
		tep_db_connect();
		tep_db_perform(TABLE_PEDIDO,'', 'drop', "id='$id'");
		tep_db_perform(TABLE_ITEMS,'', 'drop', "id_pedido='$id'");
		tep_db_close();
	}

	function anu($id) {

		$cargado=$this->loadItems($id);
		tep_db_connect();
		for ($i=0;$i<count($this->items); $i++){
			$parasumar=searchList("id_producto='" . $this->items[$i]['id_producto'] . "' and id_talla='".$this->items[$i]['talla']."'",NULL,0,NULL,"*", TABLE_PRODTALLA);
			$inventario=$parasumar[0]['cantidad']+ $this->items[$i]['cantidad'];
			$sql_data_array = array('cantidad'=>$inventario);
			tep_db_perform(TABLE_PRODTALLA, $sql_data_array, 'update', "id='".$parasumar[0]['id']."'");
		}
		tep_db_close();
		$this->cambiarEstado($id,'2');
		$this->cambiarEstadoItems($id,'2');

	}


	function act($id){

		tep_db_connect();
		$this->info = searchList("id='" . $id . "'",NULL,0,NULL,"*", TABLE_PEDIDO);
		if ($this->info[0]["activado"]==0){
			$sql_data_array = array('activado'=>1);
		} else {
			$sql_data_array = array('activado'=>0);
		}
		tep_db_perform(TABLE_PEDIDO, $sql_data_array, 'update', "id='$id'");
		tep_db_close();
	}

	function cambiarEstado($id,$estado){
		tep_db_connect();
		$sql_data_array = array('estado'=>$estado);
		tep_db_perform(TABLE_PEDIDO, $sql_data_array, 'update', "id='$id'");
		tep_db_close();
	}
	function cambiarEstadoItems($id,$estado){
		tep_db_connect();
		$sql_data_array = array('estado'=>$estado);
		tep_db_perform(TABLE_ITEMS, $sql_data_array, 'update', "id='$id'");
		tep_db_close();
	}

}

?>
