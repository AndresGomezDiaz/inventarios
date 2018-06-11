<?php
if (!defined('BASEPATH')){ exit('No direct script access allowed'); }

class Almacen extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(array('Empresa_model', 'Almacen_model'));
		$this->load->helper('rfc_helper', 'uuidV4_helper');
  }

	public function index(){
		if($this->session->userdata('perfil') == FALSE){
			redirect(base_url().'login');
		}
		$empresas = $this->Empresa_model->getEmpresas();
		$data = array(
					"nomToken"		=> $this->security->get_csrf_token_name(),
					"valueToken"	=> $this->security->get_csrf_hash(),
					"nombre"		=> empty(set_value('nombre')) ? "" : set_value('nombre'),
					"empresa"		=> empty(set_value('empresa')) ? "" : set_value('empresa'),
					"empresas"		=> $empresas
					);

		$this->template->add_css();
		$this->template->add_js();
		$this->template->load('default_layout', 'contents' , 'almacen/almacen_alta', $data);
	}

	public function editarAlmacen($registro = NULL){
		if($this->session->userdata('perfil') == false){
			redirect(base_url().'Login');
		}
		if(isset($registro)){
			$infoAlmacen = $this->Almacen_model->getAlmacen($registro);
			$empresas = $this->Empresa_model->getEmpresas();

			$data = array(
							"nomToken"			=> $this->security->get_csrf_token_name(),
							"valueToken"		=> $this->security->get_csrf_hash(),
							"empresa"			=> empty(set_value('empresa')) ? $infoAlmacen->id_empresa : set_value('empresa'),
							"nombre"			=> empty(set_value('nombre')) ? $infoAlmacen->nombre : set_value('nombre'),
							"empresas"			=> $empresas,
							"registro"			=> $registro
							);

			$this->template->add_js();
			$this->template->add_css();
			$this->template->load('default_layout', 'contents' , 'almacen/almacen_alta', $data);
		}else{
			redirect(base_url().'almacen');
		}
	}

	public function guardarAlmacen($registro = NULL){
		if($this->session->userdata('perfil') == false){
			redirect(base_url().'Login');
		}

		$this->form_validation->set_rules('nombre', 'nombre del almacen', 'required');
        $this->form_validation->set_rules('empresa', 'empresa a la que esta relacionado el almacen', 'required');

        $this->form_validation->set_error_delimiters('<span class="help-block">','</span>');
        $this->form_validation->set_message('required', 'Este campo es requerido');

        if($this->form_validation->run() == FALSE){
			if(isset($registro)){
				$this->editarAlmacen($registro);
			}else{
				$this->index();
			}
		}else{
			if(isset($registro)){
				$data = array(
								"nombre"=>$this->input->post('nombre'),
								"id_empresa"=>$this->input->post('empresa')
								);
				$this->Almacen_model->updateAlmacen($registro, $data);
			}else{
				$data = array(
								"nombre"=>$this->input->post('nombre'),
								"id_empresa"=>$this->input->post('empresa')
								);
				$this->Almacen_model->createAlmacen($data);
			}
			redirect(base_url().'almacen','refresh');
		}
	}
}

?>

