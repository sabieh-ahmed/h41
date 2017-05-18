<?php
/**
* COMPONENT FILE HEADER
**/
namespace G2\A\E\Chronoforums\C;
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
class Importer extends \G2\L\Controller {
	var $models = array('\G2\A\E\Chronoforums\M\Forum', '\G2\A\M\Group');
	var $libs = array('\G2\L\Composer');
	var $helpers= array(
		'\G2\H\Html',
		'\G2\H\Sorter',
		'\G2\H\Paginator',
	);
	
	function _initialize(){
		$this->layout('default');
	}
	
	function index(){
		if($this->data('source')){
			$source = $this->data('source');
			
			$db_options = [];
			if(!empty($this->data['db']['name'])){
				$db_options = $this->data['db'];
			}
			\GApp::session()->set('db_options', $db_options);
			
			$this->$source();
		}
	}
	
	function chronoforums1(){
		$this->set('source', $this->data('source'));
		$this->view = 'chronoforums1';
		
		$db_options = \GApp::session()->get('db_options', []);
		$dbo = \G2\L\Database::getInstance($db_options);
		
		$limit = 50;
		//start
		$startat = (int)$this->data('startat', 0);
		
		if($this->data('id')){
			if($this->data('id') == 'forums'){
				$task = $this->data('task', '');
				
				if(empty($task) OR $task == 'category'){
					$_Category = new \G2\L\Model(['dbo' => $dbo, 'name' => 'Category', 'table' => '#__forums_categories']);
					$Forum = new \G2\A\E\Chronoforums\M\Forum();
					//get count
					$count = (int)$this->data('count', 0);
					if(empty($count)){
						$count = $_Category->select('count');
					}
					//select data
					$items = $_Category->limit($limit)->offset($startat)->select('all');
					//insert data
					foreach($items as $item){
						$item['Category']['parent_id'] = 0;
						$item['Category']['type'] = 'category';
						$Forum->insert($item['Category'], ['ignore' => true]);
					}
					///
					if(1){
						if($startat + $limit < $count){
							return ['count' => $count, 'finished' => $startat + $limit, 'task' => 'category'];
						}else{
							return ['count' => 0, 'finished' => 0, 'task' => 'forum'];
						}
					}
				}else if($task == 'forum'){
					$Forum1 = new \G2\L\Model(['dbo' => $dbo, 'name' => 'Forum', 'table' => '#__forums_forums']);
					$Forum2 = new \G2\A\E\Chronoforums\M\Forum();
					//get count
					$count = (int)$this->data('count', 0);
					if(empty($count)){
						$count = $Forum1->select('count');
					}
					//select data
					$items = $Forum1->limit($limit)->offset($startat)->select('all');
					//insert data
					foreach($items as $item){
						$id = $item['Forum']['id'];
						$item['Forum']['parent_id'] = $item['Forum']['cat_id'];
						$item['Forum']['type'] = 'forum';
						unset($item['Forum']['id']);
						
						$Forum2->insert($item['Forum'], ['ignore' => true]);
						
						\GApp::session()->set('forums.'.$id, $Forum2->id);
					}
					///
					if(1){
						if($startat + $limit < $count){
							return ['count' => $count, 'finished' => $startat + $limit, 'task' => 'forum'];
						}else{
							return ['completed' => 1];
						}
					}
				}
			}
			
			if($this->data('id') == 'topics'){
				$task = $this->data('task', '');
				
				if(empty($task) OR $task == 'topic'){
					$Topic1 = new \G2\L\Model(['dbo' => $dbo, 'name' => 'Topic', 'table' => '#__forums_topics']);
					$Topic2 = new \G2\A\E\Chronoforums\M\Topic();
					//get count
					$count = (int)$this->data('count', 0);
					if(empty($count)){
						$count = $Topic1->select('count');
					}
					//select data
					$items = $Topic1->limit($limit)->offset($startat)->select('all', ['json' => ['params']]);
					//insert data
					foreach($items as $item){
						$item['Topic']['forum_id'] = \GApp::session()->get('forums.'.$item['Topic']['forum_id'], 0);;
						$item['Topic']['unique_id'] = !empty($item['Topic']['params']['uid']) ? $item['Topic']['params']['uid'] : '';
						unset($item['Topic']['params']);
						
						$Topic2->insert($item['Topic'], ['before' => false, 'ignore' => true]);
					}
					///
					if(1){
						if($startat + $limit < $count){
							return ['count' => $count, 'finished' => $startat + $limit, 'task' => 'topic'];
						}else{
							return ['count' => 0, 'finished' => 0, 'task' => 'favorite'];
						}
					}
				}else if($task == 'favorite'){
					$Favorite1 = new \G2\L\Model(['dbo' => $dbo, 'name' => 'Favorite', 'table' => '#__forums_topics_favorites']);
					$Favorite2 = new \G2\A\E\Chronoforums\M\Favorite();
					//get count
					$count = (int)$this->data('count', 0);
					if(empty($count)){
						$count = $Favorite1->select('count');
					}
					//select data
					$items = $Favorite1->limit($limit)->offset($startat)->select('all');
					//insert data
					foreach($items as $item){
						$Favorite2->insert($item['Favorite'], ['before' => false, 'ignore' => true]);
					}
					///
					if(1){
						if($startat + $limit < $count){
							return ['count' => $count, 'finished' => $startat + $limit, 'task' => 'favorite'];
						}else{
							return ['count' => 0, 'finished' => 0, 'task' => 'featured'];
						}
					}
				}else if($task == 'featured'){
					$Featured1 = new \G2\L\Model(['dbo' => $dbo, 'name' => 'Featured', 'table' => '#__forums_topics_featured']);
					$Featured2 = new \G2\A\E\Chronoforums\M\Featured();
					//get count
					$count = (int)$this->data('count', 0);
					if(empty($count)){
						$count = $Featured1->select('count');
					}
					//select data
					$items = $Featured1->limit($limit)->offset($startat)->select('all');
					//insert data
					foreach($items as $item){
						$Featured2->insert($item['Featured'], ['before' => false, 'ignore' => true]);
					}
					///
					if(1){
						if($startat + $limit < $count){
							return ['count' => $count, 'finished' => $startat + $limit, 'task' => 'featured'];
						}else{
							return ['count' => 0, 'finished' => 0, 'task' => 'subscriber'];
						}
					}
				}else if($task == 'subscriber'){
					$Subscriber1 = new \G2\L\Model(['dbo' => $dbo, 'name' => 'Subscriber', 'table' => '#__forums_subscribed']);
					$Subscriber2 = new \G2\A\E\Chronoforums\M\TopicSubscriber();
					//get count
					$count = (int)$this->data('count', 0);
					if(empty($count)){
						$count = $Subscriber1->select('count');
					}
					//select data
					$items = $Subscriber1->limit($limit)->offset($startat)->select('all');
					//insert data
					foreach($items as $item){
						$item['Subscriber']['notified'] = $item['Subscriber']['notify_status'];
						$Subscriber2->insert($item['Subscriber'], ['before' => false, 'ignore' => true]);
					}
					///
					if(1){
						if($startat + $limit < $count){
							return ['count' => $count, 'finished' => $startat + $limit, 'task' => 'subscriber'];
						}else{
							return ['count' => 0, 'finished' => 0, 'task' => 'track'];
						}
					}
				}else if($task == 'track'){
					$Track1 = new \G2\L\Model(['dbo' => $dbo, 'name' => 'Track', 'table' => '#__forums_topics_track']);
					$Track2 = new \G2\A\E\Chronoforums\M\TopicTrack();
					//get count
					$count = (int)$this->data('count', 0);
					if(empty($count)){
						$count = $Track1->select('count');
					}
					//select data
					$items = $Track1->limit($limit)->offset($startat)->select('all');
					//insert data
					foreach($items as $item){
						$Track2->insert($item['Track'], ['before' => false, 'ignore' => true]);
					}
					///
					if(1){
						if($startat + $limit < $count){
							return ['count' => $count, 'finished' => $startat + $limit, 'task' => 'track'];
						}else{
							return ['count' => 0, 'finished' => 0, 'task' => 'tag'];
						}
					}
				}else if($task == 'tag'){
					$Tag1 = new \G2\L\Model(['dbo' => $dbo, 'name' => 'Tag', 'table' => '#__forums_tags']);
					$Tag2 = new \G2\A\E\Chronoforums\M\Tag();
					//get count
					$count = (int)$this->data('count', 0);
					if(empty($count)){
						$count = $Tag1->select('count');
					}
					//select data
					$items = $Tag1->limit($limit)->offset($startat)->select('all');
					//insert data
					foreach($items as $item){
						$item['Tag']['alias'] = '';
						$Tag2->insert($item['Tag'], ['before' => false, 'ignore' => true, 'alias' => ['title' => 'alias']]);
					}
					///
					if(1){
						if($startat + $limit < $count){
							return ['count' => $count, 'finished' => $startat + $limit, 'task' => 'tag'];
						}else{
							return ['count' => 0, 'finished' => 0, 'task' => 'topic_tag'];
						}
					}
				}else if($task == 'topic_tag'){
					$TopicTag1 = new \G2\L\Model(['dbo' => $dbo, 'name' => 'Tagged', 'table' => '#__forums_tagged']);
					$TopicTag2 = new \G2\A\E\Chronoforums\M\TopicTag();
					//get count
					$count = (int)$this->data('count', 0);
					if(empty($count)){
						$count = $TopicTag1->select('count');
					}
					//select data
					$items = $TopicTag1->limit($limit)->offset($startat)->select('all');
					//insert data
					foreach($items as $item){
						$TopicTag2->insert($item['Tagged'], ['before' => false, 'ignore' => true]);
					}
					///
					if(1){
						if($startat + $limit < $count){
							return ['count' => $count, 'finished' => $startat + $limit, 'task' => 'topic_tag'];
						}else{
							return ['completed' => 1];
						}
					}
				}
			}
			
			if($this->data('id') == 'posts'){
				$task = $this->data('task', '');
				
				if(empty($task) OR $task == 'post'){
					$Post1 = new \G2\L\Model(['dbo' => $dbo, 'name' => 'Post', 'table' => '#__forums_posts']);
					$Post2 = new \G2\A\E\Chronoforums\M\Post();
					//get count
					$count = (int)$this->data('count', 0);
					if(empty($count)){
						$count = $Post1->select('count');
					}
					//select data
					$items = $Post1->limit($limit)->offset($startat)->select('all', ['json' => ['params']]);
					//insert data
					foreach($items as $item){
						$item['Post']['remote_address'] = !empty($item['Post']['params']['author_address']) ? $item['Post']['params']['author_address'] : '';
						unset($item['Post']['params']);
						
						$Post2->insert($item['Post'], ['before' => false, 'ignore' => true]);
					}
					///
					if(1){
						if($startat + $limit < $count){
							return ['count' => $count, 'finished' => $startat + $limit, 'task' => 'post'];
						}else{
							return ['count' => 0, 'finished' => 0, 'task' => 'attachment'];
						}
					}
				}else if($task == 'attachment'){
					$Attachment1 = new \G2\L\Model(['dbo' => $dbo, 'name' => 'Attachment', 'table' => '#__forums_posts_attachments']);
					$Attachment2 = new \G2\A\E\Chronoforums\M\Attachment();
					//get count
					$count = (int)$this->data('count', 0);
					if(empty($count)){
						$count = $Attachment1->select('count');
					}
					//select data
					$items = $Attachment1->limit($limit)->offset($startat)->select('all');
					//insert data
					foreach($items as $item){
						$Attachment2->insert($item['Attachment'], ['before' => false, 'ignore' => true]);
					}
					///
					if(1){
						if($startat + $limit < $count){
							return ['count' => $count, 'finished' => $startat + $limit, 'task' => 'attachment'];
						}else{
							return ['count' => 0, 'finished' => 0, 'task' => 'report'];
						}
					}
				}else if($task == 'report'){
					$Report1 = new \G2\L\Model(['dbo' => $dbo, 'name' => 'Report', 'table' => '#__forums_posts_reports']);
					$Report2 = new \G2\A\E\Chronoforums\M\Report();
					//get count
					$count = (int)$this->data('count', 0);
					if(empty($count)){
						$count = $Report1->select('count');
					}
					//select data
					$items = $Report1->limit($limit)->offset($startat)->select('all');
					//insert data
					foreach($items as $item){
						$Report2->insert($item['Report'], ['before' => false, 'ignore' => true]);
					}
					///
					if(1){
						if($startat + $limit < $count){
							return ['count' => $count, 'finished' => $startat + $limit, 'task' => 'report'];
						}else{
							return ['count' => 0, 'finished' => 0, 'task' => 'vote'];
						}
					}
				}else if($task == 'vote'){
					$Vote1 = new \G2\L\Model(['dbo' => $dbo, 'name' => 'Vote', 'table' => '#__forums_posts_votes']);
					$Vote2 = new \G2\A\E\Chronoforums\M\Vote();
					//get count
					$count = (int)$this->data('count', 0);
					if(empty($count)){
						$count = $Vote1->select('count');
					}
					//select data
					$items = $Vote1->limit($limit)->offset($startat)->select('all');
					//insert data
					foreach($items as $item){
						$Vote2->insert($item['Vote'], ['before' => false, 'ignore' => true]);
					}
					///
					if(1){
						if($startat + $limit < $count){
							return ['count' => $count, 'finished' => $startat + $limit, 'task' => 'vote'];
						}else{
							return ['count' => 0, 'finished' => 0, 'task' => 'answer'];
						}
					}
				}else if($task == 'answer'){
					$Answer1 = new \G2\L\Model(['dbo' => $dbo, 'name' => 'Answer', 'table' => '#__forums_answers']);
					$Answer2 = new \G2\A\E\Chronoforums\M\Answer();
					//get count
					$count = (int)$this->data('count', 0);
					if(empty($count)){
						$count = $Answer1->select('count');
					}
					//select data
					$items = $Answer1->limit($limit)->offset($startat)->select('all');
					//insert data
					foreach($items as $item){
						$Answer2->insert($item['Answer'], ['before' => false, 'ignore' => true]);
					}
					///
					if(1){
						if($startat + $limit < $count){
							return ['count' => $count, 'finished' => $startat + $limit, 'task' => 'answer'];
						}else{
							return ['completed' => 1];
						}
					}
				}
			}
			
			if($this->data('id') == 'pm'){
				$task = $this->data('task', '');
				
				if(empty($task) OR $task == 'message'){
					$Message1 = new \G2\L\Model(['dbo' => $dbo, 'name' => 'Message', 'table' => '#__forums_messages']);
					$MessageRecipient = new \G2\L\Model(['dbo' => $dbo, 'name' => 'MessageRecipient', 'table' => '#__forums_messages_recipients']);
					$Message1->hasOne($MessageRecipient, 'MessageRecipient', 'message_id');
					
					$Message2 = new \G2\A\E\Chronoforums\M\Message();
					$Discussion2 = new \G2\A\E\Chronoforums\M\Discussion();
					$DiscussionUser2 = new \G2\A\E\Chronoforums\M\DiscussionUser();
					//get count
					$count = (int)$this->data('count', 0);
					if(empty($count)){
						$count = $Message1->select('count');
					}
					//select data
					$items = $Message1->limit($limit)->offset($startat)->select('all', ['json' => ['params']]);
					//insert data
					foreach($items as $item){
						$item['Message']['remote_address'] = !empty($item['Message']['params']['author_address']) ? $item['Message']['params']['author_address'] : '';
						$item['Message']['user_id'] = $item['Message']['sender_id'];
						$item['Message']['discussion_id'] = !empty($item['MessageRecipient']['discussion_id']) ? $item['MessageRecipient']['discussion_id'] : time().mt_rand(1000, 9999);
						unset($item['Message']['params']);
						
						$Message2->insert($item['Message'], ['before' => false, 'ignore' => true]);
						//add discussion
						$discussion_exists = $Discussion2->where('id', $item['Message']['discussion_id'])->select('first');
						if(empty($discussion_exists)){
							$Discussion2->insert(['id' => $item['Message']['discussion_id'], 'subject' => $item['Message']['subject']]);
						}
						//add discussion user
						if(!empty($item['MessageRecipient'])){
							$user_exists = $DiscussionUser2->where('discussion_id', $item['Message']['discussion_id'])->where('user_id', $item['Message']['user_id'])->select('first');
							if(empty($user_exists)){
								$DiscussionUser2->insert([
									'discussion_id' => $item['Message']['discussion_id'], 
									'deleted' => $item['MessageRecipient']['hidden'],
									'user_id' => $item['Message']['user_id'],
									'last_read' => empty($item['MessageRecipient']['opened']) ? null : date('Y-m-d H:i:s', time()),
								], ['ignore' => true]);
							}
							
							$user_exists = $DiscussionUser2->where('discussion_id', $item['Message']['discussion_id'])->where('user_id', $item['MessageRecipient']['recipient_id'])->select('first');
							if(empty($user_exists)){
								if(!empty($item['MessageRecipient']['recipient_id']) AND ($item['Message']['user_id'] != $item['MessageRecipient']['recipient_id'])){
									//add discussion user
									$DiscussionUser2->insert([
										'discussion_id' => $item['Message']['discussion_id'], 
										'deleted' => $item['MessageRecipient']['hidden'],
										'user_id' => $item['MessageRecipient']['recipient_id'],
										'last_read' => empty($item['MessageRecipient']['opened']) ? null : date('Y-m-d H:i:s', time()),
									], ['ignore' => true]);
								}
							}
						}
					}
					///
					if(1){
						if($startat + $limit < $count){
							return ['count' => $count, 'finished' => $startat + $limit, 'task' => 'message'];
						}else{
							return ['completed' => 1];
						}
					}
				}
			}
			
			if($this->data('id') == 'profiles'){
				$task = $this->data('task', '');
				
				if(empty($task) OR $task == 'profile'){
					$Profile1 = new \G2\L\Model(['dbo' => $dbo, 'name' => 'Profile', 'table' => '#__forums_users_profiles']);
					$Profile2 = new \G2\A\E\Chronoforums\M\Profile();
					//get count
					$count = (int)$this->data('count', 0);
					if(empty($count)){
						$count = $Profile1->select('count');
					}
					//select data
					$items = $Profile1->limit($limit)->offset($startat)->select('all', ['json' => ['params']]);
					//insert data
					foreach($items as $item){
						$item['Profile']['location'] = !empty($item['Profile']['params']['location']) ? $item['Profile']['params']['location'] : (isset($item['Profile']['location']) ? $item['Profile']['location'] : '');
						$item['Profile']['website'] = !empty($item['Profile']['params']['website']) ? $item['Profile']['params']['website'] :(isset($item['Profile']['website']) ? $item['Profile']['website'] : '');
						$item['Profile']['signature'] = !empty($item['Profile']['params']['signature']) ? $item['Profile']['params']['signature'] : (isset($item['Profile']['signature']) ? $item['Profile']['signature'] : '');
						$item['Profile']['about'] = !empty($item['Profile']['params']['about']) ? $item['Profile']['params']['about'] : (isset($item['Profile']['about']) ? $item['Profile']['about'] : '');
						$item['Profile']['avatar'] = !empty($item['Profile']['params']['avatar']) ? $item['Profile']['params']['avatar'] : (!empty($item['Profile']['avatar']) ? $item['Profile']['avatar'] : '');
						
						$item['Profile']['params'] = json_encode($item['Profile']['params'], true);
						
						$Profile2->insert($item['Profile'], ['before' => false, 'ignore' => true]);
						
					}
					///
					if(1){
						if($startat + $limit < $count){
							return ['count' => $count, 'finished' => $startat + $limit, 'task' => 'profile'];
						}else{
							return ['completed' => 1];
						}
					}
				}
			}
			
			
		}
	}
}
?>