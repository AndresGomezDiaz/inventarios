<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Empresa_model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}

	public function getEmpresas($filtro = NULL){
		if(isset($filtro)){
			$this->db->where($filtro);
		}
		$query = $this->db->get('empresa');
		return $query;
	}

	public function getEmpresa($id = NULL){
		$data = array("id_usuario"=>$id);
		$query = $this->getEmpresas($data);
		return $query->row(0);
	}

	public function createEmpresa($data = NULL){
		if(isset($data)){
			$this->db->insert('empresa', $data);
			return array('error' => false, "mensaje" => "La empresa se registró correctamente", "registro" => $this->db->insert_id());
		}else{
			return array('error' => true, "mensaje" => "Error al registrar la empresa, faltan datos.");
		}
	}

	public function updateEmpresa($id = NULL, $data = NULL){
		if(isset($id)){
			$this->db->where('id_empresa',$id);
			$this->db->update('empresa',$data);
			return array('error' => false, "mensaje" => "La empresa se edito correctamente");
		}else{
			return array('error' => true, "mensaje" => "Error al registrar la empresa, faltan datos");
		}
	}

	public function deleteEmpresa($id = NULL){
		if(isset($id)){
			$this->db->where('id_empresa', $id);
			$this->db->delete('empresa');
			return array('error' => false, "mensaje" => "La empresa se eliminó correctamente");
		}else{
			return array('error' => true, "mensaje" => "Error al borrar la empresa, faltan registro");
		}
	}
}