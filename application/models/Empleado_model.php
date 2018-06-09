<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Empleado_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function empleados($filtro = NULL){
		if(isset($filtro)){
			$this->db->where($filtro);
		}
		$query = $this->db->get('empleado');
		return $query;
	}

	public function empleadosLista($filtro = NULL){
		if(isset($id)){
			$this->db->where($filtro);
		}
		$this->db->select('a.id_empleado, a.nombre, a.apellido, a.correo, a.numero, a.id_usuario, a.estado, a.municipio, a.estatus, b.estatus AS estatus_jefe, b.nombre as nom_vendedor, b.apellido as apellido_vendedor');
		$this->db->from('empleado a');
		$this->db->join('usuario b', 'a.id_usuario = b.id_usuario', 'INNER');
		$query = $this->db->get();

		return $query;
	}

	public function infoEmpleado($id = NULL){
		if(isset($id)){
			$this->db->where("a.id_empleado", $id);
		}
		$this->db->select('a.nombre, a.apellido, a.correo, a.numero, a.id_usuario, a.estado, a.municipio, a.estatus, b.estatus AS estatus_jefe');
		$this->db->from('empleado a');
		$this->db->join('usuario b', 'a.id_usuario = b.id_usuario', 'INNER');
		$query = $this->db->get();

		return $query;
	}

	public function altaEmpleado($data = NULL){
		if(isset($data)){
			$this->db->insert('empleado', $data);
			return true;
		}else{
			return false;
		}
	}

	public function editaEmpleado($id = NULL, $data = NULL){
		if(isset($id)){
			$this->db->where('id_empleado',$id);
			$this->db->update('empleado',$data);
			return true;
		}else{
			return false;
		}
	}


	public function borraEmpleado($id = NULL){
		if(isset($id)){
			$this->db->where('id_empleado', $id);
			$this->db->delete('empleado');
			return true;
		}else{
			return false;
		}
	}

}
