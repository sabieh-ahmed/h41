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
class Topic extends \G2\L\Model {
	var $tablename = '#__forums2_topics';
	
	public function validate($data = array(), $new = false, $list = []){
		$return = $this->validations([
			'title' => ['required', rl('Topic title is required.')],
			'forum_id' => ['required', rl('Topic forum is required.')],
		], $data, $list);
		return $return;
	}
	
	public function beforeInsert($data, $settings){
		$data = parent::beforeInsert($data, $settings);
		
		$data['created'] = empty($data['created']) ? date('Y-m-d H:i:s', time()) : $data['created'];
		$data['user_id'] = empty($data['user_id']) ? \GApp::user()->get('id') : $data['user_id'];
		$data['unique_id'] = \G2\L\Str::uuid();
		$data['post_count'] = empty($data['post_count']) ? 1 : $data['post_count'];
		
		$data['title'] = strip_tags($data['title']);
		
		return $data;
	}
	
	public function beforeUpdate($data, $settings){
		$data = parent::beforeUpdate($data, $settings);
		
		if(isset($data['title'])){
			$data['title'] = strip_tags($data['title']);
			$data['modified'] = date('Y-m-d H:i:s', time());
			$data['alias'] = \G2\L\Str::slug($data['title']);
		}
		
		return $data;
	}
	
	function updateLastPost($topic_id, $post_id = null){
		if(empty($post_id)){
			$Post = new \G2\A\E\Chronoforums\M\Post();
			$lastpost = $Post
			->where('Post.topic_id', $topic_id)
			->order(['Post.created' => 'desc'])
			->fields(['Post.id', 'Post.created'])
			->select('first');
			
			$post_id = $lastpost['Post']['id'];
			
			unset($Post);
		}
		$this->where('id', $topic_id)->update(['last_post' => $post_id]);
	}
	
	public function track($topic, $period){
		$user = \GApp::user();
		$TopicTrack = new \G2\A\E\Chronoforums\M\TopicTrack();
		$track_time_limit = time() - (int)$period * 24 * 60 * 60;
		if(strtotime($topic['created']) > $track_time_limit){
			$read = $TopicTrack->where('user_id', $user->get('id'))->where('topic_id', (int)$topic['id'])->select('first');
			if(empty($read)){
				$TopicTrack->insert(['topic_id' => (int)$topic['id']]);
			}else{
				$TopicTrack->where('user_id', $user->get('id'))->where('topic_id', (int)$topic['id'])->update();
			}
		}
		//delete old tracked topics
		$TopicTrack->where('last_visit', date('Y-m-d H:i:s', $track_time_limit), '<')->delete();
	}
	
	function remove($id, $sign = '='){
		if(empty($id)){
			return ['error' => rl('Missing Topic ID.')];
		}
		
		$Attachment = new \G2\A\E\Chronoforums\M\Attachment();
		$attachments = $Attachment
		->belongsTo('\G2\A\E\Chronoforums\M\Post', 'Post', 'post_id', ['belongsTo' => [['\G2\A\E\Chronoforums\M\Topic', 'Topic', 'topic_id']]])
		->where('Topic.id', $id, $sign)
		->fields(['Attachment.id', 'Attachment.vfilename'])
		->select('all');
		
		$result = $this
		->fields(['Topic.*', 'Post.*', 'Attachment.*', 'Report.*', 'TopicTag.*', 'Featured.*', 'Favorite.*', 'TopicSubscriber.*', 'Vote.*', 'Answer.*'])
		->hasOne('\G2\A\E\Chronoforums\M\Post', 'Post', 'topic_id', ['hasOne' => [
			['\G2\A\E\Chronoforums\M\Attachment', 'Attachment', 'post_id'], 
			['\G2\A\E\Chronoforums\M\Report', 'Report', 'post_id'],
			['\G2\A\E\Chronoforums\M\Vote', 'Vote', 'post_id'],
			['\G2\A\E\Chronoforums\M\Answer', 'Answer', 'post_id'],
		]])
		->hasOne('\G2\A\E\Chronoforums\M\TopicTag', 'TopicTag', 'topic_id')
		->hasOne('\G2\A\E\Chronoforums\M\Featured', 'Featured', 'topic_id')
		->hasOne('\G2\A\E\Chronoforums\M\Favorite', 'Favorite', 'topic_id')
		->hasOne('\G2\A\E\Chronoforums\M\TopicSubscriber', 'TopicSubscriber', [['Topic.id', 'TopicSubscriber.topic_id', '=', 'field']])
		->where('Topic.id', $id, $sign)
		->delete();
		
		if($result !== false){
			$Attachment->removeFiles($attachments);
			unset($Attachment);
			
			return true;
		}else{
			return ['error' => rl('Error deleting topic.')];
		}
	}
	
	function publish($id, $value){
		if(empty($id)){
			return ['error' => rl('Missing ID.')];
		}
		
		if(strlen(trim($value)) == 0){
			return ['error' => rl('Topic publish data missing.')];
		}
		
		$result = $this->where('id', $id)->update(['published' => (int)$value]);
		
		if($result === false){
			return ['error' => rl('Update error.')];
		}else{
			return true;
		}
	}
	
	function lock($id, $value){
		if(empty($id)){
			return ['error' => rl('Missing ID.')];
		}
		
		if(strlen(trim($value)) == 0){
			return ['error' => rl('Topic lock data missing.')];
		}
		
		$result = $this->where('id', $id)->update(['locked' => (int)$value]);
		
		if($result === false){
			return ['error' => rl('Update error.')];
		}else{
			return true;
		}
	}
	
	function store($data, $text, $attachments = []){
		if(empty($data)){
			return ['error' => rl('Error saving topic.')];
		}
		
		if($text !== false){
			$Post = new \G2\A\E\Chronoforums\M\Post();
			$validation = $Post->validate(['text' => $text], true, ['text']);
			if($validation !== true){
				return ['error' => array_shift($Post->errors)];
			}
		}
		
		$result = $this->save($data, ['validate' => true, 'alias' => ['title' => 'alias']]);
		
		if($result === false){
			return ['error' => array_shift($this->errors)];
		}else{
			if($text === false){
				return true;
			}
			
			$post_data = [];
			$post_data['text'] = $text;
			$post_data['topic_id'] = $this->id;
			$post_data['published'] = 1;
			
			$result = $Post->store($post_data, $attachments);
			
			if($result !== true){
				return $result;
			}
			
			$this->post_id = $Post->id;
			
			return true;
		}
	}
	
	function isFavorite($user_id){
		$this->hasOne('\G2\A\E\Chronoforums\M\Favorite', 'Favorite', 'topic_id');
		$this->where('Favorite.topic_id', true);
		$this->where('Favorite.user_id', $user_id);
	}
	
	function isFeatured(){
		$this->hasOne('\G2\A\E\Chronoforums\M\Featured', 'Featured', 'topic_id');
		$this->where('Featured.topic_id', true);
	}
	
	function isAfter($lastActive){
		$this->belongsTo('\G2\A\E\Chronoforums\M\Post', 'ActivePost', 'last_post');
		$this->where('ActivePost.created', $lastActive, '>=');
	}
	
	function isUnpublished(){
		$Post = new \G2\A\E\Chronoforums\M\Post();
		$posts_sql = $Post
		->fields(['Post.id', 'Post.topic_id', 'Post.published'])
		->group(['Post.topic_id'])
		->where('Post.published', 0)
		->returnQuery('select');
		
		$this->join($posts_sql, 'PostUnpublished', [['PostUnpublished.Post.topic_id', 'Topic.id', '=', 'field']]);
		$this->where('(');
		$this->where('PostUnpublished.Post.published', 0);
		$this->where('OR');
		$this->where('Topic.published', 0);
		$this->where(')');
	}
	
	function isTagged($tag_id){
		$this->hasOne('\G2\A\E\Chronoforums\M\TopicTag', 'f_TopicTag', 'topic_id', ['belongsTo' => [['\G2\A\E\Chronoforums\M\Tag', 'f_Tag', 'tag_id']]]);
		$this->where('f_Tag.alias', trim($tag_id));
	}
	
	function hasKeywords($keywords){
		if(empty($keywords)){
			return $this;
		}
		
		$Post = new \G2\A\E\Chronoforums\M\Post();
		$posts_sql = $Post
		->fields(['Post.id', 'Post.topic_id'])
		->search('Post.text', $keywords, 'Post.relevance')
		->group(['Post.topic_id'])
		->returnQuery('select');
		
		$this->join($posts_sql, 'PostSearch', [['PostSearch.Post.topic_id', 'Topic.id', '=', 'field']]);
		$this->where('(');
		$this->where('PostSearch.Post.relevance', 0, '>');
		$this->where('OR');
		$this->search('Topic.title', $keywords, 'Topic.relevance', false);
		$this->where(')');
		
		$this->order(['Topic.relevance' => 'desc']);
		
		$this->order(['PostSearch.Post.relevance' => 'desc']);
		unset($Post);
	}
	
	function withAnswer(){
		//get answered post
		$Post = new \G2\A\E\Chronoforums\M\Post();
		$answers_sql = $Post->hasOne('\G2\A\E\Chronoforums\M\Answer', 'Answer', 'post_id')
		->fields(['Answer.post_id', 'Post.topic_id'])
		->group(['Answer.post_id'])
		->returnQuery('select');
		
		$this->join($answers_sql, 'AnsweredPost', [['AnsweredPost.Post.topic_id', 'Topic.id', '=', 'field']]);
		$this->fields([$this->returnStatement('({field1})', ['AnsweredPost.Answer.post_id']) => 'Topic.answered']);
		unset($Post);
	}
	
	function withVotesCount(){
		$this->hasMany('\G2\A\E\Chronoforums\M\Post', 'PostsVotes', 'topic_id', ['single' => true], true)
		->hasOne('\G2\A\E\Chronoforums\M\Vote', 'Votes', 'post_id')
		->fields(['PostsVotes.topic_id', 'SUM(Votes.vote)' => 'Votes.count'])
		->group(['PostsVotes.topic_id']);
	}
	
	function withTopicTrack(){
		$this->hasOne('\G2\A\E\Chronoforums\M\TopicTrack', 'TopicTrack', [['TopicTrack.topic_id', 'Topic.id', '=', 'field'], 'AND', ['TopicTrack.user_id', \GApp::user()->get('id'), '=']]);
		$this->fields(['TopicTrack.*']);
	}
	
	function withReport(){
		$Post = new \G2\A\E\Chronoforums\M\Post();
		$reports_sql = $Post->hasOne('\G2\A\E\Chronoforums\M\Report', 'Report', 'post_id')
		->fields(['Post.topic_id', 'COUNT(Report.id)' => 'Report.count'])
		->group(['Post.topic_id'])
		->returnQuery('select');
		//pr($reports_sql);
		$this->join($reports_sql, 'TopicReports', [['TopicReports.Post.topic_id', 'Topic.id', '=', 'field']]);
		$this->fields([$this->returnStatement('({field1})', ['TopicReports.Report.count']) => 'Topic.ReportsCount']);
		unset($Post);
	}
	
	function withTags(){
		$this->fields(['Tag.*', 'TopicTag.*'])->hasMany('\G2\A\E\Chronoforums\M\TopicTag', 'TopicTag', 'topic_id', ['belongsTo' => [['\G2\A\E\Chronoforums\M\Tag', 'Tag', 'tag_id']]], true)
		->settings(['json' => ['Tag.params']]);
		
		$TopicTag = new \G2\A\E\Chronoforums\M\TopicTag();
		$tags_sql = $TopicTag->belongsTo('\G2\A\E\Chronoforums\M\Tag', 'Tag', 'tag_id')
		->fields(['TopicTag.*', 'Tag.*', 'MAX(Tag.ordering)' => 'TopicTag.MaxOrdering'])
		->group(['TopicTag.topic_id'])
		->returnQuery('select');
		
		$this->join($tags_sql, 'TagSub', [['TagSub.TopicTag.topic_id', 'Topic.id', '=', 'field']]);
		
		$this->order(['Topic.TagOrdering' => 'desc']);
		$this->fields([$this->returnStatement('(CAST((CASE WHEN {field1} IS NULL THEN {value1} ELSE {field1} END) AS UNSIGNED))', ['TagSub.TopicTag.MaxOrdering'], [0]) => 'Topic.TagOrdering']);
		
		unset($TopicTag);
	}
}