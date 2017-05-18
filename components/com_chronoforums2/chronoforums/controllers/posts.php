<?php
/**
* COMPONENT FILE HEADER
**/
namespace G2\E\Chronoforums\C;
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
class Posts extends \G2\E\Chronoforums\Chronoforums {
	var $models = array('\G2\A\E\Chronoforums\M\Topic', '\G2\A\E\Chronoforums\M\Post');
	var $helpers= array(
		'\G2\E\Chronoforums\H\Bbcode',
	);
	
	function index(){
		if(empty($this->data['t'])){
			return ['error' => rl('Topic does not exist.'), 'redirect' => r_('index.php?ext=chronoforums&cont=topics'.rp('f', $this->data))];
		}
		
		if((int)$this->fparams->get('enable_topics_tags', 1)){
			$this->Topic->hasMany('\G2\A\E\Chronoforums\M\TopicTag', 'TopicTag', 'topic_id', ['belongsTo' => [['\G2\A\E\Chronoforums\M\Tag', 'Tag', 'tag_id']]], true)
			->fields(['Tag.*', 'TopicTag.*'])
			->settings(['json' => ['Tag.params']]);
		}
		
		$topic = $this->Topic
		->where('id', $this->data('t'))
		->belongsTo('\G2\A\M\User', 'TopicAuthor', 'user_id', ['hasOne' => [['\G2\A\E\Chronoforums\M\Profile', 'TopicAuthorProfile', 'user_id']]])
		->hasOne('\G2\A\E\Chronoforums\M\Featured', 'Featured', 'topic_id')
		->hasOne('\G2\A\E\Chronoforums\M\Favorite', 'Favorite', [['Favorite.topic_id', 'Topic.id', '=', 'field'], 'AND', ['Favorite.user_id', \GApp::user()->get('id'), '=']])
		->hasOne('\G2\A\E\Chronoforums\M\TopicSubscriber', 'TopicSubscriber', [['TopicSubscriber.topic_id', 'Topic.id', '=', 'field'], 'AND', ['TopicSubscriber.user_id', \GApp::user()->get('id'), '=']])
		->fields([
			'Topic.*',
			'TopicAuthor.id', 'TopicAuthor.username', 'TopicAuthor.name', 
			'TopicAuthorProfile.*', 
			'Featured.*',
			'Favorite.*',
			'TopicSubscriber.*',
		])
		->select('first');
		
		if(empty($topic)){
			return ['error' => rl('Topic does not exist.'), 'redirect' => r_('index.php?ext=chronoforums&cont=topics'.rp('f', $this->data))];
		}
		
		if(empty($topic['Topic']['published']) AND \GApp::access('chronoforums', 'topics_moderate') !== true){
			return ['error' => rl('This topic is unpublished and waiting moderation.'), 'redirect' => r_('index.php?ext=chronoforums&cont=topics'.rp('f', $topic['Topic']['forum_id']))];
		}
		
		//auto lock topic for inactivity
		if((bool)$this->fparams->get('auto_lock_topic_inactive_limit', 0)){
			if(strtotime($topic['Topic']['created']) + ((int)$this->fparams->get('auto_lock_topic_inactive_limit', 0) * 24 * 60 * 60) < time()){
				$this->Topic->where('id', $this->data('t'))->update(['locked' => 1]);
				
				$topic['Topic']['locked'] = 1;
			}
		}
		
		$this->set('topic', $topic);
		
		if(\GApp::access('chronoforums', 'posts_index', (int)$topic['Topic']['user_id']) !== true){
			return ['error' => rl('You are not allowed to read this topic.'), 'redirect' => r_('index.php?ext=chronoforums&cont=topics'.rp('f', $topic['Topic']['forum_id']))];
		}
		
		\GApp::document()->title(\GApp::document()->title().' - '.$topic['Topic']['title']);
		
		if(!empty($topic['Tag'])){
			$tags = \G2\L\Arr::getVal($topic['Tag'], '[n].title', []);
			\GApp::document()->meta('keywords', implode(',', $tags));
		}
		
		$this->Composer->pageHeader($topic['Topic']['title'], r_('index.php?ext=chronoforums&cont=posts&t='.$topic['Topic']['id'].'&alias='.$topic['Topic']['alias']));
		
		$where = [];
		if(\GApp::access('chronoforums', 'topics_moderate') !== true){
			$where[] = ['Post.published', 1];
			$where[] = 'AND';
		}
		$where[] = ['Post.topic_id', $this->data('t')];
		
		$this->Post->whereGroup($where);
		$this->Composer->paginate('chronoforums.posts.'.$topic['Topic']['id'], $this->Post, $this->fparams->get('posts_limit'));
		
		$posts_order = ['Post.created' => 'asc'];
		if(\GApp::user()->get('profile.params.posts_ordering', 'lastpost_asc') == 'lastpost_desc'){
			$posts_order = ['Post.created' => 'desc'];
		}
		
		$posts = $this->Post->prepare()->order($posts_order)->select('all');
		$this->set('posts', $posts);
		
		//update hits
		$this->Topic->where('id', (int)$topic['Topic']['id'])->increment('hits');
		
		//update tracking status
		if(\GApp::user()->get('id') AND (bool)\GApp::user()->get('profile.params.enable_topics_track', 0) !== false){
			$this->Topic->track($topic['Topic'], (int)$this->get('fparams')->get('topics_track_period', 30));
		}
		
		//update subscriber's notification status
		$Subscribed = new \G2\E\Chronoforums\L\Subscribed($this);
		$Subscribed->posts_index($topic['Topic']);
	}
	
	function edit(){
		$id = $this->data('id');
		if(empty($id)){
			return ['error' => rl('Post does not exist.')];
		}
		
		$post = $this->Post
		->fields(['Post.*', 'Attachment.*'])
		->where('Post.id', $id)
		->hasMany('\G2\A\E\Chronoforums\M\Attachment', 'Attachment', 'post_id')
		->select('first');
		
		if(\GApp::access('chronoforums', 'posts_edit', (int)$post['Post']['user_id']) !== true){
			return ['error' => rl('You are not allowed to edit posts.')];
		}
		
		$Profile = new \G2\A\E\Chronoforums\M\Profile();
		$passed = $Profile->checkApproval((int)$this->fparams->get('posts_edit_threshold', 5));
		
		if($passed != true){
			return ['error' => rl('You do not have enough posts to make post edits yet.')];
		}
		
		if(isset($this->data['edit'])){
			$data['id'] = $id;
			$data['text'] = $this->data['Post']['text'];
			
			$result = $this->Post->store($data, $this->data('Attachment', []));
			
			if($result !== true){
				return $result;
			}
			
			$this->post($this->Post->id);
			
			//notify the subscribers
			$Subscribed = new \G2\E\Chronoforums\L\Subscribed($this);
			$Subscribed->groups($this->fparams->get('posts_edit_notification_groups', []))->posts_edit($this->data('t'), $this->Post->id);
			
			return;
		}
		
		$post = $this->Post
		->fields(['Post.*', 'Attachment.*'])
		->where('Post.id', $id)
		->hasMany('\G2\A\E\Chronoforums\M\Attachment', 'Attachment', 'post_id')
		->select('first');
		
		$this->data = $post;
		$this->set('post', $post);
		$this->view = 'views.posts.edit';
	}
	
	function post($id = 0){
		if(empty($id)){
			$id = $this->data('id');
		}
		if(empty($id)){
			return ['error' => rl('Post does not exist.')];
		}
		
		$post = $this->Post->prepare()->where('Post.id', $id)->select('first');
		
		$this->set('post', $post);
		$this->view = 'views.posts.post';
	}
	
	function reply(){
		if(empty($this->data['t'])){
			return ['error' => rl('Topic does not exist.')];
		}
		
		$topic = $this->Topic->where('id', $this->data['t'])->select('first');
		if(empty($topic)){
			return ['error' => rl('Topic does not exist.')];
		}
		if(!empty($topic['Topic']['locked'])){
			return ['error' => rl('This topic has been locked and no more posts can be made.')];
		}
		
		if(\GApp::access('chronoforums', 'posts_reply', (int)$topic['Topic']['user_id']) !== true){
			return ['error' => rl('You are not allowed to make replies.')];
		}
		
		//flooding check
		if((int)$this->fparams->get('flooding_limit', 20) > 0){
			$current_flooding = \GApp::session()->get('last_forum_post', 0);
			if(!empty($current_flooding) AND (int)$this->fparams->get('flooding_limit', 20) + $current_flooding > time()){
				return ['error' => rl('You have to wait some time before you can make a new post.')];
			}else{
				\GApp::session()->set('last_forum_post', time());
			}
		}
		
		$data = $this->data['Post'];
		
		$data['topic_id'] = $topic['Topic']['id'];
		//$data['forum_id'] = $topic['Topic']['forum_id'];
		$data['remote_address'] = ($_SERVER['REMOTE_ADDR'] == $_SERVER['SERVER_ADDR']) ? '' : $_SERVER['REMOTE_ADDR'];
		
		$data['published'] = (int) ($this->fparams->get('auto_publish_replies', 0) OR \GApp::access('chronoforums', 'topics_moderate'));
		
		if(isset($data['user_id'])){
			unset($data['user_id']);
		}
		
		if($data['published'] == 0){
			$auto_approval = $this->checkAutoApproval();
			if(is_array($auto_approval)){
				return $auto_approval;
			}else{
				$data['published'] = (int)$auto_approval;
			}
		}
		
		$result = $this->Post->store($data, $this->data('Attachment', []));
		
		if($result !== true){
			return $result;
		}
		
		//subscribe the author and send notifications
		$Subscribed = new \G2\E\Chronoforums\L\Subscribed($this);
		$Subscribed->posts_reply($topic['Topic'], $this->Post->id, $data['published']);
		
		//update last post
		$this->Topic->updateLastPost((int)$topic['Topic']['id'], $this->Post->id);
		//update post count
		$this->Topic->where('id', (int)$topic['Topic']['id'])->increment('post_count');
		//update forum
		$Forum = new \G2\A\E\Chronoforums\M\Forum();
		$Forum->where('id', (int)$topic['Topic']['forum_id'])->increment('post_count');
		$Forum->updateLastPost((int)$topic['Topic']['forum_id'], $this->Post->id);
		
		$this->post($this->Post->id);
	}
	
	function autoReply($topic_id){
		if((bool)$this->get('fparams')->get('enable_responder', 0)){
			$reply = $this->get('fparams')->get('responder_reply', '');
			$reply = eval($reply);
			
			if(!empty($reply)){
				
				$topic = $this->Topic->where('id', $topic_id)->select('first');
				
				$data['topic_id'] = $topic['Topic']['id'];
				$data['published'] = 1;
				$data['text'] = $reply;
				$data['created'] = date('Y-m-d H:i:s', time() + 60);
				$data['user_id'] = (int)$this->get('fparams')->get('responder_user_id', 0);
				
				$result = $this->Post->store($data);
				
				if($result === true){
					//subscribe the author and send notifications
					$Subscribed = new \G2\E\Chronoforums\L\Subscribed($this);
					$Subscribed->posts_reply($topic['Topic'], $this->Post->id, $data['published']);
					
					//update last post
					$this->Topic->updateLastPost((int)$topic['Topic']['id'], $this->Post->id);
					//update post count
					$this->Topic->where('id', (int)$topic['Topic']['id'])->increment('post_count');
					//update forum
					$Forum = new \G2\A\E\Chronoforums\M\Forum();
					$Forum->where('id', (int)$topic['Topic']['forum_id'])->increment('post_count');
					$Forum->updateLastPost((int)$topic['Topic']['forum_id'], $this->Post->id);
				}
			}
		}
	}
	
	function checkAutoApproval(){
		
		$Profile = new \G2\A\E\Chronoforums\M\Profile();
		$can = $Profile->checkApproval((int)$this->fparams->get('posts_auto_approval_threshold', 1));
		
		if($can == true){
			return true;
		}else{
			$can = $Profile->checkApproval((int)$this->fparams->get('non_approved_posts_threshold', 1), false);
			if($can == true){
				return ['error' => rl('You have reached the maximum limit of %s non approved posts.', [(int)$this->fparams->get('non_approved_posts_threshold', 1)])];
			}
		}
		
		return false;
		/*
		if((int)\GApp::extension('chronoforums')->settings()->get('posts_auto_approval_threshold', 1) AND $user->get('id')){
			$approved_posts = $this->Post->belongsTo('\G2\A\E\Chronoforums\M\Topic', 'Topic', 'topic_id')
			->whereGroup([['Post.user_id', $user->get('id')], 'AND', ['Post.published', 1], 'AND', ['Topic.published', 1]])
			->select('count');
			
			if($approved_posts >= (int)\GApp::extension('chronoforums')->settings()->get('posts_auto_approval_threshold', 1)){
				return true;
			}
		}
		
		if((int)\GApp::extension('chronoforums')->settings()->get('non_approved_posts_threshold', 1) AND $user->get('id')){
			$non_approved_posts = $this->Post->belongsTo('\G2\A\E\Chronoforums\M\Topic', 'Topic', 'topic_id')
			->whereGroup([['Post.user_id', $user->get('id')], 'AND', '(', ['Post.published', 0], 'OR', ['Topic.published', 0], ')'])
			->select('count');
			
			if($non_approved_posts >= (int)\GApp::extension('chronoforums')->settings()->get('non_approved_posts_threshold', 1)){
				return ['error' => rl('You have reached the maximum limit of non approved posts.')];
			}
		}
		*/
		return false;
	}
	
	function report(){
		if(\GApp::access('chronoforums', 'posts_report') !== true){
			return ['error' => rl('You are not allowed to report posts.')];
		}
		
		if(empty($this->data['id'])){
			return ['error' => rl('Post does not exist.')];
		}
		
		$Report = new \G2\A\E\Chronoforums\M\Report();
		//$Report->where('post_id', $this->data('id'))->delete();
		$data = [];
		$data['post_id'] = (int)$this->data['id'];
		$data['reason'] = $this->data('text');
		
		$result = $Report->save($data);
		
		//notify the subscribers
		$Subscribed = new \G2\E\Chronoforums\L\Subscribed($this);
		$Subscribed->groups($this->fparams->get('reports_notification_groups', []))->posts_report($this->data('t'), (int)$this->data['id']);
		
		if($result){
			//return ['error' => 0];
			$this->set('post', ['id' => $this->data('id')]);
			$this->data['text'] = '';
			$this->post();
		}else{
			return ['error' => array_shift($Report->errors)];
		}
	}
	
	function unreport(){
		if(\GApp::access('chronoforums', 'topics_moderate') !== true){
			return ['error' => rl('You are not allowed to delete reports.')];
		}
		
		if(empty($this->data['id'])){
			return ['error' => rl('Report does not exist.')];
		}
		
		$Report = new \G2\A\E\Chronoforums\M\Report();
		$result = $Report->where('id', $this->data('id'))->delete();
		
		if($result){
			return ['error' => 0];
		}else{
			return ['error' => array_shift($Report->errors)];
		}
	}
	
	function delete(){
		
		if(empty($this->data['id'])){
			return ['error' => rl('Post does not exist.')];
		}
		//get topic
		$topic = $this->Topic
		->hasOne('\G2\A\E\Chronoforums\M\Post', 'Post', 'topic_id')
		->where('Post.id', $this->data('id'))
		->select('first');
		
		if(\GApp::access('chronoforums', 'posts_delete', (int)$topic['Post']['user_id']) !== true){
			return ['error' => rl('You are not allowed to delete this post.')];
		}
		
		$result = $this->Post->remove($this->data('id'));
		if($result !== true){
			return $result;
		}
		
		//update post count
		$this->Topic->where('id', (int)$topic['Post']['topic_id'])->decrement('post_count');
		//update forum
		$Forum = new \G2\A\E\Chronoforums\M\Forum();
		$Forum->where('id', (int)$topic['Topic']['forum_id'])->decrement('post_count');
		//update topic's last post
		if((int)$topic['Topic']['last_post'] == (int)$this->data('id')){
			//update last post
			$this->Topic->updateLastPost((int)$topic['Topic']['id']);
			//update forum
			$Forum->updateLastPost((int)$topic['Topic']['forum_id']);
		}
		
		return ['success' => rl('Post deleted successfully.')];
	}
	
	function publish(){
		if(\GApp::access('chronoforums', 'topics_moderate') !== true){
			return ['error' => rl('You are not allowed to publish/unpublish posts.')];
		}
		
		$result = $this->Post->publish($this->data('id'), (int)$this->data('value'));
		
		if($result !== true){
			return $result;
		}
		
		$this->set('post', ['id' => $this->data('id'), 'published' => (int)$this->data['value']]);
		$this->post();
	}
	
	
	function answer(){
		//get topic
		$topic = $this->Topic
		->hasOne('\G2\A\E\Chronoforums\M\Post', 'Post', 'topic_id')
		->where('Post.id', $this->data('id'))
		->select('first');
		
		if(\GApp::access('chronoforums', 'posts_answer', (int)geta($topic, 'Topic.user_id')) !== true){
			return ['error' => rl('You are not allowed to select answers on this topic.')];
		}
		
		$Answer = new \G2\A\E\Chronoforums\M\Answer();
		
		if((int)$this->data('value') == 1){
			$result = $Answer->add($this->data('id'));
			
			if($result !== true){
				return $result;
			}
			
			$this->set('post', ['id' => $this->data('id')]);
			$this->set('answer', 1);
		}else{
			$result = $Answer->remove($this->data('id'));
			
			if($result !== true){
				return $result;
			}
			
			$this->set('post', ['id' => $this->data('id')]);
		}
		
		$this->post();
	}
	
	function voteup(){
		
		//get topic
		$topic = $this->Topic
		->hasOne('\G2\A\E\Chronoforums\M\Post', 'Post', 'topic_id')
		->where('Post.id', $this->data('id'))
		->select('first');
		
		if(\GApp::access('chronoforums', 'posts_vote', (int)geta($topic, 'Post.user_id')) !== true){
			return ['error' => rl('You are not allowed to make votes on this post.')];
		}
		
		$Vote = new \G2\A\E\Chronoforums\M\Vote();
		
		if((int)$this->data('value') == 1){
			$result = $Vote->vote($this->data('id'), $this->data('value'));
			
			if($result !== true){
				return $result;
			}
			
			$this->set('post', ['id' => $this->data('id')]);
			$this->set('vote', 1);
			
			//send a notification to post author
			if((int)geta($topic, 'Post.user_id')){
				$Subscribed = new \G2\E\Chronoforums\L\Subscribed($this);
				$Subscribed->users([(int)geta($topic, 'Post.user_id')])->posts_vote($topic['Topic'], $topic['Post']);
			}
			
		}else{
			$result = $Vote->unvote($this->data('id'));
			
			if($result !== true){
				return $result;
			}
			
			$this->set('post', ['id' => $this->data('id')]);
		}
		
		$this->post();
	}
	
}
?>