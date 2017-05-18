<?php
/**
* COMPONENT FILE HEADER
**/
namespace G2\E\Chronoforums\C;
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
class Messages extends \G2\E\Chronoforums\Chronoforums {
	var $models = array('\G2\A\E\Chronoforums\M\Message', '\G2\A\E\Chronoforums\M\Discussion');//, '\G2\A\E\Chronoforums\M\MessageRecipient');
	var $helpers = ['\G2\E\Chronoforums\H\Bbcode'];
	
	function index(){
		$box = \GApp::session()->get('chronoforums_pm_box', 'inbox');
		$this->$box();
	}
	
	function inbox(){
		$user = \GApp::user();
		
		if(!$user->get('id')){
			return ['error' => rl('You are not allowed to access this page.')];
		}
		
		$this->Composer->pageHeader(rl('PM Inbox'), r_('index.php?ext=chronoforums&cont=messages'.rp('u', $user->get('id'))), '', 'inbox');
		$this->Composer->breadcrumb(rl('PM Inbox'), r_('index.php?ext=chronoforums&cont=messages'.rp('u', $user->get('id'))), '', 'inbox');
		
		\GApp::session()->set('chronoforums_pm_box', 'inbox');
		
		
		//get received message count
		$this->Discussion->withReceivedMessageCount();
		
		$this->Discussion
		->hasOne('\G2\A\E\Chronoforums\M\DiscussionUser', 'DiscussionUser', 'discussion_id')
		->where('DiscussionUser.user_id', $user->get('id'))
		->where('ReceivedMessage.Message.count', 0, '>')
		->where('DiscussionUser.deleted', 0);
		
		$this->Composer->paginate('chronoforums.messages.inbox.'.$user->get('id'), $this->Discussion);
		//get the first message data
		$this->Discussion->withFirstMessage();
		//get the last message data
		$this->Discussion->withLastMessage();
		//get message count
		$this->Discussion->withMessageCount();
		//get the first message data
		$this->Discussion->withRecipients();
		
		if(!empty($this->data['msg_filter']) AND $this->data['msg_filter'] == 'unread'){
			$this->Discussion->where('DiscussionUser.last_read', 'Last.created', '<', 'field');
		}
		
		$discussions = $this->Discussion
		->fields([
			'Discussion.*', 
			'DiscussionUser.*', 
		])
		->order(['Discussion.last_date' => 'desc'])
		->select('all');
		
		//pr($discussions);
		//die();
		
		$this->set('messages', $discussions);
		$this->view = 'inbox';
		$this->set('box', 'inbox');
	}
	
	function outbox(){
		$user = \GApp::user();
		
		if(!$user->get('id')){
			return ['error' => rl('You are not allowed to access this page.')];
		}
		
		$this->Composer->pageHeader(rl('PM Outbox'), r_('index.php?ext=chronoforums&cont=messages&act=outbox'.rp('u', $user->get('id'))), '', 'send');
		$this->Composer->breadcrumb(rl('PM Outbox'), r_('index.php?ext=chronoforums&cont=messages&act=outbox'.rp('u', $user->get('id'))), '', 'send');
		
		\GApp::session()->set('chronoforums_pm_box', 'outbox');
		
		//get received message count
		$this->Discussion->withSentMessageCount();
		
		$this->Discussion
		->hasOne('\G2\A\E\Chronoforums\M\DiscussionUser', 'DiscussionUser', 'discussion_id')
		->where('DiscussionUser.user_id', $user->get('id'))
		->where('SentMessage.Message.count', 0, '>')
		->where('DiscussionUser.deleted', 0);
		
		$this->Composer->paginate('chronoforums.messages.outbox.'.$user->get('id'), $this->Discussion);
		//get the first message data
		$this->Discussion->withFirstMessage();
		//get the last message data
		$this->Discussion->withLastMessage('out');
		//get message count
		$this->Discussion->withMessageCount();
		//get the first message data
		$this->Discussion->withRecipients();
		
		if(!empty($this->data['msg_filter']) AND $this->data['msg_filter'] == 'unread'){
			$this->Discussion->where('DiscussionUser.last_read', 'Last.created', '<', 'field');
		}
		
		$discussions = $this->Discussion
		->fields([
			'Discussion.*', 
			'DiscussionUser.*', 
		])
		->order(['Discussion.last_date' => 'desc'])
		->select('all');
		
		$this->set('messages', $discussions);
		$this->view = 'inbox';
		$this->set('box', 'outbox');
	}
	
	function read(){
		$user = \GApp::user();
		
		if(!$user->get('id')){
			return ['error' => rl('You are not allowed to access this page.')];
		}
		
		if(empty($this->data['d'])){
			return ['error' => rl('Message does not exist.')];
		}
		
		$discussion = $this->Discussion
		->hasOne('\G2\A\E\Chronoforums\M\DiscussionUser', 'DiscussionUser', 'discussion_id')
		->where('Discussion.id', $this->data('d'))
		->where('DiscussionUser.user_id', $user->get('id'))
		->select('first');
		if(empty($discussion)){
			return ['error' => rl('You are not allowed to access this page.')];
		}
		
		$posts_order = ['Message.created' => 'asc'];
		if(\GApp::user()->get('profile.params.posts_ordering', 'lastpost_asc') == 'lastpost_desc'){
			$posts_order = ['Message.created' => 'desc'];
		}
		
		$messages = $this->Message
		->belongsTo('\G2\A\M\User', 'Author', 'user_id', ['hasOne' => [['\G2\A\E\Chronoforums\M\Profile', 'AuthorProfile', 'user_id']]])
		->where('Message.discussion_id', $this->data('d'))
		->order($posts_order)
		->select('all');
		
		$this->set('messages', $messages);
		
		$this->Composer->pageHeader($discussion['Discussion']['subject'], r_('index.php?ext=chronoforums&cont=messages&act=read'.rp('d', $this->data)));
		$this->Composer->breadcrumb(rl('PM Inbox'), r_('index.php?ext=chronoforums&cont=messages'.rp('u', $user->get('id'))), '', 'inbox');
		
		if(!empty($messages)){
			$DiscussionUser = new \G2\A\E\Chronoforums\M\DiscussionUser();
			$DiscussionUser->where('discussion_id', $this->data('d'))->where('user_id', $user->get('id'))->update(['last_read' => date('Y-m-d H:i:s')]);
		}
	}
	
	function message($id){
		if(empty($id)){
			$id = $this->data('m');
		}
		
		$message = $this->Message
		->belongsTo('\G2\A\M\User', 'Author', 'user_id', ['hasOne' => [['\G2\A\E\Chronoforums\M\Profile', 'AuthorProfile', 'user_id']]])
		->where('Message.id', $id)
		->select('first');
		
		$this->set('message', $message);
		$this->view = 'message';
	}
	
	function send(){
		$user = \GApp::user();
		
		if(!$user->get('id')){
			return ['error' => rl('You are not allowed to access this page.')];
		}
		
		if(\GApp::access('chronoforums', 'messages_send') !== true){
			return ['error' => rl('You are not allowed to send new messages.'), 'redirect' => r_('index.php?ext=chronoforums&cont=messages'.rp('u', $user->get('id')))];
		}
		
		//check the users posts
		$Profile = new \G2\A\E\Chronoforums\M\Profile();
		$can = $Profile->checkApproval((int)$this->fparams->get('messages_posts_threshold', 1));
		
		if($can == false){
			return ['error' => rl('You can not send private messages yet.'), 'redirect' => r_('index.php?ext=chronoforums&cont=messages'.rp('u', $user->get('id')))];
		}
		
		//$this->data['Discussion']['id'] = $this->data('d', time().mt_rand(1000, 9999));
		
		if(isset($this->data['send'])){
			$return = $this->Discussion->store($this->data);
			
			if($return !== true){
				return ['error' => $return['error'], 'reload' => true];
			}else{
				//send notifications
				$Subscribed = new \G2\E\Chronoforums\L\Subscribed($this);
				$this->data['Discussion']['id'] = $this->Discussion->id;
				$Subscribed->users($this->data['DiscussionUser']['recipients'])->messages_send($this->data['Discussion'], $this->data['Message'], ['name' => $user->get('username')]);
				
				return ['success' => rl('Message sent successfully'), 'redirect' => r_('index.php?ext=chronoforums&cont=messages&act=read'.rp('d', $this->Discussion->id))];
			}
		}
		//auto select recipients
		if(!empty($this->data['recipient'])){
			$this->data['DiscussionUser']['recipients'][0] = $this->data['recipient'];
		}
		if(!empty($this->data['DiscussionUser']['recipients'])){
			$User = new \G2\A\M\User();
			$recipients = $User->where('id', $this->data['DiscussionUser']['recipients'], 'in')->select('all');
			if(!empty($recipients)){
				$this->set('recipients', \G2\L\Arr::getVal($recipients, '[n].User', []));
			}
		}
		
		$this->Composer->pageHeader(rl('New message'), r_('index.php?ext=chronoforums&cont=messages&act=send'.rp('u', $user->get('id'))), '', 'write');
		$this->Composer->breadcrumb(rl('New message'), r_('index.php?ext=chronoforums&cont=messages&act=send'.rp('u', $user->get('id'))), '', 'write');
		
		$this->set('box', 'compose');
	}
	
	function reply(){
		$user = \GApp::user();
		
		if(!$user->get('id')){
			return ['error' => rl('You are not allowed to access this page.')];
		}
		
		if(empty($this->data['d'])){
			return ['error' => rl('Message does not exist.')];
		}
		
		$this->data['d'] = trim($this->data('d'));
		
		$DiscussionUser = new \G2\A\E\Chronoforums\M\DiscussionUser();
		
		$recipient = $DiscussionUser
		->where('DiscussionUser.discussion_id', $this->data('d'))
		->where('DiscussionUser.user_id', $user->get('id'))
		->select('first');
		
		if(empty($recipient)){
			return ['error' => rl('You are not allowed to access this page.')];
		}
		
		$recipients = $DiscussionUser
		->where('DiscussionUser.discussion_id', $this->data('d'))
		->where('DiscussionUser.user_id', $user->get('id'), '<>')
		->select('all');
		
		$this->data['Discussion']['id'] = $this->data('d');
		
		$this->data['DiscussionUser']['recipients'] = \G2\L\Arr::getVal($recipients, '[n].DiscussionUser.user_id', []);
		
		$return = $this->Discussion->store($this->data, false);
		
		if($return !== true){
			return ['error' => $return['error'], 'continue' => true];
		}else{
			//send notifications
			$Subscribed = new \G2\E\Chronoforums\L\Subscribed($this);
			$Subscribed->users($this->data['DiscussionUser']['recipients'])->messages_send($this->data['Discussion'], $this->data['Message'], ['name' => $user->get('username')]);
			
			$this->message($this->Discussion->message_id);
		}
		
	}
	
	function recipients(){
		$return = [];
		$return['success'] = true;
		$return['results'] = [];
		
		if($this->data('q') AND strlen(trim($this->data('q'))) > 2){
			$User = new \G2\A\M\User();
			$users = $User->fields(['id', 'username'])->where('username', $this->data('q').'%', 'LIKE')->where('OR')->where('name', $this->data('q').'%', 'LIKE')->select('all');
			foreach($users as $user){
				$return['results'][] = ['name' => $user['User']['username'], 'value' => $user['User']['id']];
			}
		}else{
			$return['results'][] = ['name' => rl('You need to enter 3 characters at least.'), 'value' => 'x', 'disabled' => true];
		}
		
		return $return;
	}
	
	function delete(){
		$user = \GApp::user();
		
		if(!$user->get('id')){
			return ['error' => rl('You are not allowed to access this page.')];
		}
		
		if(empty($this->data['d'])){
			return ['error' => rl('Message does not exist.')];
		}
		
		$DiscussionUser = new \G2\A\E\Chronoforums\M\DiscussionUser();
		
		$result = $DiscussionUser->where('discussion_id', $this->data('d'))->where('user_id', $user->get('id'))->update(['deleted' => 1]);
		if($result === true){
			return ['success' => rl('Message deleted successfully.')];
		}else{
			return ['error' => rl('Deletion error.')];
		}
	}
}
?>