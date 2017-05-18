<?php
/**
* ChronoCMS version 1.0
* Copyright (c) 2012 ChronoCMS.com, All rights reserved.
* Author: (ChronoCMS.com Team)
* license: Please read LICENSE.txt
* Visit http://www.ChronoCMS.com for regular updates and information.
**/
namespace G2\E\Chronoforums;
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
class Chronoforums extends \G2\L\Controller {
	//var $models = array('\G2\A\E\Chronoforums\M\Forum');
	var $libs = array('\G2\L\Request', '\G2\L\Composer');
	var $helpers= array(
		//'\G2\H\Display',
		//'\G2\H\Html',
		//'\G2\H\Sorter',
		'\G2\H\Paginator',
	);
	
	function _initialize(){
		$attachments_path = \G2\Globals::ext_path('chronoforums', 'front').'attachments'.DS;
		\GApp::extension('chronoforums')->settings()->set('attachments_path', $attachments_path);
		$this->fparams = \GApp::extension('chronoforums')->settings();
		$this->set('fparams', $this->fparams);
		
		if((int)$this->fparams->get('offline', 0)){
			\GApp::session()->flash('warning', $this->fparams->get('offline_message', ''));
			return false;
		}
		
		$this->layout('main');
		$this->layout('default');
		
		if(\GApp::access('chronoforums', 'index') !== true){
			return ['error' => rl('You do not have enough permissions to access the forums.')];
		}
		
		if(strlen($this->fparams->get('custom_styles', ''))){
			\GApp::document()->addCssCode($this->fparams->get('custom_styles', ''));
		}
		
		if(empty($this->tvout)){
			\GApp::document()->_('semantic-ui', ['css' => ['card']]);
			\GApp::document()->addCssFile(\G2\Globals::ext_url('chronoforums', 'front').'assets/chronoforums.semantic.css');
			
			if($this->fparams->get('enable_code_highlight', 1)){
				//add highlighter
				\GApp::document()->_('highlight', array('style' => 'idea'));
			}
			
			\GApp::document()->_('tooltipster');
			\GApp::document()->addJsFile(\G2\Globals::ext_url('chronoforums', 'front').'assets/default.js');
			\GApp::document()->addJsCode('
			jQuery(document).ready(function($){
				
				$("body").on("contentChange", function(){
					$(".cfu-code").each(function(i, block){
						hljs.highlightBlock(block);
					});
				});
				
				$(".ui.dropdown.item .text .ui.label").on("click", function(){
					$(this).closest(".ui.dropdown.item").trigger("click");
				});
				
				$(".ui.dropdown.labels .item").on("click", function(){
					$(this).closest(".menu.drop").addClass("hidden").removeClass("visible");
				});
				
				$("body").on("contentChange", function(){
					$("[data-hint]").each(function(i, element){
						$(element).tooltipster({
							content: $(element).data("hint"),
							maxWidth: 300,
							delay: 50
						});
					});
				});
			});');
			
			$this->Forum = new \G2\A\E\Chronoforums\M\Forum();
			
			$this->Composer->breadcrumb(rl('Forums'), r_('index.php?ext=chronoforums'), '', 'home');
			
			$forum = $this->setForum();
			
			if(!empty($forum['Forum'])){
				//check the forum's permissions
				if((bool)$this->fparams->get('forum_permissions', 0) === true AND \GApp::access($forum['Forum']['rules'], 'index') !== true){
					return ['error' => rl('You do not have enough permissions to access this forum.'), 'redirect' => r_('index.php?ext=chronoforums')];
				}
				//add breadcrumbs
				$forumPath = array_filter(explode('.', $forum['Forum']['path']), function($value){return !empty($value);});
				if(!empty($forumPath)){
					$parents = $this->Forum
					->fields(['Forum.id', 'Forum.title', 'Forum.alias'])
					->where('Forum.id', $forumPath, 'in')
					->select('all');
					
					foreach($parents as $parent){
						$this->Composer->breadcrumb($parent['Forum']['title'], r_('index.php?ext=chronoforums&cont=topics&f='.$parent['Forum']['id'].'&alias='.$parent['Forum']['alias']));
					}
				}
				$this->Composer->breadcrumb($forum['Forum']['title'], r_('index.php?ext=chronoforums&cont=topics&f='.$forum['Forum']['id'].'&alias='.$forum['Forum']['alias']));
			}
			
			if((bool)$this->fparams->get('enable_topics_tags', 1)){
				$Tag = new \G2\A\E\Chronoforums\M\Tag();
				$tags = $Tag->where('Tag.published', 1)->order(['Tag.title' => 'asc'])->select('all', ['json' => ['params']]);
				$this->set('tags_filter', $tags);
			}else{
				$this->set('tags_filter', []);
			}
			
			//manage user data
			$user = \GApp::user();
			if($user->get('id')){
				$Profile = new \G2\A\E\Chronoforums\M\Profile();
				$userProfile = $Profile->where('Profile.user_id', $user->get('id'))->select('first', ['json' => ['Profile.params']]);
				
				$new_user_data = [];
				//$mode = isset($userProfile['Profile']['user_id']) ? 'update' : 'insert';
				$new_user_data['user_id'] = isset($userProfile['Profile']['user_id']) ? $userProfile['Profile']['user_id'] : $user->get('id');
				$new_user_data['last_activity'] = date('Y-m-d H:i:s');
				
				if(strtotime($userProfile['Profile']['last_activity']) < strtotime($user->get('last_login'))){
					//user record needs to be updated
					$new_user_data['last_visit'] = $userProfile['Profile']['last_activity'];
				}
				if(isset($userProfile['Profile']['user_id'])){
					$Profile->where('user_id', $user->get('id'))->update($new_user_data);
				}else{
					$Profile->insert($new_user_data);
				}
				
				//$user->set('profile', !empty($userProfile['Profile']) ? new \G2\L\Parameter($userProfile['Profile']) : new \G2\L\Parameter([]));
				$user->set('profile', !empty($userProfile['Profile']) ? $userProfile['Profile'] : []);
				
				//get unread PM
				if((bool)$this->fparams->get('enable_pm', 1)){
					$DiscussionUser = new \G2\A\E\Chronoforums\M\DiscussionUser();
					$unreadPM = $DiscussionUser->getUnreadCount();
					
					$this->set('unreadPM', $unreadPM);
				}
			}
		}
	}
	
	function setForum(){
		$forum = [];
		
		if($this->data('f')){
			$id = $this->data('f');
			$forum = $this->Forum
			->fields(['Forum.*'])
			->where('Forum.id', $id)
			->select('first', ['json' => ['rules']]);
			
		}else if($this->data('t')){
			$id = $this->data('t');
			$forum = $this->Forum
			->fields(['Forum.*'])
			->where('Topic.id', $id)
			->hasOne('\G2\A\E\Chronoforums\M\Topic', 'Topic', 'forum_id')
			->select('first', ['json' => ['rules']]);
			
		}else if($this->data('p')){
			
		}
		
		$this->set('_forum', !empty($forum['Forum']) ? $forum['Forum'] : []);
		return $forum;
	}
	
	function index(){
		$forums = $this->Forum
		->where('Forum.published', 1)
		->belongsTo('\G2\A\E\Chronoforums\M\Post', 'LastPost', 'last_post', ['belongsTo' => [['\G2\A\M\User', 'LastPostUser', 'user_id'], ['\G2\A\E\Chronoforums\M\Profile', 'LastPostUserProfile', 'user_id']]])
		->order(['Forum.ordering' => 'asc'])
		->select('flat', ['json' => ['rules']]);
		$this->set('forums', $forums);
	}

	function _validated(){
		if((bool)$this->fparams->get('validated', 0) === true){
			return true;
		}
		return false;
	}
	
	function _finalize(){
		if(empty($this->tvout) AND $this->_validated() == false){
			echo '<a href="http://www.chronoengine.com/" target="_blank">Powered by ChronoForums - ChronoEngine.com</a>';
		}
	}
}
?>