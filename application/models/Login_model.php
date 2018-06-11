<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function userValidate($usuario = NULL){
		//CON ESTA FUNCION VAMOS A VER SI ES UN EMPLEADO O UN VENDEDOR
		if(isset($usuario)){
			$data = array('email' => $usuario, 'status' => '1');
			$this->db->where($data);
			$query = $this->db->get('usuario');
			if($query->num_rows() == 1){
				return true;
			}else{
				return false;
			}
		}
	}

	public function userValidatePass($usuario = NULL, $password = NULL){
		if($this->userValidate($usuario)){
			//si es un admin o vendedor buscamos como usuario:
			if(isset($password)){
				$this->db->where(array('email' => $usuario, 'password' => sha1($password)));
				$query = $this->db->get('usuario');
				if($query->num_rows() == 1){
					$row = $query->row(0);
					$result = array("error" => false, "total"=>$query->num_rows(), "result" => $row);
				}else{
					$result = array("error" => true, "error" => "Datos de acceso incorrectos");
				}
			}else{
				$result = array("error" => true, "error" => "Datos de acceso incorrectos");
			}
		}
		return $result;
	}
	
}