<?php
if (!defined('BASEPATH')){ exit('No direct script access allowed'); }
class ProductoAlta extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(array('Producto_model', 'Familia_model'));
  	}
	public function index(){
		if($this->session->userdata('perfil') == FALSE){
			redirect(base_url().'login');
		}
		$familias = $this->Familia_model->getFamilias();
		$unidades = $this->Familia_model->getFamilias();
		$data = array(
					"nomToken"		           	=> $this->security->get_csrf_token_name(),
					"valueToken"	           	=> $this->security->get_csrf_hash(),
					"nombre"			   		=> empty(set_value('nombre')) ? "" : set_value('nombre'),
					"descripcion"				=> empty(set_value('descripcion')) ? "" : set_value('descripcion'),
					"unidad"			   		=> empty(set_value('unidad')) ? "" : set_value('unidad'),
					"presentacion"				=> empty(set_value('presentacion')) ? "" : set_value('presentacion'),
					"cantidad_x_presentacion"	=> empty(set_value('cantidad_x_presentacion')) ? "" : set_value('cantidad_x_presentacion'),
					"precio_costo"			    => empty(set_value('precio_costo')) ? "" : set_value('precio_costo'),
					"precio_venta"			    => empty(set_value('precio_venta')) ? "" : set_value('precio_venta'),
					"familia"			        => empty(set_value('familia')) ? "" : set_value('familia'),
					"familias"		           	=> $familias,
					"unidades"					=> $unidades
		);

		$this->template->add_css();
		$this->template->add_js();
		$this->template->load('default_layout', 'contents' , 'producto/producto_alta', $data);
	}
	public function editarProducto($registro = NULL){
		if($this->session->userdata('perfil') == false){
			redirect(base_url().'Login');
		}
		if(isset($registro)){
			$infoProducto = $this->Producto_model->getProducto($registro);
			$familias = $this->Familia_model->getFamilias();
			$unidades = $this->Familia_model->getFamilias();

			$data = array(
							"nomToken"			        => $this->security->get_csrf_token_name(),
							"valueToken"		        => $this->security->get_csrf_hash(),
							"nombre"				    => empty(set_value('nombre')) ? $infoProducto->nombre : set_value('nombre'),
							"descripcion"				=> empty(set_value('descripcion')) ? $infoProducto->descripcion : set_value('descripcion'),
							"unidad"				    => empty(set_value('unidad')) ? $infoProducto->unidad : set_value('unidad'),
							"presentacion"				=> empty(set_value('presentacion')) ? $infoProducto->presentacion : set_value('presentacion'),
							"cantidad_x_presentacion"	=> empty(set_value('cantidad_x_presentacion')) ? $infoProducto->cantidad_x_presentacion : set_value('cantidad_x_presentacion'),
							"precio_costo"				=> empty(set_value('precio_costo')) ? $infoProducto->precio_costo : set_value('precio_costo'),
							"precio_venta"				=> empty(set_value('precio_venta')) ? $infoProducto->precio_venta : set_value('precio_venta'),
							"familia"				    => empty(set_value('familia')) ? $infoProducto->familia_id : set_value('familia'),
							"familias"			        => $familias,
							"unidades"					=> $unidades,
							"registro"			        => $registro
							);
			$this->template->add_js();
			$this->template->add_css();
			$this->template->load('default_layout', 'contents' , 'producto/producto_alta', $data);
		}else{
			redirect(base_url().'producto');
		}
	}
	public function guardarProducto($registro = NULL){
		if($this->session->userdata('perfil') == false){
			redirect(base_url().'Login');
		}
		$this->form_validation->set_rules('nombre', 'nombre del producto', 'required');
		$this->form_validation->set_rules('descripcion', 'descripcion del producto', 'required');
		$this->form_validation->set_rules('unidad', 'unidad del producto', 'required');
		$this->form_validation->set_rules('presentacion', 'presentacion del producto', 'required');
		$this->form_validation->set_rules('cantidad_x_presentacion', 'cantidad_x_presentacion del producto', 'required|numeric');
		$this->form_validation->set_rules('precio_costo', 'precio_costo del producto', 'required|numeric');
		$this->form_validation->set_rules('precio_venta', 'precio_venta del producto', 'required|numeric');
		$this->form_validation->set_rules('familia', 'familia a la que esta relacionado el producto', 'required');
		$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');
		$this->form_validation->set_message('required', 'Este campo es requerido');
		if($this->form_validation->run() == FALSE){
			if(isset($registro)){
				$this->editarProducto($registro);
			}else{
				$this->index();
			}
		}else{
			if(isset($registro)){
				$data = array(
								"nombre"					=>$this->input->post('nombre'),
								"descripcion"				=>$this->input->post('descripcion'),
								"unidad"					=>$this->input->post('unidad'),
								"presentacion"				=>$this->input->post('presentacion'),
								"cantidad_x_presentacion"	=>$this->input->post('cantidad_x_presentacion'),
								"precio_costo"				=>$this->input->post('precio_costo'),
								"precio_venta"				=>$this->input->post('precio_venta'),
								"familia_id"				=>$this->input->post('familia')
								);
				$this->Producto_model->updateProducto($registro, $data);
			}else{
				$data = array(
			                  "nombre"					=>$this->input->post('nombre'),
			                  "descripcion"				=>$this->input->post('descripcion'),
			                  "unidad"					=>$this->input->post('unidad'),
			                  "presentacion"			=>$this->input->post('presentacion'),
			                  "cantidad_x_presentacion"	=>$this->input->post('cantidad_x_presentacion'),
			                  "precio_costo"			=>$this->input->post('precio_costo'),
			                  "precio_venta"			=>$this->input->post('precio_venta'),
			                  "tipo"					=>"MP",
			                  "familia_id"				=>$this->input->post('familia')
								);
				$this->Producto_model->createProducto($data);
			}
			redirect(base_url().'producto','refresh');
		}
	}
}
?>