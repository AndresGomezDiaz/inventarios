<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Almacen_model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}

	public function getAlmacenes($filtro = NULL){
		if(isset($filtro)){
			$this->db->where($filtro);
		}
		$query = $this->db->get('almacen');
		return $query;
	}

	public function getAlmacen($id = NULL){
		$data = array("id_almacen"=>$id);
		$query = $this->getAlmacenes($data);
		return $query->row(0);
	}

	public function createAlmacen($data = NULL){
		if(isset($data)){
			$this->db->insert('almacen', $data);
			return array('error' => false, "mensaje" => "El almacen se registró correctamente", "registro" => $this->db->insert_id());
		}else{
			return array('error' => true, "mensaje" => "Error al registrar el almacen, faltan datos.");
		}
	}

	public function updateAlmacen($id = NULL, $data = NULL){
		if(isset($id)){
			$this->db->where('id_almacen',$id);
			$this->db->update('almacen',$data);
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