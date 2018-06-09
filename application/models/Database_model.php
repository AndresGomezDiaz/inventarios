<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Database_model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}

	public function getTabla($tabla = NULL, $filtro = NULL){
		if(isset($filtro)){
			$this->db->where($filtro);
		}
		$query = $this->db->get($tabla);
		return $query;
	}

	public function getId($id = NULL, $tabla = NULL){
		$data = array("id_".$tabla => $id);
		$query = $this->getTabla($tabla, $data);
		return $query->row(0);
	}

	public function createRow($tabla = NULL, $data = NULL){
		if(isset($data) && isset($tabla)){
			$this->db->insert($tabla, $data);
			return array('error' => false, "mensaje" => "El registró se ingresó correctamente", "registro" => $this->db->insert_id());
		}else{
			return array('error' => true, "mensaje" => "Error al la información, faltan datos.");
		}
	}

	public function updateRow($id = NULL, $tabla = NULL){
		if(isset($id) && isset($tabla)){
			$this->db->where('id_'.$tabla, $id);
			$this->db->update($tabla, $data);
			return array('error' => false, "mensaje" => "El registro se editó correctamente");
		}else{
			return array('error' => true, "mensaje" => "Error al actualizar la información, faltan datos");
		}
	}

	public function deleteRow($id = NULL, $tabla = NULL){
		if(isset($id) && isset($tabla)){
			$this->db->where('id_'.$tabla, $id);
			$this->db->delete($tabla);
			return array('error' => false, "mensaje" => "El registro se eliminó correctamente");
		}else{
			return array('error' => true, "mensaje" => "Error al eliminar el registro, faltan datos");
		}
	}
}