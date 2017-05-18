<?php
/**
* ChronoCMS version 1.0
* Copyright (c) 2012 ChronoCMS.com, All rights reserved.
* Author: (ChronoCMS.com Team)
* license: Please read LICENSE.txt
* Visit http://www.ChronoCMS.com for regular updates and information.
**/
namespace G2\E\Chronoforums\L;
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
class Subscribed {
	var $users = [];
	var $groups = [];
	
	function __construct(&$controller = null){
		
	}
	
	public function users($ids = []){
		$this->users = $ids;
		return $this;
	}
	
	private function _users(){
		if(empty($this->users)){
			return [];
		}
		$User = new \G2\A\M\User();
		$users = $User->where('id', $this->users, 'in')->fields(['id', 'username', 'name', 'email'])->select('all');
		$this->users = [];
		return $users;
	}
	
	public function groups($ids = []){
		$this->groups = $ids;
		return $this;
	}
	
	private function _groups(){
		if(empty($this->groups)){
			return [];
		}
		$User = new \G2\A\M\User();
		$User->hasOne('\G2\A\M\GroupUser', 'GroupUser', 'user_id');
		$users = $User->where('GroupUser.group_id', $this->groups, 'in')->fields(['id', 'username', 'name', 'email'])->select('all');
		$this->groups = [];
		return $users;
	}
	
	
	public function posts_report($topic_id, $post_id){
		if((bool)\GApp::extension('chronoforums')->settings()->get('enable_reports_notification', 1)){
			//notify the subscribers
			$subscribers = $this->_groups();
			
			if(!empty($subscribers)){
				$view = new \G2\L\View();
				$view->set('topic_id', $topic_id);
				$view->set('post_id', $post_id);
				$view->view = 'views.emails.posts_report';
				
				$mailer = new \G2\L\Mail();
				foreach($subscribers as $subscriber){
					$view->set('user', $subscriber);
					$body = $view->renderView();
					
					$mailer->to($subscriber['User']['email'])
					->subject(rl('One of the posts on "%s" has been reported', [\GApp::config()->get('site.title')]))
					->body($body)
					->send();
				}
			}
		}
	}
	
	public function messages_send($discussion, $message, $sender){
		$subscribers = $this->_users();
		if(!empty($subscribers)){
			$view = new \G2\L\View();
			$view->set('discussion', $discussion);
			$view->set('message', $message);
			$view->set('sender', $sender);
			$view->view = 'views.emails.messages_send';
			
			$mailer = new \G2\L\Mail();
			foreach($subscribers as $subscriber){
				$view->set('user', $subscriber);
				$body = $view->renderView();
				
				$mailer->to($subscriber['User']['email'])
				->subject(rl('A new private message has been sent to you on "%s"', [\GApp::config()->get('site.title')]))
				->body($body)
				->send();
			}
		}
	}
	
	public function posts_vote($topic, $post){
		$subscribers = $this->_users();
		if(!empty($subscribers)){
			$view = new \G2\L\View();
			$view->set('topic', $topic);
			$view->set('post', $post);
			$view->view = 'views.emails.posts_vote';
			
			$mailer = new \G2\L\Mail();
			foreach($subscribers as $subscriber){
				$view->set('user', $subscriber);
				$body = $view->renderView();
				
				$mailer->to($subscriber['User']['email'])
				->subject(rl('One of your posts on "%s" has been upvoted', [\GApp::config()->get('site.title')]))
				->body($body)
				->send();
			}
		}
	}
	
	public function topics_add($topic, $post_id){
		//subscribe the author
		$TopicSubscriber = new \G2\A\E\Chronoforums\M\TopicSubscriber();
		$TopicSubscriber->subscribe((int)$topic['id']);
		unset($TopicSubscriber);
		
		if((bool)\GApp::extension('chronoforums')->settings()->get('enable_topics_notification', 0)){
			
			if($topic['published'] == 1){
				if((bool)\GApp::extension('chronoforums')->settings()->get('topics_notification_not_approved', 0) == true){
					return;
				}
			}
			//notify the subscribers
			$subscribers = $this->_groups();
			
			if(!empty($subscribers)){
				$view = new \G2\L\View();
				$view->set('topic', $topic);
				$view->set('post_id', $post_id);
				$view->view = 'views.emails.topics_add';
				
				$mailer = new \G2\L\Mail();
				foreach($subscribers as $subscriber){
					$view->set('user', $subscriber);
					$body = $view->renderView();
					
					$mailer->to($subscriber['User']['email'])
					->subject(rl('A new topic has been posted on "%s"', [\GApp::config()->get('site.title')]))
					->body($body)
					->send();
				}
			}
		}
	}
	
	public function posts_edit($topic_id, $post_id){
		if((bool)\GApp::extension('chronoforums')->settings()->get('enable_posts_edit_notification', 0)){
			//notify the subscribers
			$subscribers = $this->_groups();
			
			if(!empty($subscribers)){
				$view = new \G2\L\View();
				$view->set('topic_id', $topic_id);
				$view->set('post_id', $post_id);
				$view->view = 'views.emails.posts_edit';
				
				$mailer = new \G2\L\Mail();
				foreach($subscribers as $subscriber){
					$view->set('user', $subscriber);
					$body = $view->renderView();
					
					$mailer->to($subscriber['User']['email'])
					->subject(rl('A post has been edited on "%s"', [\GApp::config()->get('site.title')]))
					->body($body)
					->send();
				}
			}
		}
	}
	
	public function posts_index($topic){
		if(\GApp::user()->get('id')){
			$TopicSubscriber = new \G2\A\E\Chronoforums\M\TopicSubscriber();
			$TopicSubscriber->unNotified((int)$topic['id']);
			unset($TopicSubscriber);
		}
	}
	
	public function posts_reply($topic, $post_id, $published){
		//subscribe the author
		$TopicSubscriber = new \G2\A\E\Chronoforums\M\TopicSubscriber();
		$TopicSubscriber->subscribe((int)$topic['id']);
		//notify the subscribers
		$subscribers_ids = $TopicSubscriber->getSubscribers((int)$topic['id']);
		$this->users($subscribers_ids);
		
		if((bool)\GApp::extension('chronoforums')->settings()->get('enable_replies_notification', 1)){
			$subscribers = $this->_users();
			if(!empty($subscribers)){
				$view = new \G2\L\View();
				$view->set('topic', $topic);
				$view->set('post_id', $post_id);
				$view->view = 'views.emails.posts_reply_subscriber';
				
				$mailer = new \G2\L\Mail();
				foreach($subscribers as $subscriber){
					$view->set('user', $subscriber);
					$body = $view->renderView();
					
					$mailer->to($subscriber['User']['email'])
					->subject(rl('New reply notification - %s', [$topic['title']]))
					->body($body)
					->send();
				}
			}
			$TopicSubscriber->notified((int)$topic['id']);
		}
		
		if($published == 1){
			if((bool)\GApp::extension('chronoforums')->settings()->get('posts_notification_not_approved', 0) == true){
				return;
			}
		}
		
		if((bool)\GApp::extension('chronoforums')->settings()->get('enable_posts_notification', 0)){
			//notify the subscribers
			$this->groups(\GApp::extension('chronoforums')->settings()->get('posts_notification_groups', []));
			$subscribers = $this->_groups();
		
			if(!empty($subscribers)){
				$view = new \G2\L\View();
				$view->set('topic', $topic);
				$view->set('post_id', $post_id);
				$view->view = 'views.emails.posts_reply';
				
				$mailer = new \G2\L\Mail();
				foreach($subscribers as $subscriber){
					$view->set('user', $subscriber);
					$body = $view->renderView();
					
					$mailer->to($subscriber['User']['email'])
					->subject(rl('New post made - %s', [$topic['title']]))
					->body($body)
					->send();
				}
			}
		}
	}
}