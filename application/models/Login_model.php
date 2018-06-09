<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function validaUsuario($usuario = NULL){
		//CON ESTA FUNCION VAMOS A VER SI ES UN EMPLEADO O UN VENDEDOR
		if(isset($usuario)){
			$data = array('correo' => $usuario, 'estatus' => '1');
			$this->db->where($data);
			$query = $this->db->get('usuario');
			if($query->num_rows() == 1){
				return "1";
			}else{
				//si no es un admin vemos si es un empleado:
				$this->db->select("a.id_empleado");
				$this->db->from("empleado a");
				$this->db->join("usuario b", "a.id_usuario = b.id_usuario", "INNER");
				$this->db->where(array("a.correo" => $usuario, "a.estatus" => 1, "b.estatus" => 1));
				$query1 = $this->db->get();
				if($query1->num_rows() == 0){
					//si no existe devolvemos un cero:
					return "0";
				}else{
					return "2";
				}
			}
		}
	}

	public function validaPassEmpleado($usuario = NULL, $password = NULL){
		if($this->validaUsuario($usuario) == 2){
			if(isset($password)){
				$this->db->where(array('correo' => $usuario, 'pass' => sha1($password)));
				$query = $this->db->get('empleado');
				if($query->num_rows() == 1){
					$row = $query->row(0);
					$result = array("result" => true, "id" => $row->id_empleado);
				}else{
					$result = array("result" => false, "error" => "Datos de acceso incorrectos");
				}
			}else{
				$result = array("result" => false, "error" => "Datos de acceso incorrectos");
			}
		}
		return $result;
	}

	public function validaPassUsuario($usuario = NULL, $password = NULL){
		if($this->validaUsuario($usuario) == 1){
			//si es un admin o vendedor buscamos como usuario:
			if(isset($password)){
				$this->db->where(array('correo' => $usuario, 'pass' => sha1($password)));
				$query = $this->db->get('usuario');
				if($query->num_rows() == 1){
					$row = $query->row(0);
					$result = array("result" => true, "id" => $row->id_usuario);
				}else{
					$result = array("result" => false, "error" => "Datos de acceso incorrectos");
				}
			}else{
				$result = array("result" => false, "error" => "Datos de acceso incorrectos");
			}
		}
		return $result;
	}
	
}