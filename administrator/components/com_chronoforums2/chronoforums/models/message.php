<?php
/**
* ChronoCMS version 1.0
* Copyright (c) 2012 ChronoCMS.com, All rights reserved.
* Author: (ChronoCMS.com Team)
* license: Please read LICENSE.txt
* Visit http://www.ChronoCMS.com for regular updates and information.
**/
namespace G2\A\E\Chronoforums\M;
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
class Message extends \G2\L\Model {
	var $tablename = '#__pm_messages';
	
	public function validate($data = array(), $new = false, $list = []){
		$return = true;
		
		$return = $this->validations([
			'text' => ['required', rl('Message text is required.')],
		], $data, $list);
		
		return $return;
	}
	
	public function beforeInsert($data, $settings){
		$data = parent::beforeInsert($data, $settings);
		
		$data['created'] = date('Y-m-d H:i:s', time());
		$data['user_id'] = \GApp::user()->get('id');
		$data['remote_address'] = $_SERVER['REMOTE_ADDR'];
		
		return $data;
	}
}