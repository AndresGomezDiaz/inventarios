<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Familia_model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}

	public function getFamilias($filtro = NULL){
		if(isset($filtro)){
			$this->db->where($filtro);
		}
		$query = $this->db->get('familia');
		return $query;
	}

	public function getFamilia($id = NULL){
		$data = array("id_familia"=>$id);
		$query = $this->getFamilias($data);
		return $query->row(0);
	}

	public function createFamilia($data = NULL){
		if(isset($data)){
			$this->db->insert('familia', $data);
			return array('error' => false, "mensaje" => "La familia se registró correctamente", "registro" => $this->db->insert_id());
		}else{
			return array('error' => true, "mensaje" => "Error al registrar la familia, faltan datos.");
		}
	}

	public function updateFamilia($id = NULL, $data = NULL){
		if(isset($id)){
			$this->db->where('id_familia',$id);
			$this->db->update('familia',$data);
			return array('error' => false, "mensaje" => "El almacen se edito correctamente");
		}else{
			return array('error' => true, "mensaje" => "Error al registrar el almacen, faltan datos");
		}
	}

	public function deleteAlmacen($id = NULL){
		if(isset($id)){
			$this->db->where('id_almacen', $id);
			$this->db->delete('almacen');
			return array('error' => false, "mensaje" => "El almacen se eliminó correctamente");
		}else{
			return array('error' => true, "mensaje" => "Error al borrar el almacen, faltan registro");
		}
	}
}