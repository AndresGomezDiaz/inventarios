<?php if (!defined('BASEPATH')){ exit('No direct script access allowed'); }

if(!function_exists('validaRFC')){
	function validarRFC($rfc)
		$regex = '/^[A-Z]{4}([0-9]{2})(1[0-2]|0[1-9])([0-3][0-9])([ -]?)([A-Z0-9]{4})$/';
		return preg_match($regex, $rfc);
	}
}