<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Familia_model extends CI_Model {
	
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

	public function getFamilias($filtro = NULL){
		if(isset($filtro)){
			$this->db->where($filtro);
		}
		$query = $this->db->get('familia');
		return $query;
	}

	public function getFamilia($id = NULL){
		$data = array("_uuid "=>$id);
		$query = $this->getFamilias($data);
		return $query->row(0);
	}

	public function createFamilia($data = NULL){
		if(isset($data)){
			$data['_uuid'] = $this->uuidv4();
			$this->db->insert('familia', $data);
			return array('error' => false, "mensaje" => "La familia se registró correctamente", "registro" => $this->db->insert_id());
		}else{
			return array('error' => true, "mensaje" => "Error al registrar la familia, faltan datos.");
		}
	}

	public function updateFamilia($id = NULL, $data = NULL){
		if(isset($id)){
			$this->db->where('_uuid',$id);
			$this->db->update('familia',$data);
			return array('error' => false, "mensaje" => "El almacen se edito correctamente");
		}else{
			return array('error' => true, "mensaje" => "Error al registrar el almacen, faltan datos");
		}
	}

	public function deleteAlmacen($id = NULL){
		if(isset($id)){
			$this->db->where('_uuid', $id);
			$this->db->delete('almacen');
			return array('error' => false, "mensaje" => "El almacen se eliminó correctamente");
		}else{
			return array('error' => true, "mensaje" => "Error al borrar el almacen, faltan registro");
		}
	}
}