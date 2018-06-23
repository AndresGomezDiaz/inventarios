<?php
if (!defined('BASEPATH')){ exit('No direct script access allowed'); }
class Presentacion extends CI_Controller {
	public function __construct(){
        parent::__construct();
		$this->load->model('Presentacion_model');
    }
	public function index(){
		if($this->session->userdata('perfil') == FALSE){
			redirect(base_url().'login');
		}
		$presentaciones = $this->Presentacion_model->getPresentaciones();
		$data = array("unidades" => $presentaciones);	
		$this->template->add_css();
		$this->template->add_js();
		$this->template->load('default_layout', 'contents' , 'presentacion/presentacion_lista', $data);
	}
}
?>