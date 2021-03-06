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
class Answer extends \G2\L\Model {
	var $tablename = '#__forums2_posts_answers';
	
	public function beforeInsert($data, $settings){
		$data = parent::beforeInsert($data, $settings);
		
		$data['created'] = date('Y-m-d H:i:s', time());
		$data['user_id'] = \GApp::user()->get('id');
		
		return $data;
	}
	
	function add($id){
		if(empty($id)){
			return ['error' => rl('Missing ID')];
		}
		
		if(!\GApp::user()->get('id')){
			return ['error' => rl('You must be logged in to select answers.')];
		}
		
		$found = $this->where('post_id', $id)->select('first');
		
		if(empty($found)){
			$result = $this->insert(['post_id' => $id, 'user_id' => \GApp::user()->get('id')]);
			
			if($result === false){
				return ['error' => rl('Update error.')];
			}else{
				return true;
			}
		}else{
			return true;
		}
	}
	
	function remove($id){
		if(empty($id)){
			return ['error' => rl('Missing ID')];
		}
		
		if(!\GApp::user()->get('id')){
			return ['error' => rl('You must be logged in to select answers.')];
		}
		
		$result = $this->where('post_id', $id)->delete();
		
		if($result === false){
			return ['error' => rl('Update error.')];
		}else{
			return true;
		}
	}
}