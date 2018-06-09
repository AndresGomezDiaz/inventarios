<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perfil_model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}

	public function getPerfiles($filtro = NULL){
		if(isset($filtro)){
			$this->db->where($filtro);
		}
		$query = $this->db->get('perfil');
		return $query;
	}

	public function getPerfil($id = NULL){
		$data = array("id_perfil"=>$id);
		$query = $this->getPerfiles($data);
		return $query->row(0);
	}
}