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
class TopicSubscriber extends \G2\L\Model {
	var $tablename = '#__forums2_topics_subscribers';
	
	public function beforeInsert($data, $settings){
		$data = parent::beforeInsert($data, $settings);
		
		$data['created'] = date('Y-m-d H:i:s', time());
		
		if(!isset($data['user_id'])){
			$data['user_id'] = \GApp::user()->get('id');
		}
		
		return $data;
	}
	
	function subscribe($id, $user_id = 0){
		if(empty($id)){
			return ['error' => rl('Missing ID')];
		}
		
		if(empty($user_id)){
			$user_id = \GApp::user()->get('id');
		}
		
		if(empty($user_id)){
			return ['error' => rl('You must be logged in to subscribe.')];
		}
		
		$found = $this->where('topic_id', $id)->where('user_id', $user_id)->select('first');
		
		if(empty($found)){
			$result = $this->insert(['topic_id' => $id, 'user_id' => $user_id]);
			
			if($result === false){
				return ['error' => rl('Update error.')];
			}else{
				return true;
			}
		}else{
			return true;
		}
	}
	
	function unsubscribe($id){
		if(empty($id)){
			return ['error' => rl('Missing ID')];
		}
		
		if(!\GApp::user()->get('id')){
			return ['error' => rl('You must be logged in to subscribe.')];
		}
		
		$result = $this->where('topic_id', $id)->where('user_id',  \GApp::user()->get('id'))->delete();
		
		if($result === false){
			return ['error' => rl('Update error.')];
		}else{
			return true;
		}
	}
	
	function getSubscribers($id){
		if(empty($id)){
			return ['error' => rl('Missing ID')];
		}
		
		$subscribers = $this->where('topic_id', $id)->where('user_id',  \GApp::user()->get('id'), '<>')->where('notified', 0)->select('all');
		if(!empty($subscribers)){
			$users_ids = \G2\L\Arr::getVal($subscribers, ['[n]', $this->alias, 'user_id']);
			
			return $users_ids;
		}
		return [];
	}
	
	function notified($id){
		if(empty($id)){
			return ['error' => rl('Missing ID')];
		}
		
		if(!\GApp::user()->get('id')){
			return ['error' => rl('You must be logged in to subscribe to topics.')];
		}
		
		$result = $this->where('topic_id', $id)->where('user_id',  \GApp::user()->get('id'), '<>')->update(['notified' => 1]);
		
		if($result === false){
			return ['error' => rl('Update error.')];
		}else{
			return true;
		}
	}
	
	function unNotified($id){
		if(empty($id)){
			return ['error' => rl('Missing ID')];
		}
		
		if(!\GApp::user()->get('id')){
			return ['error' => rl('You must be logged in to subscribe to topics.')];
		}
		
		$result = $this->where('topic_id', $id)->where('user_id',  \GApp::user()->get('id'))->update(['notified' => 0]);
		
		if($result === false){
			return ['error' => rl('Update error.')];
		}else{
			return true;
		}
	}
}