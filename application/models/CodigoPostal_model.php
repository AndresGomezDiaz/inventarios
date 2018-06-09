<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CodigoPostal_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function estados($filtro = NULL){
		$sql = "SELECT DISTINCT(estado) as estado
				FROM codigo_postal WHERE id_codigo_postal > 0";
		if(isset($filtro)){
			foreach ($filtro as $key => $value):
				$sql .= " AND ".$key." = '".$value."'";
			endforeach;
		}

		$query = $this->db->query($sql);
		return $query;
	}

	public function municipios($filtro = NULL){
		$sql = "SELECT DISTINCT(del_muni) as municipio
				FROM codigo_postal WHERE id_codigo_postal > 0";
		if(isset($filtro)){
			foreach ($filtro as $key => $value):
				$sql .= " AND ".$key." = '".$value."'";
			endforeach;
		}
		$query = $this->db->query($sql);
		return $query;
	}

}
