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
class Vote extends \G2\L\Model {
	var $tablename = '#__forums2_posts_votes';
	
	public function beforeInsert($data, $settings){
		$data = parent::beforeInsert($data, $settings);
		
		$data['created'] = date('Y-m-d H:i:s', time());
		$data['user_id'] = \GApp::user()->get('id');
		
		return $data;
	}
	
	public function vote($id, $vote){
		if(empty($id)){
			return ['error' => rl('Missing ID')];
		}
		
		if(empty($vote)){
			return ['error' => rl('Vote data is missing.')];
		}
		
		$found = false;
		
		if(\GApp::user()->get('id')){
			$found = $this->where('post_id', $id)->where('user_id', \GApp::user()->get('id'))->select('first');
		}
		
		if(empty($found) AND in_array((int)$vote, [1, -1])){
			$result = $this->insert(['post_id' => $id, 'user_id' => \GApp::user()->get('id'), 'vote' => $vote]);
			
			if($result === false){
				return ['error' => rl('Update error.')];
			}else{
				return true;
			}
		}else{
			return ['error' => rl('Invalid vote value.')];
		}
	}
	
	function unvote($id){
		if(empty($id)){
			return ['error' => rl('Missing ID')];
		}
		
		$result = $this->where('post_id', $id)->where('user_id',  \GApp::user()->get('id'))->delete();
		
		if($result === false){
			return ['error' => rl('Update error.')];
		}else{
			return true;
		}
	}
}