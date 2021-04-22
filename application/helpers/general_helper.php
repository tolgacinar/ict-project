<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists("convertEng")) {
	
	function convertEng($text) {
		$search = array('Ç','ç','Ğ','ğ','ı','İ','Ö','ö','Ş','ş','Ü','ü');
		$replace = array('c','c','g','g','i','i','o','o','s','s','u','u');

		return str_replace($search, $replace, $text);
	}
}

if (!function_exists("cmp")) {
	
	function cmp($a, $b) {
		if ($a->fill == $b->fill) {
			return 0;
		}
		return ($a->fill < $b->fill) ? -1 : 1;
	}
}