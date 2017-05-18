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
class Discussion extends \G2\L\Model {
	var $tablename = '#__pm_discussions';
	
	public function validate($data = array(), $new = false, $list = []){
		$return = true;
		
		if($new){
			$return = $this->validations([
				'subject' => ['required', rl('Message subject is required.')],
			], $data, $list);
		}
		
		return $return;
	}
	
	
	public function store($data, $new = true){
		$validation = $this->validate($data['Discussion'], $new);
		if($validation !== true){
			return ['error' => array_shift($this->errors)];
		}
		
		$Message = new \G2\A\E\Chronoforums\M\Message();
		
		$validation = $Message->validate($data['Message'], $new);
		if($validation !== true){
			return ['error' => array_shift($Message->errors)];
		}
		
		$DiscussionUser = new \G2\A\E\Chronoforums\M\DiscussionUser();
		
		if(empty($data['DiscussionUser']['recipients'])){
			return ['error' => rl('Message recipients are missing.')];
		}
		
		if(count($data['DiscussionUser']['recipients']) > 3){
			return ['error' => rl('Too many recipients.')];
		}
		
		$result = true;
		
		if($new){
			$data['Discussion']['id'] = time().mt_rand(1000, 9999);
			$result = $this->insert($data['Discussion']);
		}
		
		if($result !== false){
			$data['Message']['discussion_id'] = $data['Discussion']['id'];
			
			$result = $Message->insert($data['Message']);
			
			if($result !== false){
				$this->message_id = $Message->id;
				
				if($new){
					$data['DiscussionUser']['discussion_id'] = $data['Discussion']['id'];
					
					foreach($data['DiscussionUser']['recipients'] as $recipient){
						$data['DiscussionUser']['user_id'] = $recipient;
						$result = $DiscussionUser->insert($data['DiscussionUser']);
					}
					
					if(!in_array(\GApp::user()->get('id'), $data['DiscussionUser']['recipients'])){
						$data['DiscussionUser']['user_id'] = \GApp::user()->get('id');
						$data['DiscussionUser']['last_read'] = date('Y-m-d H:i:s', time());
						$result = $DiscussionUser->insert($data['DiscussionUser']);
					}
				}else{
					$result = $DiscussionUser
					->where('discussion_id', $data['Discussion']['id'])
					->where('user_id', \GApp::user()->get('id'))
					->update(['last_read' => date('Y-m-d H:i:s', time())]);
				}
				
				return true;
			}
		}
		
		return ['error' => rl('Update error.')];
	}
	
	function withFirstMessage(){
		$Message = new \G2\A\E\Chronoforums\M\Message();
		$messages_sql = $Message
		->fields(['Message.discussion_id', 'MIN(Message.created)' => 'Message.first_date'])
		->group(['Message.discussion_id'])
		->returnQuery('select');
		$this->join($messages_sql, 'FirstMessage', [['FirstMessage.Message.discussion_id', 'Discussion.id', '=', 'field']]);
		
		$this->hasOne('\G2\A\E\Chronoforums\M\Message', 'First', [['FirstMessage.Message.first_date', 'First.created', '=', 'field']]);
		$this->belongsTo('\G2\A\M\User', 'FirstAuthor', [['First.user_id', 'FirstAuthor.id', '=', 'field']], ['hasOne' => [['\G2\A\E\Chronoforums\M\Profile', 'FirstAuthorProfile', 'user_id']]]);
		
		$this->fields([
			'FirstMessage.Message.first_date' => 'Discussion.first_date',
			'First.id', 'First.created', 
			'FirstAuthor.id', 'FirstAuthor.name', 'FirstAuthor.username', 
			'FirstAuthorProfile.*', 
		]);
		unset($Message);
	}
	
	function withLastMessage($direction = 'in'){
		$Message = new \G2\A\E\Chronoforums\M\Message();
		if($direction == 'in'){
			$Message->where('Message.user_id', \GApp::user()->get('id'), '<>');
		}else{
			$Message->where('Message.user_id', \GApp::user()->get('id'), '=');
		}
		$messages_sql = $Message
		->fields(['Message.discussion_id', 'MAX(Message.created)' => 'Message.last_date'])
		->group(['Message.discussion_id'])
		->returnQuery('select');
		$this->join($messages_sql, 'LastMessage', [['LastMessage.Message.discussion_id', 'Discussion.id', '=', 'field']]);
		
		$this->hasOne('\G2\A\E\Chronoforums\M\Message', 'Last', [['LastMessage.Message.last_date', 'Last.created', '=', 'field']]);
		$this->belongsTo('\G2\A\M\User', 'LastAuthor', [['Last.user_id', 'LastAuthor.id', '=', 'field']], ['hasOne' => [['\G2\A\E\Chronoforums\M\Profile', 'LastAuthorProfile', 'user_id']]]);
		
		$this->fields([
			'LastMessage.Message.last_date' => 'Discussion.last_date',
			'Last.id', 'Last.created', 
			'LastAuthor.id', 'LastAuthor.name', 'LastAuthor.username', 
			'LastAuthorProfile.*', 
		]);
		unset($Message);
	}
	
	function withMessageCount(){
		$Message = new \G2\A\E\Chronoforums\M\Message();
		$messages_sql = $Message
		->fields(['Message.discussion_id', 'COUNT(Message.id)' => 'Message.count'])
		->group(['Message.discussion_id'])
		->returnQuery('select');
		$this->join($messages_sql, 'CountMessage', [['CountMessage.Message.discussion_id', 'Discussion.id', '=', 'field']]);
		
		$this->fields(['CountMessage.Message.count' => 'Discussion.message_count']);
		unset($Message);
	}
	
	function withReceivedMessageCount(){
		$Message = new \G2\A\E\Chronoforums\M\Message();
		$messages_sql = $Message
		->fields(['Message.discussion_id', 'COUNT(Message.id)' => 'Message.count'])
		->where('Message.user_id', \GApp::user()->get('id'), '<>')
		->group(['Message.discussion_id'])
		->returnQuery('select');
		$this->join($messages_sql, 'ReceivedMessage', [['ReceivedMessage.Message.discussion_id', 'Discussion.id', '=', 'field']]);
		
		$this->fields(['ReceivedMessage.Message.count' => 'Discussion.received_message_count']);
		unset($Message);
	}
	
	function withSentMessageCount(){
		$Message = new \G2\A\E\Chronoforums\M\Message();
		$messages_sql = $Message
		->fields(['Message.discussion_id', 'COUNT(Message.id)' => 'Message.count'])
		->where('Message.user_id', \GApp::user()->get('id'), '=')
		->group(['Message.discussion_id'])
		->returnQuery('select');
		$this->join($messages_sql, 'SentMessage', [['SentMessage.Message.discussion_id', 'Discussion.id', '=', 'field']]);
		
		$this->fields(['SentMessage.Message.count' => 'Discussion.received_message_count']);
		unset($Message);
	}
	
	function withRecipients(){
		$this->hasMany('\G2\A\E\Chronoforums\M\DiscussionUser', 'DiscussionRecipient', 'discussion_id', [], true)
		->belongsTo('\G2\A\M\User', 'Recipient', 'user_id', ['hasOne' => [['\G2\A\E\Chronoforums\M\Profile', 'RecipientProfile', 'user_id']]])
		->fields([
			'DiscussionRecipient.*', 
			'Recipient.id', 'Recipient.name', 'Recipient.username', 
			'RecipientProfile.*', 
		]);
	}
}