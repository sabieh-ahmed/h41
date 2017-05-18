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
class TopicTrack extends \G2\L\Model {
	var $tablename = '#__forums2_topics_track';
	
	public function beforeInsert($data, $settings){
		$data = parent::beforeInsert($data, $settings);
		
		$data['last_visit'] = date('Y-m-d H:i:s', time());
		$data['user_id'] = \GApp::user()->get('id');
		
		return $data;
	}
	
	public function beforeUpdate($data, $settings){
		$data = parent::beforeUpdate($data, $settings);
		
		$data['last_visit'] = date('Y-m-d H:i:s', time());
		
		return $data;
	}
}