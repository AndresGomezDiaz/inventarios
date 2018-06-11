<?php
if (!defined('BASEPATH')){ exit('No direct script access allowed'); }

class EmpresaAlta extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Empresa_model');
		$this->load->helper('rfc_helper');
  }

	public function index(){
		if($this->session->userdata('perfil') == FALSE){
			redirect(base_url().'login');
		}
		
		$data = array(
					"nomToken"			=> $this->security->get_csrf_token_name(),
					"valueToken"		=> $this->security->get_csrf_hash(),
					"nombre_comercial"	=> empty(set_value('nombre_comercial')) ? "" : set_value('nombre_comercial'),
					"razon_social"		=> empty(set_value('razon_social')) ? "" : set_value('razon_social'),
					"rfc"				=> empty(set_value('rfc')) ? "" : set_value('rfc')
					);

		$this->template->add_css();
		$this->template->add_js();
		$this->template->load('default_layout', 'contents' , 'empresa/empresa_alta', $data);
	}

	public function editarEmpresa($registro = NULL){
		if($this->session->userdata('perfil') == false){
			redirect(base_url().'Login');
		}
		if(isset($registro)){
			$infoEmpresa = $this->Empresa_model->getEmpresa($registro);
			$data = array(
							"nomToken"			=> $this->security->get_csrf_token_name(),
							"valueToken"		=> $this->security->get_csrf_hash(),
							"nombre_comercial"	=> empty(set_value('nombre_comercial')) ? $infoEmpresa->nombre_comercial : set_value('nombre_comercial'),
							"razon_social"		=> empty(set_value('razon_social')) ? $infoEmpresa->razon_social : set_value('razon_social'),
							"rfc"				=> empty(set_value('rfc')) ? $infoEmpresa->rfc : set_value('rfc'),
							"registro"			=> $registro
							);

			$this->template->add_js();
			$this->template->add_css();
			$this->template->load('default_layout', 'contents' , 'empresa/empresa_alta', $data);
		}else{
			redirect(base_url().'empresa');
		}
	}

	public function guardarEmpresa($registro = NULL){
		if($this->session->userdata('perfil') == false){
			redirect(base_url().'Login');
		}

		$this->form_validation->set_rules('nombre_comercial', 'nombre comercial de la empresa', 'required');
    $this->form_validation->set_rules('razon_social', 'razon social de la empresa', 'required');

		if(isset($registro)){
			$infoEmpresa = $this->Empresa_model->getEmpresa($registro);
			if($infoEmpresa->rfc != $this->input->post('rfc')){
				$this->form_validation->set_rules('rfc','rfc de la empesa', 'callback_valida_rfc');
			}
		}else{
			$this->form_validation->set_rules('rfc','rfc de la empesa', 'callback_valida_rfc');
		}

		$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');
		$this->form_validation->set_message('required', 'Este campo es requerido');

		if($this->form_validation->run() == FALSE){
			if(isset($registro)){
				$this->editarEmpresa($registro);
			}else{
				$this->index();
			}
		}else{
			if(isset($registro)){
				$data = array(
								"nombre_comercial"=>$this->input->post('nombre_comercial'),
								"razon_social"=>$this->input->post('razon_social'),
								"rfc"=>$this->input->post('rfc')
								);
				$this->Empresa_model->updateEmpresa($registro, $data);
			}else{
				$data = array(
								"nombre_comercial"=>$this->input->post('nombre_comercial'),
								"razon_social"=>$this->input->post('razon_social'),
								"rfc"=>$this->input->post('rfc')
								);
				$this->Empresa_model->createEmpresa($data);
			}
			redirect(base_url().'empresa','refresh');
		}
	}

	public function valida_rfc($rfc){
		if($rfc){
			//vemos is es un rfc valido:
			if(validarRFC($rfc)){
				//Validamos que no exista en la base de datos;
				$infoEmpresas = $this->Empresa_model->getEmpresas(array('rfc'=>$rfc));
				if($infoEmpresas->num_rows() == 0){
					return true;
				}else{
					$this->form_validation->set_message('valida_rfc', 'El RFC ya existe');
					return false;
				}
			}else{
				$this->form_validation->set_message('valida_rfc', 'Debe escribir un RFC válido'.validarRFC($rfc));
				return false;
			}
		}else{
			$this->form_validation->set_message('valida_rfc', 'El RFC es obligatorio');
			return false;
		}
	}
}

?>

