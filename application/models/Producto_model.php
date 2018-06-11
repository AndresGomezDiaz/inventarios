<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Producto_model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('uuidV4_helper');
	}

	public function getProductos($filtro = NULL){
    $sql = "SELECT a.*, b.nombre AS familia
            FROM producto a INNER JOIN familia b ON a.familia_id = b.id ";
    if(count($filtro) > 0){
      $contador = 0;
      foreach($filtro as $key => $value):
        if($contador === 0){
          $sql .= " WHERE ".$key." = '".$value."'"; 
        }else{
          $sql .= " AND ".$key." = '".$value."'";
        }
      endforeach;
    }		
		$result = $this->db->query($sql);
    return $result;
	}

	public function getProducto($id = NULL){
		$data = array("_uuid"=>$id);
		$query = $this->getProductos($data);
		return $query->row(0);
	}

	public function createProducto($data = NULL){
		if(isset($data)){
			$data['_uuid'] = uuidv4();
			$this->db->insert('producto', $data);
			return array('error' => false, "mensaje" => "El producto se registró correctamente", "registro" => $this->db->insert_id());
		}else{
			return array('error' => true, "mensaje" => "Error al registrar el producto, faltan datos.");
		}
	}

	public function updateProducto($id = NULL, $data = NULL){
		if(isset($id)){
			$this->db->where('_uuid',$id);
			$this->db->update('producto',$data);
			return array('error' => false, "mensaje" => "El producto se edito correctamente");
		}else{
			return array('error' => true, "mensaje" => "Error al registrar el producto, faltan datos");
		}
	}

	public function deleteProducto($id = NULL){
		if(isset($id)){
			$this->db->where('_uuid', $id);
			$this->db->delete('producto');
			return array('error' => false, "mensaje" => "El producto se eliminó correctamente");
		}else{
			return array('error' => true, "mensaje" => "Error al borrar el producto, faltan registro");
		}
	}
}