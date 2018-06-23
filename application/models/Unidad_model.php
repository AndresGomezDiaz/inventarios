<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Unidad_model extends CI_Model {
	
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

	public function getUnidades($filtro = NULL){
		if(isset($filtro)){
			$this->db->where($filtro);
		}
		$query = $this->db->get('unidad');
		return $query;
	}

	public function getUnidad($id = NULL){
		$data = array("_uuid "=>$id);
		$query = $this->getUnidades($data);
		return $query->row(0);
	}

	public function createUnidad($data = NULL){
		if(isset($data)){
			$data['_uuid'] = $this->uuidv4();
			$this->db->insert('unidad', $data);
			return array('error' => false, "mensaje" => "La unidad se registró correctamente", "registro" => $this->db->insert_id());
		}else{
			return array('error' => true, "mensaje" => "Error al registrar la unidad, faltan datos.");
		}
	}

	public function updateUnidad($id = NULL, $data = NULL){
		if(isset($id)){
			$this->db->where('_uuid',$id);
			$this->db->update('unidad',$data);
			return array('error' => false, "mensaje" => "La unidad se edito correctamente");
		}else{
			return array('error' => true, "mensaje" => "Error al registrar la unidad, faltan datos");
		}
	}

	public function deleteUnidad($id = NULL){
		if(isset($id)){
			$this->db->where('_uuid', $id);
			$this->db->delete('unidad');
			return array('error' => false, "mensaje" => "La unidad se eliminó correctamente");
		}else{
			return array('error' => true, "mensaje" => "Error al borrar la unidad, faltan registro");
		}
	}
}