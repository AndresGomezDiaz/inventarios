<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UsuarioAlta extends CI_Controller{
    public function __construct(){
        parent::__construct();
		$this->load->library(array('session','form_validation'));
		$this->load->model(array('Usuario_model','CodigoPostal_model'));
		$this->load->helper(array('form','date'));
		$this->load->helper('perfil');
    }

	public function index(){
		if($this->session->userdata('perfil') == false){
			redirect(base_url().'Login');
		}

		$data = array(
						"nomToken"		=> $this->security->get_csrf_token_name(),
						"valueToken"	=> $this->security->get_csrf_hash(),
						"perfiles"		=> listaPerfiles(),
						"nombre"		=> empty(set_value('nombre')) ? "" : set_value('nombre'),
						"apellido"		=> empty(set_value('apellido')) ? "" : set_value('apellido'),
						"correo"		=> empty(set_value('correo')) ? "" : set_value('correo'),
						"telefono"		=> empty(set_value('telefono')) ? "" : set_value('telefono'),
						"perfil"		=> empty(set_value('perfil')) ? "" : set_value('perfil'),
						"pass"			=> empty(set_value('pass')) ? "" : set_value('pass'),
						"venta_diaria"	=> empty(set_value('venta_diaria')) ? "" : set_value("venta_diaria"),
						"dato"			=> "",
						);

		$this->template->add_js();
		$this->template->add_css();
		$this->template->load('default_layout', 'contents' , 'usuario/usuario_alta', $data);
	}

	public function vendedorAlta(){
		if($this->session->userdata('perfil') == false){
			redirect(base_url().'Login');
		}
		$estados = $this->CodigoPostal_model->estados();

		$data = array(
						"estados"		=> $estados,
						"nomToken"		=> $this->security->get_csrf_token_name(),
						"valueToken"	=> $this->security->get_csrf_hash(),
						"perfiles"		=> listaPerfiles(),
						"nombre"		=> empty(set_value('nombre')) ? "" : set_value('nombre'),
						"apellido"		=> empty(set_value('apellido')) ? "" : set_value('apellido'),
						"correo"		=> empty(set_value('correo')) ? "" : set_value('correo'),
						"telefono"		=> empty(set_value('telefono')) ? "" : set_value('telefono'),
						"pass"			=> empty(set_value('pass')) ? "" : set_value('pass'),
						"venta_diaria"	=> empty(set_value('venta_diaria')) ? "" : set_value("venta_diaria"),
						"estado"		=> empty(set_value('estado')) ? "" : set_value("estado"),
						"municipio"		=> empty(set_value('municipio')) ? "" : set_value("municipio"),
						"dato"			=> "",
						);

		$this->template->add_js(array(base_url().'assets/js/usuarioAlta.js'));
		$this->template->add_css();
		$this->template->load('default_layout', 'contents' , 'usuario/vendedor_alta', $data);
	}

	public function editaVendedor($registro = NULL){
		if($this->session->userdata('perfil') == false){
			redirect(base_url().'Login');
		}
		if(isset($registro)){
			$infoUsuario = $this->Usuario_model->infoUsuario($registro);
			$estados = $this->CodigoPostal_model->estados();
			$data = array(
							"estados"		=> $estados,
							"nomToken"		=> $this->security->get_csrf_token_name(),
							"valueToken"	=> $this->security->get_csrf_hash(),
							"perfiles"		=> listaPerfiles(),
							"nombre"		=> empty(set_value('nombre')) ? $infoUsuario->nombre : set_value('nombre'),
							"apellido"		=> empty(set_value('apellido')) ? $infoUsuario->apellido : set_value('apellido'),
							"correo"		=> empty(set_value('correo')) ? $infoUsuario->correo : set_value('correo'),
							"venta_diaria"	=> empty(set_value('venta_diaria')) ? $infoUsuario->venta_diaria : set_value("venta_diaria"),
							"estado"		=> empty(set_value('estado')) ? $infoUsuario->estado : set_value("estado"),
							"municipio"		=> empty(set_value('municipio')) ? $infoUsuario->municipio : set_value("municipio"),
							"registro"		=> $registro
							);

			$this->template->add_js();
			$this->template->add_css();
			$this->template->load('default_layout', 'contents' , 'usuario/vendedor_alta', $data);
		}else{
			redirect(base_url().'usuarios');
		}
	}

	public function editaUsuario($registro = NULL){
		if($this->session->userdata('perfil') == false){
			redirect(base_url().'Login');
		}
		if(isset($registro)){
			$infoUsuario = $this->Usuario_model->infoUsuario($registro);

			$data = array(
							"nomToken"		=> $this->security->get_csrf_token_name(),
							"valueToken"	=> $this->security->get_csrf_hash(),
							"perfiles"		=> listaPerfiles(),
							"nombre"		=> empty(set_value('nombre')) ? $infoUsuario->nombre : set_value('nombre'),
							"apellido"		=> empty(set_value('apellido')) ? $infoUsuario->apellido : set_value('apellido'),
							"correo"		=> empty(set_value('correo')) ? $infoUsuario->correo : set_value('correo'),
							"telefono"		=> empty(set_value('telefono')) ? $infoUsuario->telefono : set_value('telefono'),
							"perfil"		=> empty(set_value('perfil')) ? $infoUsuario->perfil : set_value('perfil'),
							"venta_diaria"	=> empty(set_value('venta_diaria')) ? $infoUsuario->venta_diaria : set_value("venta_diaria"),
							"dato"			=> "",
							"registro"		=> $registro
							);

			$this->template->add_js();
			$this->template->add_css();
			$this->template->load('default_layout', 'contents' , 'usuario/usuario_alta', $data);
		}else{
			redirect(base_url().'usuarios');
		}
	}

	public function guardaUsuario($registro = NULL){
		if($this->session->userdata('perfil') == false){
			redirect(base_url().'Login');
		}

		$this->form_validation->set_rules('nombre', 'nombre del usuario', 'required');
        $this->form_validation->set_rules('apellido', 'apellidos del usuario', 'required');
        $this->form_validation->set_rules('venta_diaria', 'venta diara del usuario', 'numeric');

        if(isset($registro)){
        	if($this->input->post('pass') != ""){
        		$this->form_validation->set_rules('pass1', 'confirmacion de password', 'callback_valida_pass');
        	}
        	$infoUsuario = $this->Usuario_model->infoUsuario($registro);
        	if($infoUsuario->correo != $this->input->post('correo')){
        		$this->form_validation->set_rules('correo','correo electronico', 'callback_valida_mail');
        	}
        	if($infoUsuario->telefono != $this->input->post('telefono')){
        		$this->form_validation->set_rules('telefono','telefono celular', 'callback_valida_celular');
        	}
        }else{
        	$this->form_validation->set_rules('correo','correo electronico', 'callback_valida_mail');
        	$this->form_validation->set_rules('telefono','telefono celular', 'callback_valida_celular');
        	$this->form_validation->set_rules('pass', 'password de acceso', 'required');
			$this->form_validation->set_rules('pass1', 'confirmacion de password', 'callback_valida_pass');
        }

        $this->form_validation->set_error_delimiters('<span class="help-block">','</span>');
        $this->form_validation->set_message('required', 'Este campo es requerido');
        $this->form_validation->set_message('matches', 'Las contraseñas deben ser iguales');
        $this->form_validation->set_message('numeric', 'El campo debe ser numerico');

        if($this->form_validation->run() == FALSE){
			if(isset($registro)){
				$this->editaUsuario($registro);
			}else{
				$this->index();
			}
		}else{
			if(isset($registro)){
				$data = array(
								"nombre"=>$this->input->post('nombre'),
								"apellido"=>$this->input->post('apellido'),
								"correo"=>$this->input->post('correo'),
								"telefono"=>$this->input->post('telefono'),
								"perfil"=>$this->input->post('perfil'),
								"venta_diaria" => $this->input->post('venta_diaria')
								);
				if($this->input->post('pass') != ""){
					$data['pass'] = sha1($this->input->post('pass'));
				}
				$this->Usuario_model->editaUsuario($registro, $data);
			}else{
				$data = array(
								"nombre"=>$this->input->post('nombre'),
								"apellido"=>$this->input->post('apellido'),
								"correo"=>$this->input->post('correo'),
								"telefono"=>$this->input->post('telefono'),
								"pass"=> sha1($this->input->post('pass')),
								"perfil"=>$this->input->post('perfil'),
								"venta_diaria" => $this->input->post('venta_diaria')
								);
				$this->Usuario_model->altaUsuario($data);
			}
			redirect(base_url().'usuarios','refresh');
		}

	}

	public function eliminaUsuario($registro = NULL){
		if($this->session->userdata('perfil') == FALSE){
			redirect(base_url().'Login');
		}
		if(isset($registro)){
			$this->Usuario_model->borraUsuario($registro);
			redirect(base_url().'usuarios');
		}else{
			redirect(base_url().'usuarios');
		}
	}

	public function inactivarUsuario($registro = NULL){
		if($this->session->userdata('perfil') == false){
			redirect(base_url().'Login');
		}
		if(isset($registro)){
			$this->Usuario_model->editaUsuario($registro, array("estatus" => "0"));
			redirect(base_url().'usuarios');
		}else{
			redirect(base_url().'usuarios');
		}
	}

	public function activarUsuario($registro = NULL){
		if($this->session->userdata('perfil') == false){
			redirect(base_url().'Login');
		}
		if(isset($registro)){
			$this->Usuario_model->editaUsuario($registro, array("estatus" => "1"));
			redirect(base_url().'usuarios');
		}else{
			redirect(base_url().'usuarios');
		}
	}

	public function eliminaVendedor($registro = NULL){
		if($this->session->userdata('perfil') == FALSE){
			redirect(base_url().'Login');
		}
		if(isset($registro)){
			$this->Usuario_model->borraUsuario($registro);
			redirect(base_url().'vendedores');
		}else{
			redirect(base_url().'vendedores');
		}
	}

	public function inactivarVendedor($registro = NULL){
		if($this->session->userdata('perfil') == false){
			redirect(base_url().'Login');
		}
		if(isset($registro)){
			$this->Usuario_model->editaUsuario($registro, array("estatus" => "0"));
			redirect(base_url().'vendedores');
		}else{
			redirect(base_url().'vendedores');
		}
	}

	public function activarVendedor($registro = NULL){
		if($this->session->userdata('perfil') == false){
			redirect(base_url().'Login');
		}
		if(isset($registro)){
			$this->Usuario_model->editaUsuario($registro, array("estatus" => "1"));
			redirect(base_url().'vendedores');
		}else{
			redirect(base_url().'vendedores');
		}
	}

	public function valida_pass($dato){
		if($dato){
			if($this->input->post('pass') != $dato){
				$this->form_validation->set_message('valida_pass', 'Las contraseñas tiene que ser iguales');
				return false;
			}else{
				return true;
			}
		}else{
			$this->form_validation->set_message('valida_pass', 'Las contraseñas tiene que ser iguales');
			return false;
		}
	}

	public function valida_mail($dato){
		if($dato){
			//vemos is es un email valido:
			if(filter_var($dato, FILTER_VALIDATE_EMAIL)){
				//vemos si no existe en la base de datos:
				if($this->Usuario_model->validaUsuario($dato) == 0){
					return true;
				}else{
					$this->form_validation->set_message('valida_mail', 'El correo ya existe como usuario o como empleado');
					return false;
				}
			}else{
				$this->form_validation->set_message('valida_mail', 'El correo no es valido');
				return false;
			}
		}else{
			$this->form_validation->set_message('valida_mail', 'El correo es obligatorio');
			return false;
		}
	}

	public function valida_celular($dato){
		if($dato){
			//vemos is es un email valido:
			if(is_numeric($dato) && strlen($data) != 10){
				//vemos si no existe en la base de datos:
				if($this->Usuario_model->validaCelular($dato) == 0){
					return true;
				}else{
					$this->form_validation->set_message('valida_celular', 'El celular ya existe como usuario o vendedor');
					return false;
				}
			}else{
				$this->form_validation->set_message('valida_celular', 'El celular no es valido');
				return false;
			}
		}else{
			$this->form_validation->set_message('valida_celular', 'El celular es obligatorio');
			return false;
		}
	}
}
?>
