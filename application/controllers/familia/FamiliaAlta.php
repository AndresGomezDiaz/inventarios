<?php
if (!defined('BASEPATH')){ exit('No direct script access allowed'); }
class FamiliaAlta extends CI_Controller {
	public function __construct(){
    parent::__construct();
		$this->load->model('Familia_model');
    	$this->load->helper('uuidV4_helper');
  	}
	public function index(){
		if($this->session->userdata('perfil') == FALSE){
			redirect(base_url().'login');
		}	
		$data = array(
					"nomToken"			=> $this->security->get_csrf_token_name(),
					"valueToken"		=> $this->security->get_csrf_hash(),
					"nombre"	=> empty(set_value('nombre')) ? "" : set_value('nombre'),
					);
		$this->template->add_css();
		$this->template->add_js();
		$this->template->load('default_layout', 'contents' , 'familia/familia_alta', $data);
	}
	public function editarFamilia($registro = NULL){
		if($this->session->userdata('perfil') == false){
			redirect(base_url().'Login');
		}
		if(isset($registro)){
			$infoFamilia = $this->Familia_model->getFamilia($registro);
			$data = array(
							"nomToken"			=> $this->security->get_csrf_token_name(),
							"valueToken"		=> $this->security->get_csrf_hash(),
							"nombre"				=> empty(set_value('nombre')) ? $infoFamilia->nombre : set_value('nombre'),
							"registro"			=> $registro
							);

			$this->template->add_js();
			$this->template->add_css();
			$this->template->load('default_layout', 'contents' , 'familia/familia_alta', $data);
		}else{
			redirect(base_url().'familia');
		}
	}
	public function guardarFamiliaa($registro = NULL){
		if($this->session->userdata('perfil') == false){
			redirect(base_url().'Login');
		}
		$this->form_validation->set_rules('nombre', 'nombre de la familia', 'required');
	    $this->form_validation->set_error_delimiters('<span class="help-block">','</span>');
	    $this->form_validation->set_message('required', 'Este campo es requerido');
	    if($this->form_validation->run() == FALSE){
			if(isset($registro)){
				$this->editarFamilia($registro);
			}else{
				$this->index();
			}
		}else{
			if(isset($registro)){
				$data = array("nombre"=>$this->input->post('nombre'));
				$this->Familia_model->updateFamilia($registro, $data);
			}else{
				$data = array("nombre"=>$this->input->post('nombre'));
				$this->Familia_model->createFamilia($data);
			}
			redirect(base_url().'familia','refresh');
		}
	}
}
?>