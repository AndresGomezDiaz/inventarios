<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Producto_model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}

	private function uuidv4(){
		return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
						// 32 bits for "time_low"
						mt_rand(0, 0xffff), mt_rand(0, 0xffff),
						// 16 bits for "time_mid"
						mt_rand(0, 0xffff),
						// 16 bits for "time_hi_and_version",
						// four most significant bits holds version number 4
						mt_rand(0, 0x0fff) | 0x4000,
						// 16 bits, 8 bits for "clk_seq_hi_res",
						// 8 bits for "clk_seq_low",
						// two most significant bits holds zero and one for variant DCE1.1
						mt_rand(0, 0x3fff) | 0x8000,
						// 48 bits for "node"
						mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
						);
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
			$data['_uuid'] = $this->uuidv4();
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