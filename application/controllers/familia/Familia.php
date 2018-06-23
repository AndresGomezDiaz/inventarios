<?php
if (!defined('BASEPATH')){ exit('No direct script access allowed'); }
class Familia extends CI_Controller {
	public function __construct(){
        parent::__construct();
		$this->load->model('Familia_model');
    }
	public function index(){
		if($this->session->userdata('perfil') == FALSE){
			redirect(base_url().'login');
		}
		$familias = $this->Familia_model->getFamilias();
		$data = array("familias" => $familias);	
		$this->template->add_css();
		$this->template->add_js();
		$this->template->load('default_layout', 'contents' , 'familia/familia_lista', $data);
	}
}
?>