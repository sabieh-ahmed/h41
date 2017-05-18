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
class Post extends \G2\L\Model {
	var $tablename = '#__forums2_posts';
	
	public function validate($data = array(), $new = false, $list = []){
		$list = !empty($list) ? $list : ($new ? [] : ['text']);
		$return = $this->validations([
			'text' => ['required', rl('Post text is required.')],
			'topic_id' => ['required', rl('Post topic id is required.')],
		], $data, $list);
		return $return;
	}
	
	public function beforeInsert($data, $settings){
		$data = parent::beforeInsert($data, $settings);
		
		if(!isset($data['created'])){
			$data['created'] = date('Y-m-d H:i:s', time());
		}
		
		if(!isset($data['user_id'])){
			$data['user_id'] = \GApp::user()->get('id');
		}
		
		return $data;
	}
	
	public function beforeUpdate($data, $settings){
		$data = parent::beforeUpdate($data, $settings);
		
		if(isset($data['text'])){
			$data['modified'] = date('Y-m-d H:i:s', time());
		}
		
		return $data;
	}
	
	function store($data, $attachments = []){
		if(empty($data)){
			return ['error' => rl('Error saving post.')];
		}
		
		$result = $this->save($data, ['validate' => true]);
		
		if($result === false){
			return ['error' => array_shift($this->errors)];
		}else{
			
			if(!empty($attachments)){
				$attachments = \G2\L\Arr::rearrange($attachments);
				
				$Attachment = new \G2\A\E\Chronoforums\M\Attachment();
				foreach($attachments as $k => $value){
					$attachments[$k]['post_id'] = $this->id;
					$Attachment->save($attachments[$k], ['validate' => true]);
				}
			}
			
			return true;
		}
	}
	
	function publish($id, $value){
		if(empty($id)){
			return ['error' => rl('Missing ID.')];
		}
		
		if(strlen(trim($value)) == 0){
			return ['error' => rl('Post publish data missing.')];
		}
		
		$result = $this->where('id', $id)->update(['published' => (int)$value]);
		
		if($result === false){
			return ['error' => rl('Update error.')];
		}else{
			return true;
		}
	}
	
	function remove($id, $sign = '='){
		if(empty($id)){
			return ['error' => rl('Missing ID.')];
		}
		
		$Attachment = new \G2\A\E\Chronoforums\M\Attachment();
		$attachments = $Attachment->where('post_id', $id, $sign)->fields(['id', 'vfilename'])->select('all');
		
		$result = $this
		->fields(['Post.*', 'Attachment.*', 'Report.*', 'Vote.*', 'Answer.*'])
		->hasOne('\G2\A\E\Chronoforums\M\Attachment', 'Attachment', 'post_id')
		->hasOne('\G2\A\E\Chronoforums\M\Report', 'Report', 'post_id')
		->hasOne('\G2\A\E\Chronoforums\M\Vote', 'Vote', 'post_id')
		->hasOne('\G2\A\E\Chronoforums\M\Answer', 'Answer', 'post_id')
		->where('Post.id', $id, $sign)
		->delete();
		
		if($result !== false){
			//remove attachments files
			$Attachment->removeFiles($attachments);
			unset($Attachment);
			
			return true;
		}else{
			return ['error' => rl('Error deleting post.')];
		}
	}
	
	function prepare(){
		$this
		->fields([
			'Post.*', 
			'Topic.id', 'Topic.user_id', 'Topic.forum_id', 'Topic.locked', 
			'Author.id', 'Author.name', 'Author.username', 
			'AuthorProfile.*', 
			'Attachment.*', 
			'Report.*', 
			'ReportAuthor.id', 'ReportAuthor.username', 'ReportAuthor.name', 
			'Answer.*', 
			//'SUM(VoteCounter.vote)' => 'Post.VotesCount', 
			'Vote.*'
		])
		->belongsTo('\G2\A\M\User', 'Author', 'user_id', ['hasOne' => [['\G2\A\E\Chronoforums\M\Profile', 'AuthorProfile', 'user_id']]])
		->belongsTo('\G2\A\E\Chronoforums\M\Topic', 'Topic', 'topic_id')
		->hasMany('\G2\A\E\Chronoforums\M\Attachment', 'Attachment', 'post_id')
		->hasOne('\G2\A\E\Chronoforums\M\Answer', 'Answer', 'post_id')
		->hasOne('\G2\A\E\Chronoforums\M\Vote', 'Vote', [['Post.id', 'Vote.post_id', '=', 'field'], 'AND',['Vote.user_id', \GApp::user()->get('id'), '=']])
		//->hasMany('\G2\A\E\Chronoforums\M\Vote', 'VoteCounter', 'post_id')
		->group(['Post.id']);
		
		$this->hasMany('\G2\A\E\Chronoforums\M\Vote', 'VoteCounter', 'post_id', [], true)->fields(['VoteCounter.post_id', 'SUM(VoteCounter.vote)' => 'Post.VotesCount'])->group(['VoteCounter.post_id']);
		//if(\GApp::access('chronoforums', 'reports_view') === true){
			$this->hasMany('\G2\A\E\Chronoforums\M\Report', 'Report', 'post_id', ['belongsTo' => [['\G2\A\M\User', 'ReportAuthor', 'user_id']]]);
		//}
		
		return $this;
	}
}