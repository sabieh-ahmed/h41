<?php
/**
* COMPONENT FILE HEADER
**/
namespace G2\E\Chronoforums\C;
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
class Profiles extends \G2\E\Chronoforums\Chronoforums {
	var $models = array('\G2\A\M\User', '\G2\A\E\Chronoforums\M\Profile');
	
	function avatar(){
		if(!empty($this->data['u']) AND !empty($this->data['av'])){
			$avatars_path = \G2\Globals::ext_path('chronoforums', 'front').'avatars'.DS;
			$target = $avatars_path.$this->data['av'];
			\G2\L\Download::send($target, 'I', $this->data['av']);
		}else{
			\G2\L\Env::e404();
		}
		
		$this->view = false;
	}
	
	function mini(){
		$userData = $this->Profile->read($this->data('u'));
		
		if($userData === false){
			return ['error' => rl('User does not exist.')];
		}
		
		$this->set('user', $userData);
	}
	
	function index(){
		$userData = $this->Profile->read($this->data('u'));
		
		if($userData === false){
			return ['error' => rl('User does not exist.')];
		}
		
		$this->set('user', $userData);
		
		\GApp::document()->title(\GApp::document()->title().' - '.$userData['User']['username'].' '.rl('profile'));
		
		$this->Composer->pageHeader($userData['User']['username'], r_('index.php?ext=chronoforums&cont=profiles'.rp('u', $userData['User']['id'])));
		$this->Composer->breadcrumb($userData['User']['username'], r_('index.php?ext=chronoforums&cont=profiles'.rp('u', $userData['User']['id'])), '%s '.rl('profile'));
		
		$this->setActivities();
		
		$this->Profile->updateCounters($this->data('u'));
	}
	
	function edit(){
		$user = \GApp::user();
		
		if(!$user->get('id') OR $this->data('u') != $user->get('id')){
			return ['error' => rl('You are not allowed to take this action.')];
		}
		
		if(isset($this->data['edit'])){
			if(!empty($_FILES['avatar']['name'])){
				$avatar = $_FILES['avatar'];
				$ext = strtolower(pathinfo($avatar['name'], PATHINFO_EXTENSION));
				if(!in_array($ext, ['jpg', 'png', 'gif'])){
					return ['error' => rl('Avatar file extensions allowed are jpg, png and gif only.'), 'reload' => true];
				}
				if($avatar['size']/1000 > $this->fparams->get('avatars_max_size', 25)){
					return ['error' => rl('Avatar file maximum size is %s KB.', [$this->fparams->get('avatars_max_size', 25)]), 'reload' => true];
				}
				list($width, $height) = getimagesize($avatar['tmp_name']);
				
				if($height > $this->fparams->get('avatars_max_height', 100) OR $width > $this->fparams->get('avatars_max_width', 100)){
					return ['error' => rl('Avatar dimensions should not exceed %s px height and %s px width.', [$this->fparams->get('avatars_max_height', 100), $this->fparams->get('avatars_max_width', 100)]), 'reload' => true];
				}
				
				$avatars_path = \G2\Globals::ext_path('chronoforums', 'front').'avatars'.DS;
				$saved = \G2\L\Upload::save($avatar['tmp_name'], $avatars_path.$this->data['u'].'.'.$ext);
				if(!$saved){
					return ['error' => rl('Error saving the avatar file.'), 'reload' => true];
				}
				$this->data['Profile']['avatar'] = $this->data['u'].'.'.$ext;
			}
			
			$result = $this->Profile->where('user_id', $user->get('id'))->update($this->data['Profile']);
			
			if($result !== false){
				return ['success' => rl('Profile updated successfully.'), 'redirect' => r_('index.php?ext=chronoforums&cont=profiles'.rp('u', $user->get('id')))];
			}else{
				return ['error' => rl('Error updating profile data.'), 'reload' => true];
			}
		}
		
		$userData = $this->Profile->read($this->data('u'));
		
		if($userData === false){
			return ['error' => rl('User does not exist.')];
		}
		$this->set('user', $userData);
		
		$this->Composer->pageHeader(rl('Edit profile'), r_('index.php?ext=chronoforums&cont=profiles&act=edit'.rp('u', $userData['User']['id'])), '%s', 'write');
		$this->Composer->breadcrumb(rl('Edit profile'), r_('index.php?ext=chronoforums&cont=profiles&act=edit'.rp('u', $userData['User']['id'])), '%s', 'write');
		
		$this->data = array_merge($this->data, $userData);
	}
	
	function unsubscribe(){
		$user = \GApp::user();
		
		if(!$user->get('id') OR $this->data('u') != $user->get('id')){
			return ['error' => rl('You are not allowed to take this action.')];
		}
		
		$TopicSubscriber = new \G2\A\E\Chronoforums\M\TopicSubscriber();
		
		$result = $TopicSubscriber->where('user_id', $user->get('id'))->delete();
		
		if($result !== false){
			return ['success' => rl('You have been unsubscribed successfully.'), 'redirect' => r_('index.php?ext=chronoforums&cont=profiles'.rp('u', $user->get('id')))];
		}else{
			return ['error' => rl('Error updating the subscribers data.'), 'redirect' => r_('index.php?ext=chronoforums&cont=profiles'.rp('u', $user->get('id')))];
		}
	}
	
	function settings(){
		$user = \GApp::user();
		
		if(!$user->get('id') OR $this->data('u') != $user->get('id')){
			return ['error' => rl('You are not allowed to take this action.')];
		}
		
		if(isset($this->data['settings'])){
			$result = $this->Profile->where('user_id', \GApp::user()->get('id'))->update(['params' => $this->data['Profile']['params']], ['json' => ['params']]);
			
			if($result !== false){
				return ['success' => rl('Profile updated successfully.'), 'redirect' => r_('index.php?ext=chronoforums&cont=profiles'.rp('u', $user->get('id')))];
			}else{
				return ['error' => rl('Error updating profile data.'), 'reload' => true];
			}
		}
		
		$userData = $this->Profile->read($this->data('u'));
		
		if($userData === false){
			return ['error' => rl('User does not exist.')];
		}
		$this->set('user', $userData);
		
		$this->Composer->pageHeader(rl('Board settings'), r_('index.php?ext=chronoforums&cont=profiles&act=settings'.rp('u', $userData['User']['id'])), '%s', 'settings');
		$this->Composer->breadcrumb(rl('Board settings'), r_('index.php?ext=chronoforums&cont=profiles&act=settings'.rp('u', $userData['User']['id'])), '%s', 'settings');
		
		$this->data = array_merge($this->data, $userData);
	}
	/*
	function loadUser(){
		$userData = $this->Profile->read($this->data('u'));
		if($userData === false){
			return ['error' => rl('User does not exist.')];
		}
		$this->set('user', $userData);
	}
	*/
	function activities(){
		if(empty($this->data['u'])){
			return ['error' => rl('User does not exist.')];
		}
		
		$this->setActivities();
	}
	
	function setActivities(){
		//get activities
		//get topics
		$Topic = new \G2\A\E\Chronoforums\M\Topic();
		$Topic->alias = '';
		$topics_sql = $Topic
		->fields(['id', 'title', 'created', '=topic' => 'type'])
		->where('user_id', $this->data('u'))
		->where('published', 1)
		->returnQuery('select');
		
		//get posts
		$Post = new \G2\A\E\Chronoforums\M\Post();
		$Post->alias = '';
		$posts_sql = $Post
		->fields(['topic_id' => 'id', 'id' => 'title', 'created', '=post' => 'type'])
		->where('user_id', $this->data('u'))
		->where('published', 1)
		->returnQuery('select');
		
		$Activity = new \G2\L\Model(['name' => 'Activity']);
		$Activity->tablefields = ['id', 'title', 'created', 'type'];
		
		$activities = $Activity
		->fields([
			'Activity.id', 'Activity.title', 'Activity.created', 'Activity.type',
			'Topic.id', 'Topic.title', 'Topic.alias', 
		])
		->from(['(', $topics_sql, 'UNION', $posts_sql, ')'])
		->hasOne('\G2\A\E\Chronoforums\M\Topic', 'Topic', [['Activity.id', 'Topic.id', '=', 'field']])
		->group(['Activity.created'])
		->order(['Activity.created' => 'DESC'])
		->limit(10)
		->offset($this->data('startat', 0))
		->select('all');
		//->returnQuery('select');
		//pr($activities);die();
		
		$this->set('activities', $activities);
	}
	
	function delete(){
		if(\GApp::access('chronoforums', 'users_delete') !== true){
			return ['error' => rl('You are not allowed to take this action.')];
		}
		
		if(empty($this->data['u'])){
			return ['error' => rl('User does not exist.')];
		}
		
		$undeletable = $this->fparams->get('undeletable_groups', []);
		if(!empty($undeletable)){
			$GroupUser = new \G2\A\M\GroupUser();
			$user_groups = $GroupUser->where('user_id', $this->data('u'))->select('all');
			
			if(!empty($user_groups)){
				$user_groups = \G2\L\Arr::getVal($user_groups, '[n].GroupUser.group_id', []);
				
				if(count(array_intersect($user_groups, $undeletable)) > 0){
					return ['error' => rl('This user can not be deleted.'), 'redirect' => r_('index.php?ext=chronoforums&cont=profiles'.rp('u', $this->data))];
				}
			}
		}
		//get his post count
		$Post = new \G2\A\E\Chronoforums\M\Post();
		$count = $Post
		->where('user_id', $this->data('u'))
		->select('count');
		
		if(!is_numeric($count)){
			return ['error' => rl('Error counting user posts.'), 'redirect' => r_('index.php?ext=chronoforums&cont=profiles'.rp('u', $this->data))];
		}
		
		if((int)$count >= (int)$this->fparams->get('users_delete_posts_threshold', 5)){
			return ['error' => rl('This user has more than %s posts and should not be deleted.', [$this->fparams->get('users_delete_posts_threshold', 5)]), 'redirect' => r_('index.php?ext=chronoforums&cont=profiles'.rp('u', $this->data))];
		}
		//delete posts
		$posts = $Post->where('user_id', $this->data['u'])->select('all');
		if(!empty($posts)){
			$posts_ids = \G2\L\Arr::getVal($posts, '[n].Post.id', []);
			
			$result = $Post->remove($posts_ids, 'in');
			
			if($result !== true){
				return ['error' => rl('Error deleting user posts.')];
			}
		}
		unset($Post);
		
		//delete topics
		$Topic = new \G2\A\E\Chronoforums\M\Topic();
		$topics = $Topic->where('user_id', $this->data['u'])->select('all');
		if(!empty($topics)){
			$topics_ids = \G2\L\Arr::getVal($topics, '[n].Topic.id', []);
			
			$result = $Topic->remove($topics_ids, 'in');
			
			if($result !== true){
				return ['error' => rl('Error deleting user topics.')];
			}
		}
		unset($Topic);
		
		//delete porfile
		$result = $this->Profile->remove($this->data['u']);
		if($result !== true){
			return ['error' => rl('Error deleting user profile.')];
		}
		
		//delete user
		$result = $this->User->remove($this->data['u']);
		if($result !== true){
			return ['error' => rl('Error deleting user.')];
		}
		
		return ['success' => rl('User deleted successfully.'), 'redirect' => r_('index.php?ext=chronoforums')];
	}
	
}
?>