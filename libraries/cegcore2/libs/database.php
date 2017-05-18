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
class Database {
	
	private static function _setOptions($options = array()){
		if(empty($options)){
			$options['user'] = Config::get('db.user');
			$options['pass'] = Config::get('db.pass');
			$options['name'] = Config::get('db.name');
			$options['host'] = Config::get('db.host');
			$options['type'] = Config::get('db.type');
			$options['prefix'] = Config::get('db.prefix');
		}
		return $options;
	}
	
	public static function getInstance($options = array()){
		static $instances;
		if(!isset($instances)){
			$instances = array();
		}
		$options = self::_setOptions($options);
		
		ksort($options);
		$id = md5(serialize($options));
		if(empty($instances[$id])){
			$instances[$id] = \G2\L\DatabaseObject::getInstance($options);
			if(!empty($instances[$id])){
				$instances[$id]->connected = true;
				//$instances[$id]->_initialize($options);
			}
			return $instances[$id];
		}else{
			return $instances[$id];
		}
	}
}