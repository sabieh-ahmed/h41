<?php
/**
* ChronoCMS version 1.0
* Copyright (c) 2012 ChronoCMS.com, All rights reserved.
* Author: (ChronoCMS.com Team)
* license: Please read LICENSE.txt
* Visit http://www.ChronoCMS.com for regular updates and information.
**/
namespace G2\L;
/*** FILE_DIRECT_ACCESS_HEADER ***/
defined("GCORE_SITE") or die;
class Helper {
	var $vars = array();
	var $data = array();
	
	function __construct(&$view = null){
		$this->vars = &$view->vars;
		$this->data = &$view->data;
	}

	function initialize(){
		
	}
	
	public function get($var, $default = null){
		$value = Arr::getVal($this->vars, $var, $default);
		
		return $value;
	}
	
	public function set($var, $value){
		$this->vars = Arr::setVal($this->vars, $var, $value);
	}
	
	function data($key, $default = null){
		$value = Arr::getVal($this->data, explode('.', $key), $default);
		
		return $value;
	}
}