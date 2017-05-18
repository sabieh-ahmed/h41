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
class Forum extends \G2\L\Model {
	var $tablename = '#__forums2_forums';
	
	public function validate($data = array(), $new = false, $list = []){
		$return = true;
		
		$return = $this->validations([
			'title' => ['required', rl('Forum title is required.')], 
		], $data, $list);
		
		return $return;
	}
	
	public function beforeInsert($data, $settings){
		$data = parent::beforeInsert($data, $settings);
		
		$data = $this->setPath($data);
		
		return $data;
	}
	
	public function beforeUpdate($data, $settings){
		$data = parent::beforeUpdate($data, $settings);
		
		$data = $this->setPath($data);
		$this->updateLeaves($data, 'before');
		
		return $data;
	}
	
	public function afterUpdate($data, $settings){
		$this->updateLeaves($data, 'after');
	}
	
	private function setPath($data){
		$Forum = new \G2\A\E\Chronoforums\M\Forum();
		if(isset($data['parent_id'])){
			if(!empty($data['parent_id'])){
				$parent = $Forum->where('id', $data['parent_id'])->select('first');
			}else{
				$parent['Forum'] = ['id' => 0, 'path' => ''];
			}
			$data['path'] = $parent['Forum']['path'].(!empty($parent['Forum']['path']) ? '' : '.').$parent['Forum']['id'].'.';
		}
		unset($Forum);
		
		return $data;
	}
	
	private function updateLeaves($data, $event){
		if(isset($data['parent_id'])){
			$Forum = new \G2\A\E\Chronoforums\M\Forum();
			
			if($event == 'before'){
				$children = $Forum->where('parent_id', $data['id'])->select('first');
				$forum = $Forum->where('id', $data['id'])->select('first');
				if(!empty($children) AND ($forum['Forum']['parent_id'] != $data['parent_id'])){
					$this->old_path = $forum['Forum']['path'];
				}
			}else if($event == 'after' AND !empty($this->old_path)){
				$leafs = $Forum->where('path', $this->old_path.$data['id'].'.%', 'LIKE')->select('all');
				foreach($leafs as $leaf){
					$newPath = str_replace($this->old_path.$data['id'].'.', $data['path'].$data['id'].'.', $leaf['Forum']['path']);
					$Forum->where('id', $leaf['Forum']['id'])->update(['path' => $newPath]);
				}
			}
			
			unset($Forum);
		}
	}
	
	
	function updateLastPost($forum_id, $post_id = null){
		if(empty($post_id)){
			$Topic = new \G2\A\E\Chronoforums\M\Topic();
			$lasttopic = $Topic
			->where('Topic.forum_id', $forum_id)
			->belongsTo('\G2\A\E\Chronoforums\M\Post', 'LastPost', 'last_post')
			->order(['LastPost.created' => 'desc'])
			->fields(['Topic.id', 'Topic.last_post', 'LastPost.created'])
			->select('first');
			
			$post_id = $lasttopic['Topic']['last_post'];
			
			unset($Post);
		}
		$this->where('id', $forum_id)->update(['last_post' => $post_id]);
	}
}