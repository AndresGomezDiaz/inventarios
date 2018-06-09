<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Empleado extends CI_Controller{
    public function __construct(){
        parent::__construct();
		$this->load->library(array('session','form_validation'));
		$this->load->model('Empleado_model');
    }

	public function index(){
		if($this->session->userdata('perfil') == false){
			redirect(base_url().'Login');
		}
		$filtro = array();
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			empty($this->input->post('nombre')) ? null : $filto['nombre'] = $this->input->post('nombre');
			empty($this->input->post('correo')) ? null : $filtro['correo'] = $this->input->post('correo');
			empty($this->input->post('vendedor')) ? null : $filtro['id_usuario'] = $this->input->post('vendedor');
		}

		$data = array(
						"empleados" => $this->Empleado_model->empleadosLista($filtro)
					);

		$this->template->add_js();
		$this->template->add_css();
		$this->template->load('default_layout', 'contents' , 'usuario/empleado_lista', $data);
	}
}
?>
