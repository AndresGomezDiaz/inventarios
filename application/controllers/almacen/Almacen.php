<?php
if (!defined('BASEPATH')){ exit('No direct script access allowed'); }

class Almacen extends CI_Controller {

	public function __construct(){
        parent::__construct();
		$this->load->model('Almacen_model');
    }

	public function index(){
		if($this->session->userdata('perfil') == FALSE){
			redirect(base_url().'login');
		}
		$almacenes = $this->Empresa_model->getAlmacenes();
		$data = array("almacenes" => $almacenes)
		
		$this->template->add_css();
		$this->template->add_js();
		$this->template->load('default_layout', 'contents' , 'almacen/almacen_lista', $data);
	}

}

?>

