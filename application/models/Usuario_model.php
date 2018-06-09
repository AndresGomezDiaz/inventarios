<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario_model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}
	
	public function validaUsuario($usuario = NULL){
		//CON ESTA FUNCION VAMOS A VER SI ES UN EMPLEADO O UN VENDEDOR
		if(isset($usuario)){
			$data = array('correo' => $usuario);
			$this->db->where($data);
			$query = $this->db->get('usuario');
			if($query->num_rows() == 1){
				return "1";
			}else{
				//si no es un admin vemos si es un empleado:
				$this->db->select("a.id_empleado");
				$this->db->from("empleado a");
				$this->db->join("usuario b", "a.id_usuario = b.id_usuario", "INNER");
				$this->db->where(array("a.correo" => $usuario));
				$query1 = $this->db->get();
				if($query1->num_rows() == 0){
					//si no existe devolvemos un cero:
					return "0";
				}else{
					return "2";
				}
			}
		}
	}

	public function usuarios($filtro = NULL){
		if(isset($filtro)){
			$this->db->where($filtro);
		}
		$query = $this->db->get('usuario');
		return $query;
	}

	public function vendedores(){
		$data = array("perfil"=>2);
		$query = $this->usuarios($data);
		return $query;
	}

	public function infoUsuario($id = NULL){
		$data = array("id_usuario"=>$id);
		$query = $this->usuarios($data);
		return $query->row(0);
	}

	public function altaUsuario($data = NULL){
		if(isset($data)){
			$this->db->insert('usuario', $data);
			return true;
		}else{
			return false;
		}
	}

	public function editaUsuario($id = NULL, $data = NULL){
		if(isset($id)){
			$this->db->where('id_usuario',$id);
			$this->db->update('usuario',$data);
			return true;
		}else{
			return false;
		}
	}

	public function borraUsuario($id = NULL){
		if(isset($id)){
			$this->db->where('id_usuario', $id);
			$this->db->delete('usuario');
			return true;
		}else{
			return false;
		}
	}

	public function ventasUsuario($fecha = NULL, $usuario = NULL){
		$ventas = 0;
		//primero vemos cuantas venta directas tiene el vendedor:
		$sql = "SELECT COUNT(id_numero) as ventas 
				FROM numero 
				WHERE tipo_usuario_activacion = 1 
				AND usuario_activacion = '".$usuario."'";
		if(isset($fecha)){
			$sql .= " AND date(fecha_activacion) = '".$fecha."'";
		}
		$query = $this->db->query($sql);
		$info = $query->row(0);
		$ventas += $info->ventas;
		//ahora vemos las de sus vendedores:
		$sql = "SELECT COUNT(id_numero) as ventas 
				FROM numero 
				WHERE tipo_usuario_activacion = 2
				AND usuario_activacion IN (SELECT id_empleado FROM empleado WHERE id_usuario = '".$usuario."')";
		if(isset($fecha)){
			$sql .= " AND date(fecha_activacion) = '".$fecha."'";
		}
		$query = $this->db->query($sql);
		$info = $query->row(0);
		$ventas += $info->ventas;

		return $ventas;
	}

	public function validaNumero($celular){
		//CON ESTA FUNCION VAMOS A VER SI EL NUMERO CELULAR YA EXISTE
		if(isset($celular)){
			$data = array('telefono' => $celular);
			$this->db->where($data);
			$query = $this->db->get('usuario');
			if($query->num_rows() == 1){
				return "1";
			}else{
				//validamos que no esté en empleados
				$data = array('telefono' => $celular);
				$this->db->where($data);
				$query1 = $this->db->get('empleado');
				if($query1->num_rows() == 0){
					//si no existe devolvemos un cero:
					return "0";
				}else{
					return "1";
				}
			}
		}
	}

}