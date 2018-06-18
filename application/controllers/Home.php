<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller{
    public function __construct(){
        parent::__construct();
		$this->load->library(array('session','form_validation'));
		$this->load->model(array('Usuario_model'));
    }
	public function index(){
		if($this->session->userdata('perfil') == false){
			redirect(base_url().'Login');
		}
    	$data = array();
		$this->template->add_js();
		$this->template->add_css();
		$this->template->load('default_layout', 'contents' , 'home', $data);
	}
}
?>
