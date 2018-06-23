<?php
if (!defined('BASEPATH')){ exit('No direct script access allowed'); }
class Unidad extends CI_Controller {
	public function __construct(){
        parent::__construct();
		$this->load->model('Unidad_model');
    }
	public function index(){
		if($this->session->userdata('perfil') == FALSE){
			redirect(base_url().'login');
		}
		$unidades = $this->Unidad_model->getUnidades();
		$data = array("unidades" => $unidades);	
		$this->template->add_css();
		$this->template->add_js();
		$this->template->load('default_layout', 'contents' , 'unidad/unidad_lista', $data);
	}
}
?>