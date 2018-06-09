<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Controller{
    public function __construct(){
        parent::__construct();
		$this->load->library(array('session','form_validation'));
		$this->load->model('Usuario_model');
    }

	public function index(){
		if($this->session->userdata('perfil') == false){
			redirect(base_url().'Login');
		}

		$data = array(
						"usuarios" => $this->Usuario_model->usuarios(array("perfil" => 1))
						);

		$this->template->add_js();
		$this->template->add_css();
		$this->template->load('default_layout', 'contents' , 'usuario/usuario_lista', $data);
	}

	public function vendedores(){
		if($this->session->userdata('perfil') == false){
			redirect(base_url().'Login');
		}

		$data = array(
						"usuarios" => $this->Usuario_model->usuarios(array("perfil" => 2))
						);

		$this->template->add_js();
		$this->template->add_css();
		$this->template->load('default_layout', 'contents' , 'usuario/vendedor_lista', $data);
	}
}
?>
