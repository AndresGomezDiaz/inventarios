<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Numero_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function numeros($filtro = NULL){
		if(isset($filtro)){
			$this->db->where($filtro);
		}
		$query = $this->db->get('numero');
		return $query;
	}

	public function infoNumero($id = NULL){
		$data = array("id_numero"=>$id);
		$query = $this->numeros($data);
		return $query;
	}

	public function numeroAlta($data = NULL){
		if(isset($data)){
			//validamos que no exista el numero:
			$validacion = $this->numeros(array("numero" => $data['numero']));
			if($validacion->num_rows() == 0){
				$this->db->insert('numero', $data);
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	public function editaNumero($data = NULL, $id = NULL){
		if(isset($id)){
			$this->db->where('id_numero',$id);
			$this->db->update('numero',$data);
			return true;
		}else{
			return false;
		}
	}

	public function borraNumero($id = NULL){
		if(isset($id)){
			$this->db->where('id_numero', $id);
			$this->db->delete('numero');
			return true;
		}else{
			return false;
		}
	}

	public function ejecutaArchivoPy($monto, $telefono){
		$result = exec('/home/activachips/mypython/bin/python '.APPPATH.'models/sudsHit.py '.$monto.' '.$telefono, $salida);
		//$respuesta = new SimpleXMLElement($salida[0]);
		return $salida[0];
	}

	//funcion para ver el vendedor que mas ha vedido:
	public function top5Ventas($tiempo = NULL){
		$sql = "SELECT usuario_activacion, COUNT(id_numero)
				FROM numero
				WHERE estatus = 2";
		if(isset($tiempo)){
			if($tiempo == "semana"){
				$sql .= " AND WEEK(fecha_activacion) = WEEK(CURDATE())";
			}elseif($tiempo == "mes"){
				$sql .= " AND MONTH(fecha_activacion) = MONTH(CURDATE()) AND YEAR(fecha_activacion) = YEAR(CURDATE())";
			}elseif($tiempo == "anio"){
				$sql .= " AND YEAR(fecha_activacion) = YEAR(CURDATE())";
			}else{
				$sql .= " AND DATE(fecha_activacion) = CURDATE()";
			}
		}
		$sql .= " GROUP BY usuario_activacion ORDER BY COUNT(usuario_activacion) LIMIT 0,5;";
		$result = $this->db->query($sql);
		return $result;
	}

	//funciones para estadistica:
	public function numeroActivaciones($tiempo = NULL){
		$sql = "SELECT COUNT(numero) AS cantidad
				FROM numero
				WHERE estatus = 2";
		if(isset($tiempo)){
			if($tiempo == "semana"){
				$sql .= " AND WEEK(fecha_activacion) = WEEK(CURDATE())";
			}elseif($tiempo == "mes"){
				$sql .= " AND MONTH(fecha_activacion) = MONTH(CURDATE()) AND YEAR(fecha_activacion) = YEAR(CURDATE())";
			}elseif($tiempo == "anio"){
				$sql .= " AND YEAR(fecha_activacion) = YEAR(CURDATE())";
			}else{
				$sql .= " AND DATE(fecha_activacion) = CURDATE()";
			}
		}
		$result = $this->db->query($sql);
		$row = $result->row(0);
		return $row->cantidad;
	}

	//monto vendido en un x tiempo
	public function montoActivaciones($tiempo = NULL){
		$sql = "SELECT (CASE WHEN SUM(monto_activacion) IS NULL THEN 0 ELSE SUM(monto_activacion) END ) AS total
				FROM numero
				WHERE estatus = 2";
		if(isset($tiempo)){
			if($tiempo == "semana"){
				$sql .= " AND WEEK(fecha_activacion) = WEEK(CURDATE())";
			}elseif($tiempo == "mes"){
				$sql .= " AND MONTH(fecha_activacion) = MONTH(CURDATE()) AND YEAR(fecha_activacion) = YEAR(CURDATE())";
			}elseif($tiempo == "anio"){
				$sql .= " AND YEAR(fecha_activacion) = YEAR(CURDATE())";
			}else{
				$sql .= " AND DATE(fecha_activacion) = CURDATE()";
			}
		}
		$result = $this->db->query($sql);
		if($result->num_rows() == 0){
			return 0;
		}else{
			$row = $result->row(0);
			return $row->total;
		}
	}

	//listado de montos disponibles:
	function listadoMontos(){
		$sql = "SELECT DISTINCT(monto_activacion) as monto FROM numero;";
		$result = $this->db->query($sql);
		return $result;
	}

	//numero de lineas registradas en un cierto tiempo
	function lineasRegistradas($tiempo = NULL){
		$sql = "SELECT COUNT(id_numero) as cantidad
				FROM numero
				WHERE estatus > 0";
		if(isset($tiempo)){
			if($tiempo == "semana"){
				$sql .= " AND WEEK(fecha_registro) = WEEK(CURDATE())";
			}elseif($tiempo == "mes"){
				$sql .= " AND MONTH(fecha_registro) = MONTH(CURDATE()) AND YEAR(fecha_registro) = YEAR(CURDATE())";
			}elseif($tiempo == "anio"){
				$sql .= " AND YEAR(fecha_registro) = YEAR(CURDATE())";
			}else{
				$sql .= " AND DATE(fecha_registro) = CURDATE()";
			}
		}
		$result = $this->db->query($sql);
		$row = $result->row(0);
		return $row->cantidad;
	}

	function lineasSinActivar($tiempo = NULL){
		$sql = "SELECT COUNT(numero) AS cantidad
				FROM numero
				WHERE estatus = 1";
		if(isset($tiempo)){
			if($tiempo == "semana"){
				$sql .= " AND WEEK(fecha_activacion) = WEEK(CURDATE())";
			}elseif($tiempo == "mes"){
				$sql .= " AND MONTH(fecha_activacion) = MONTH(CURDATE()) AND YEAR(fecha_activacion) = YEAR(CURDATE())";
			}elseif($tiempo == "anio"){
				$sql .= " AND YEAR(fecha_activacion) = YEAR(CURDATE())";
			}else{
				$sql .= " AND DATE(fecha_activacion) = CURDATE()";
			}
		}
		$result = $this->db->query($sql);
		$row = $result->row(0);
		return $row->cantidad;
	}

}
