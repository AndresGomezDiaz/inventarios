<?php
if (!defined('BASEPATH')){ exit('No direct script access allowed'); }
class Empresa extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Empresa_model');
  	}
	public function index(){
		if($this->session->userdata('perfil') === FALSE){
			redirect(base_url().'login');
		}
		$empresas = $this->Empresa_model->getEmpresas();
		$data = array("empresas" => $empresas);	
		$this->template->add_css();
		$this->template->add_js();
		$this->template->load('default_layout', 'contents' , 'empresa/empresa_lista', $data);
	}
}
?>