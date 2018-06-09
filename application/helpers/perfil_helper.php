<?php if (!defined('BASEPATH')){ exit('No direct script access allowed'); }

if(!function_exists('listaPerfiles')){
	function listaPerfiles(){
		$perfil = array("1" => "Administrador", "2" => "Vendedor");
		return $perfil;
	}
}





