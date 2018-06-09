<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller{

    public function __construct(){
        parent::__construct();
		$this->load->library(array('session','form_validation', 'encryption'));
		$this->load->helper(array('form'));
		$this->load->model(array('Login_model'));
    }

	public function index(){
		header("Access-Control-Allow-Origin: *");
		if($this->session->userdata('perfil') == ""){
			$data['token'] = $this->token();
			$this->template->set('title', '');
			$this->template->load('login_layout', 'contents' , 'login', $data);
		}else{
			redirect(base_url().'Home');
		}
	}

	public function acceso(){
		if($this->input->post('token') && $this->input->post('token') == $this->session->userdata('token')){
            $this->form_validation->set_rules('usuario', 'nombre de usuario', 'trim|required|valid_email|xss_clean');
            $this->form_validation->set_rules('pass', 'password', 'required|trim|min_length[1]|max_length[150]|xss_clean');
            //lanzamos mensajes de error si es que los hay
			if($this->form_validation->run() == FALSE){
				$this->index();
			}else{
				$username = $this->input->post('usuario');
				$password = $this->input->post('pass');
				//validamos el usuario:
				$infoUsuario = $this->Login_model->userValidatePass($username, $password);
				if($infoUsuario['error']){
					$this->session->set_flashdata('error','Los datos introducidos son incorrectos');
					redirect(base_url().'Login','refresh');
				}else{
					$data = array(
								'is_logued_in' 	=> 		TRUE,
								'perfil'		=>		$infoUsuario['result']->perfil,
								'nombre' 		=> 		$infoUsuario['result']->nombre,
								'correo'		=>		$infoUsuario['result']->email,
								'id'			=>		$infoUsuario['result']->_uuid
								);
					$this->session->set_userdata($data);
					redirect(base_url().'Home');
				}
			}
		}else{
			$this->session->set_flashdata('error','Los datos introducidos son incorrectos');
			redirect(base_url().'Login');
		}
	}

	public function token(){
		$token = md5(uniqid(rand(),true));
		$this->session->set_userdata('token',$token);
		return $token;
	}
	public function logout(){
		$this->session->sess_destroy();
		$this->index();
	}
}
?>
