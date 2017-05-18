<?php
/**
* COMPONENT FILE HEADER
**/
namespace G2\E\Chronoforums\C;
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
class Topics extends \G2\E\Chronoforums\Chronoforums {
	var $models = array('\G2\A\E\Chronoforums\M\Topic');
	//var $libs = array('\G2\L\Request', '\G2\L\Composer');
	
	function index(){
		$user = \GApp::user();
		$forum = $this->get('_forum');
		
		if($this->data('f')){
			\GApp::document()->title(\GApp::document()->title().' - '.$forum['title']);
			
			if(!empty($forum['description'])){
				\GApp::document()->meta('description', $forum['description']);
			}
			
			$this->Composer->pageHeader($forum['title'], r_('index.php?ext=chronoforums&cont=topics&f='.$forum['id'].'&alias='.$forum['alias']));
			$this->Composer->breadcrumb($forum['title'], r_('index.php?ext=chronoforums&cont=topics&f='.$forum['id'].'&alias='.$forum['alias']));
			
			//get subforums
			$Forum = new \G2\A\E\Chronoforums\M\Forum();
			$forums = $Forum
			->fields([
				'Forum.*', 
				'LastPost.id', 'LastPost.topic_id', 'LastPost.created',
				'LastPostUser.id', 'LastPostUser.username', 'LastPostUser.name',
				'LastPostUserProfile.*',
			])
			->where('Forum.published', 1)->where('Forum.path', $forum['path'].$forum['id'].'.%', 'LIKE')
			->belongsTo('\G2\A\E\Chronoforums\M\Post', 'LastPost', 'last_post', ['belongsTo' => [['\G2\A\M\User', 'LastPostUser', 'user_id'], ['\G2\A\E\Chronoforums\M\Profile', 'LastPostUserProfile', 'user_id']]])
			->order(['Forum.ordering' => 'asc'])
			->select('flat', ['json' => ['rules'], 'parent_id' => $this->data('f')]);
			$this->set('forums', $forums);
		}else{
			if(empty($this->data['tagged']) AND empty($this->data['status']) AND empty($this->data['keywords'])){
				if((bool)$this->fparams->get('enable_full_topics_list', 1) === false){
					return ['redirect' => r_('index.php?ext=chronoforums')];
				}
			}
		}
		
		if(\GApp::access('chronoforums', 'topics_moderate') !== true){
			$this->Topic->where('Topic.published', 1);
		}
		if(!empty($this->data['f'])){
			$this->Topic->where('Topic.forum_id', (int)$this->data['f']);
		}
		
		if((int)$this->fparams->get('enable_topics_tags', 1)){
			if(!empty($this->data['tagged'])){
				$this->Topic->isTagged($this->data['tagged']);
				
				$Tag = new \G2\A\E\Chronoforums\M\Tag();
				$tag = $Tag->where('alias', $this->data('tagged'))->select('first');
				$this->Composer->breadcrumb($tag['Tag']['title'], r_('index.php?ext=chronoforums&cont=topics'.rp('tagged', $tag['Tag']['alias'])), rl('Topics tagged by').' %s');
			}
		}
		
		$result = $this->applyStatus();
		if($result !== true){
			return $result;
		}
		
		$this->Search();
		
		$this->Composer->paginate('chronoforums.topics.'.$this->data('f', 0).$this->data('tagged', '').\G2\L\Str::slug($this->data('keywords', '')), $this->Topic, $this->fparams->get('topics_limit'));
		
		//pr($this->Topic->dbo->log);
		
		$this->setTopics();
	}
	
	function Search(){
		if($this->data('keywords')){
			$this->Composer->pageHeader($this->data('keywords'), r_('index.php?ext=chronoforums&cont=topics'.rp('keywords', $this->data('keywords'))), rl('Results found for').' %s');
			$this->Composer->breadcrumb($this->data('keywords'), r_('index.php?ext=chronoforums&cont=topics'.rp('keywords', $this->data('keywords'))), rl('Results found for').' %s');
		}
		
		$this->Topic->hasKeywords($this->data('keywords'));
	}
	
	function applyStatus(){
		$user = \GApp::user();
		
		if(!empty($this->data['status'])){
			if($this->data['status'] == 'unanswered'){
				$this->Topic->where('Topic.post_count', 1);
			}
			if($this->data['status'] == 'unpublished'){
				if(\GApp::access('chronoforums', 'topics_moderate') === true){
					$this->Topic->isUnpublished();
				}else{
					return ['error' => rl('You are not allowed to access this page.'), 'redirect' => r_('index.php?ext=chronoforums'.rp('f', $this->data))];
				}
			}
			if($this->data['status'] == 'active'){
				$this->Topic->isAfter(date('Y-m-d H:i:s', strtotime('-'.((int)$this->fparams->get('active_topic_days', 7)).' day', mktime(0, 0, 0))));
			}
			if($this->data['status'] == 'new'){
				if($user->get('profile.last_visit')){
					$this->Topic->isAfter($user->get('profile.last_visit'));
				}else{
					
				}
			}
			if($this->data['status'] == 'featured'){
				$this->Topic->isFeatured();
			}
			if($this->data['status'] == 'favorites'){
				if($user->get('id')){
					$this->Topic->isFavorite($user->get('id'));
				}else{
					return ['error' => rl('You are not allowed to access this page.'), 'redirect' => r_('index.php?ext=chronoforums')];
				}
			}
		}
		
		return true;
	}
	
	function setTopics(){
		//load tags
		if((int)$this->fparams->get('enable_topics_tags', 1)){
			$this->Topic->withTags();
		}
		//show reported icon
		if(\GApp::access('chronoforums', 'reports_view') === true){
			$this->Topic->withReport();
		}
		//get the featured status
		if($this->data('status') != 'featured'){
			$this->Topic->hasOne('\G2\A\E\Chronoforums\M\Featured', 'Featured', 'topic_id');
		}
		//get tracked topics
		if(\GApp::user()->get('id') AND (bool)\GApp::user()->get('profile.params.enable_topics_track', 0) !== false){
			$this->Topic->withTopicTrack();
		}
		//get answered post
		$this->Topic->withAnswer();
		//get votes count
		$this->Topic->withVotesCount();
		
		
		$topics = $this->Topic
		->fields([
			'Topic.*', 
			'Forum.id', 'Forum.title', 'Forum.alias',
			'Author.id', 'Author.name', 'Author.username', 
			'AuthorProfile.*', 
			'LastPost.id', 'LastPost.created', 'LastPost.text', 'LastPost.topic_id', 
			'LastPostUser.id', 'LastPostUser.name', 'LastPostUser.username', 
			'LastPostUserProfile.*',
			//'TopicTrack.*',
			'Featured.*',
		])
		->belongsTo('\G2\A\E\Chronoforums\M\Forum', 'Forum', 'forum_id')
		->belongsTo('\G2\A\M\User', 'Author', 'user_id', ['hasOne' => [['\G2\A\E\Chronoforums\M\Profile', 'AuthorProfile', 'user_id']]])
		->belongsTo('\G2\A\E\Chronoforums\M\Post', 'LastPost', 'last_post', ['belongsTo' => [['\G2\A\M\User', 'LastPostUser', 'user_id'], ['\G2\A\E\Chronoforums\M\Profile', 'LastPostUserProfile', 'user_id']]])
		->order(['LastPost.created' => 'desc'])
		->group(['Topic.id'])
		->select('all');
		$this->set('topics', $topics);
		
		$this->view = 'index';
		
		if((bool)$this->fparams->get('enable_rss', 1) === true AND $this->data('_format') == 'rss'){
			$this->view = 'index_rss';
		}
	}
	
	function split(){
		if(empty($this->data['t'])){
			return ['error' => rl('Topic does not exist.')];
		}
		$topic = $this->Topic->where('id', $this->data['t'])->select('first');
		
		if(empty($topic)){
			return ['error' => rl('Topic does not exist.')];
		}
		
		if(\GApp::access('chronoforums', 'topics_moderate', $topic['Topic']['user_id']) !== true){
			return ['error' => rl('You are not allowed to edit topics.')];
		}
		
		if(empty($this->data['p'])){
			return ['error' => rl('Split post id missing.')];
		}
		
		$Post = new \G2\A\E\Chronoforums\M\Post();
		
		$splitPost = $Post->where('id', $this->data['p'])->select('first');
		
		if(empty($splitPost)){
			return ['error' => rl('Split post does not exist.')];
		}
		
		//clone topic
		$clone = $topic['Topic'];
		unset($clone['id']);
		unset($clone['modified']);
		unset($clone['alias']);
		unset($clone['hits']);
		$clone['user_id'] = $splitPost['Post']['user_id'];
		$clone['created'] = $splitPost['Post']['created'];
		$clone['post_count'] = $Post->where('topic_id', $topic['Topic']['id'])->where('created', $splitPost['Post']['created'], '>=')->select('count');
		
		//update post count of old topic
		$this->Topic->where('id', $topic['Topic']['id'])->decrement('post_count', $clone['post_count']);
		$lastpost = $Post->where('topic_id', $topic['Topic']['id'])->where('created', $splitPost['Post']['created'], '<')->order(['Post.created' => 'desc'])->select('first');
		$this->Topic->where('id', $topic['Topic']['id'])->update(['last_post' => $lastpost['Post']['id']]);
		//insert clone
		$this->Topic->insert($clone);
		
		$Post->where('topic_id', $topic['Topic']['id'])->where('created', $splitPost['Post']['created'], '>=')->update(['topic_id' => $this->Topic->id]);
		//subscribe users to the new topic
		$posters = $Post->where('topic_id', $this->Topic->id)->fields(['Post.id', 'Post.user_id'])->select('list');
		$posters = array_filter(array_unique($posters));
		
		$TopicSubscriber = new \G2\A\E\Chronoforums\M\TopicSubscriber();
		foreach($posters as $poster){
			$TopicSubscriber->subscribe($this->Topic->id, $poster);
		}
		
		return ['success' => rl('Topic has been splitted successfully.'), 'redirect' => r_('index.php?ext=chronoforums&cont=topics&act=edit&t='.$this->Topic->id)];
		
	}
	
	function edit(){
		if(empty($this->data['t'])){
			return ['error' => rl('Topic does not exist.')];
		}
		//load topic data
		if((int)$this->fparams->get('enable_topics_tags', 1)){
			$this->Topic->hasMany('\G2\A\E\Chronoforums\M\TopicTag', 'TopicTag', 'topic_id');
		}
		$topic = $this->Topic->where('id', $this->data['t'])->select('first');
		
		if(empty($topic)){
			return ['error' => rl('Topic does not exist.')];
		}
		
		if(\GApp::access('chronoforums', 'topics_moderate', $topic['Topic']['user_id']) !== true){
			return ['error' => rl('You are not allowed to edit topics.')];
		}
		
		//update topic
		if(isset($this->data['edit'])){
			$topic_data['id'] = $this->data['t'];
			$topic_data['title'] = $this->data['Topic']['title'];
			$topic_data['forum_id'] = $this->data['f'];
			
			//save topic
			$result = $this->Topic->store($topic_data, false);
			if($result !== true){
				return array_merge($result, ['reload' => true]);
			}
			
			//update tags
			if((int)$this->fparams->get('enable_topics_tags', 1)){
				$TopicTag = new \G2\A\E\Chronoforums\M\TopicTag();
				$TopicTag->where('topic_id', $topic_data['id'])->delete();
				$TopicTag->store($this->data['tags'], $topic_data['id']);
			}
			
			if($this->data['f'] != $topic['Topic']['forum_id']){
				$Forum = new \G2\A\E\Chronoforums\M\Forum();
				//update old forum data
				$Forum->updateLastPost($topic['Topic']['forum_id']);
				$Forum->where('id', (int)$topic['Topic']['forum_id'])->decrement('topic_count');
				$Forum->where('id', (int)$topic['Topic']['forum_id'])->decrement('post_count', (int)$topic['Topic']['post_count']);
				//update new forum data
				$Forum->updateLastPost($this->data['f']);
				$Forum->where('id', (int)$this->data['f'])->increment('topic_count');
				$Forum->where('id', (int)$this->data['f'])->increment('post_count', (int)$topic['Topic']['post_count']);
			}
			
			return ['success' => rl('Topic updated successfully.'), 'redirect' => r_('index.php?ext=chronoforums&cont=posts&t='.$this->Topic->id)];
		}
		//get tags
		if((int)$this->fparams->get('enable_topics_tags', 1)){
			$this->setTags();
			$this->data['tags'] = \G2\L\Arr::getVal($topic, ['TopicTag', '[n]', 'tag_id']);
		}
		
		$this->data['Topic'] = $topic['Topic'];
		$this->data['t'] = $topic['Topic']['id'];
		$this->data['f'] = $topic['Topic']['forum_id'];
		
		$this->setForums();
		
		//$this->set('disable_editor', true);
		$this->view = 'views.topics.edit';
		
		$this->Composer->pageHeader(rl('Edit topic'), '', '%s', 'write');
		$this->Composer->breadcrumb(rl('Edit topic'), '', '%s', 'write');
	}
	
	function add(){
		if(\GApp::access('chronoforums', 'topics_add') !== true){
			return ['error' => rl('You are not allowed to post topics.'), 'redirect' => r_('index.php?ext=chronoforums'.rp('f', $this->data))];
		}
		
		$_forum = $this->get('_forum');
		if(!empty($_forum['type']) AND $_forum['type'] != 'forum'){
			return ['error' => rl('You are not allowed to post topics here.'), 'redirect' => r_('index.php?ext=chronoforums')];
		}
		
		//save topic
		if(isset($this->data['add'])){
			//check anti spam
			if((bool)$this->get('fparams')->get('gcaptcha_enabled', 0) == true AND count(array_intersect($this->get('fparams')->get('gcaptcha_groups', []), \GApp::user()->get('groups')))){
				$response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$this->get('fparams')->get('gcaptcha_secretkey', 0).'&response='.$this->data('g-recaptcha-response'));
				$response = json_decode($response, true);
				
				if($response['success'] !== true){
					return ['error' => rl('The google captcha check has failed.'), 'reload' => true];
				}
			}
			//flooding check
			if((int)$this->fparams->get('flooding_limit', 30) > 0){
				$current_flooding = \GApp::session()->get('last_forum_post', 0);
				if(!empty($current_flooding) AND (int)$this->fparams->get('flooding_limit', 30) + $current_flooding > time()){
					return ['error' => rl('You have to wait some time before you can make a new post.'), 'reload' => true];
				}else{
					\GApp::session()->set('last_forum_post', time());
				}
			}
			
			$postsController = $this->getController('posts');
			
			$topic = [];
			$topic['title'] = $this->data['Topic']['title'];
			$topic['published'] = (int)($this->fparams->get('auto_publish_topics', 0) OR \GApp::access('chronoforums', 'topics_moderate'));
			$topic['forum_id'] = $this->data['f'];
			
			if($topic['published'] == 0){
				$auto_approval = $postsController->checkAutoApproval();
				if(is_array($auto_approval)){
					return array_merge($auto_approval, ['reload' => true]);
				}else{
					$topic['published'] = (int)$auto_approval;
				}
			}
			
			//save topic
			$result = $this->Topic->store($topic, $this->data('Post.text'), $this->data('Attachment', []));
			if($result !== true){
				return array_merge($result, ['reload' => true]);
			}
			
			//save tags
			if((int)$this->fparams->get('enable_topics_tags', 1) AND !empty($this->data['tags']) AND count($this->data['tags']) <= (int)$this->fparams->get('topics_tags_limit', 3)){
				$TopicTag = new \G2\A\E\Chronoforums\M\TopicTag();
				$TopicTag->store($this->data['tags'], $this->Topic->id);
			}
			//subscribe the author and send notifications
			$Subscribed = new \G2\E\Chronoforums\L\Subscribed($this);
			$topic['id'] = $this->Topic->id;
			$Subscribed->groups($this->fparams->get('topics_notification_groups', []))->topics_add($topic, $this->Topic->post_id);
			
			//update last post
			$this->Topic->updateLastPost($this->Topic->id, $this->Topic->post_id);
			//update topic count
			$Forum = new \G2\A\E\Chronoforums\M\Forum();
			$Forum->where('id', (int)$topic['forum_id'])->increment('topic_count');
			$Forum->where('id', (int)$topic['forum_id'])->increment('post_count');
			//update forum
			$Forum->updateLastPost((int)$topic['forum_id'], $this->Topic->post_id);
			//auto responder
			$postsController->autoReply($this->Topic->id);
			
			if(empty($topic['published'])){
				return ['success' => rl('Topic has been created but is still waiting moderation.'), 'redirect' => r_('index.php?ext=chronoforums&cont=posts&t='.$this->Topic->id)];
			}else{
				return ['success' => rl('Topic has been created successfully.'), 'redirect' => r_('index.php?ext=chronoforums&cont=posts&t='.$this->Topic->id)];
			}
			
		}
		
		$this->set('topic', ['id' => 0]);
		$this->view = 'views.topics.edit';
		
		$_forum = $this->get('_forum');
		if(!empty($_forum['type']) AND $_forum['type'] != 'forum'){
			$this->data['f'] = 0;
		}
		//main add view
		if(empty($this->data['f'])){
			$this->setForums();
		}else{
			$this->data['Topic']['forum_id'] = $this->data['f'];
			$this->set('select_forum', true);
		}
		
		//get tags
		if((int)$this->fparams->get('enable_topics_tags', 1)){
			$this->setTags();
		}
		
		$this->Composer->pageHeader(rl('New topic'), '', '%s', 'talk');
		$this->Composer->breadcrumb(rl('New topic'), '', '%s', 'talk');
	}
	
	function setForums(){
		//get forums list for parents
		$Forum = new \G2\A\E\Chronoforums\M\Forum();
		$forums = $Forum->fields(['id', 'title', 'parent_id', 'type'])->where('Forum.published', 1)/*->where('type', 'forum')*/->select('flat');
		$this->set('parents', \G2\L\Arr::getVal($forums, ['[n]', 'Forum']));
	}
	
	function setTags(){
		//get tags
		$public = \GApp::access('chronoforums', 'topics_moderate');
		
		$Tag = new \G2\A\E\Chronoforums\M\Tag();
		$tags = $Tag->getList($public);
		$this->set('tags', $tags);
	}
	
	function publish(){
		if(\GApp::access('chronoforums', 'topics_moderate') !== true){
			return ['error' => rl('You are not allowed to update this topic.')];
		}
		
		$result = $this->Topic->publish($this->data('id'), (int)$this->data('value'));
		
		if($result !== true){
			return $result;
		}
		
		$this->set('topic', ['id' => $this->data('id'), 'published' => (int)$this->data('value')]);
		$this->view = 'views.topics.publish_link';
	}
	
	function lock(){
		if(\GApp::access('chronoforums', 'topics_moderate') !== true){
			return ['error' => rl('You are not allowed to update this topic.')];
		}
		
		$result = $this->Topic->lock($this->data('id'), (int)$this->data('value'));
		
		if($result !== true){
			return $result;
		}
		
		$this->set('topic', ['id' => $this->data('id'), 'locked' => (int)$this->data('value')]);
		$this->view = 'views.topics.lock_link';
	}
	
	function delete(){
		if(\GApp::access('chronoforums', 'topics_moderate') !== true){
			return ['error' => rl('You are not allowed to delete this topic.')];
		}
		
		if(empty($this->data['id'])){
			return ['error' => rl('Topic does not exist.')];
		}
		
		$topic = $this->Topic->where('id', $this->data['id'])->select('first');
		
		$result = $this->Topic->remove($this->data('id'));
		if($result !== true){
			return $result;
		}
		//update topic count
		$Forum = new \G2\A\E\Chronoforums\M\Forum();
		$Forum->where('id', (int)$topic['Topic']['forum_id'])->decrement('topic_count');
		$Forum->where('id', (int)$topic['Topic']['forum_id'])->decrement('post_count', (int)$topic['Topic']['post_count']);
		$Forum->updateLastPost((int)$topic['Topic']['forum_id']);
		
		return ['success' => rl('Topic has been deleted successfully.'), 'redirect' => r_('index.php?ext=chronoforums&cont=topics&f='.$topic['Topic']['forum_id'])];
	}
	
	function subscribe(){
		if(\GApp::access('chronoforums', 'posts_reply') !== true){
			return ['error' => rl('You are not allowed to subscribe to topics.')];
		}
		
		$TopicSubscriber = new \G2\A\E\Chronoforums\M\TopicSubscriber();
		
		if((int)$this->data('value') == 1){
			$result = $TopicSubscriber->subscribe((int)$this->data('id'));
			
			if($result !== true){
				return $result;
			}
			
			$this->set('topic', ['id' => $this->data('id')]);
			$this->set('subscribed', 1);
		}else{
			$result = $TopicSubscriber->unsubscribe((int)$this->data('id'));
			
			if($result !== true){
				return $result;
			}
			
			$this->set('topic', ['id' => $this->data('id')]);
		}
		
		$this->view = 'views.topics.subscribe_link';
	}
	
	function favorite(){
		if(\GApp::access('chronoforums', 'posts_reply') !== true){
			return ['error' => rl('You are not allowed to select favorites.')];
		}
		
		$Favorite = new \G2\A\E\Chronoforums\M\Favorite();
		
		if((int)$this->data('value') == 1){
			$result = $Favorite->add((int)$this->data('id'));
			
			if($result !== true){
				return $result;
			}
			
			$this->set('topic', ['id' => $this->data('id')]);
			$this->set('favorite', 1);
		}else{
			$result = $Favorite->remove((int)$this->data('id'));
			
			if($result !== true){
				return $result;
			}
			
			$this->set('topic', ['id' => $this->data('id')]);
		}
		
		$this->view = 'views.topics.favorite_link';
	}
	
	function feature(){
		if(\GApp::access('chronoforums', 'topics_feature') !== true){
			return ['error' => rl('You are not allowed to feature topics.')];
		}
		
		$Featured = new \G2\A\E\Chronoforums\M\Featured();
		
		if((int)$this->data('value') == 1){
			$result = $Featured->add((int)$this->data('id'));
			
			if($result !== true){
				return $result;
			}
			
			$this->set('topic', ['id' => $this->data('id')]);
			$this->set('featured', 1);
		}else{
			$result = $Featured->remove((int)$this->data('id'));
			
			if($result !== true){
				return $result;
			}
			
			$this->set('topic', ['id' => $this->data('id')]);
		}
		
		$this->view = 'views.topics.feature_link';
	}
}
?>