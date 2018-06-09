<?php
class Template {
	//ci instance
	private $CI;
	//template Data
	var $template_data = array();
	public function __construct(){
		$this->CI =& get_instance();
	}
	function set($content_area, $value){
		$this->template_data[$content_area] = $value;
	}
	function load($template = '', $name ='', $view = '' , $view_data = array(), $return = FALSE){
		$this->set($name , $this->CI->load->view($view, $view_data, TRUE));
		$this->CI->load->view('layout/'.$template, $this->template_data);
	}
	function add_js($js=array()){
		$carga = "";
		for ($i=0; $i < count($js) ; $i++) {
			if($js[$i] != ""){
				//vemos si es una url
				if(strpos($js[$i], "http://") !== FALSE){
					$carga .= '<script type="text/javascript" src="'.$js[$i].'"></script>';
				}else{
					$carga .= '<script type="text/javascript">'.$js[$i].'</script>';
				}
			}
		}
		$this->set('scriptsJs',$carga);
	}
	function add_css($css=array()){
		$carga = "";
		for ($i=0; $i < count($css) ; $i++) {
			if($css[$i] != ""){
				$carga .= '<link rel="stylesheet" href="'.$css[$i].'">';
			}
		}
		$this->set('css_adicional',$carga);
	}
}
?>