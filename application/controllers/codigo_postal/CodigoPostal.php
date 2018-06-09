<?php
if (!defined('BASEPATH')){ exit('No direct script access allowed'); }

class CodigoPostal extends CI_Controller {

	public function __construct(){
        parent::__construct();
		$this->load->model('CodigoPostal_model');
    }

	public function index(){
		die('Nothing here');
	}

	public function dimeEstados(){
		return $estados = $this->CodigoPostal_model->dimeEstados();
	}

	public function dimeMunicipios(){
		if($this->input->post('estado')){
			$municipios = $this->CodigoPostal_model->municipios(array("estado"=>$this->input->post('estado')));
			echo "<option value=''>Seleccione</option>";
			foreach($municipios->result() as $info):
				if($this->input->post('municipio')){
					if($info->municipio == $this->input->post('municipio')){
						echo "<option value='".$info->municipio."' selected>".$info->municipio."</option>";
					}else{
						echo "<option value='".$info->municipio."'>".$info->municipio."</option>";
					}
				}else{
					echo "<option value='".$info->municipio."'>".$info->municipio."</option>";
				}
			endforeach;
		}else{
			echo "<option value=''>Sin registros</option>";
		}
	}

}

?>

