<?php
/**
* COMPONENT FILE HEADER
**/
namespace G2\A\E\Chronoforums;
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
class Chronoforums extends \G2\L\Controller {
	var $models = array('\G2\A\E\Chronoforums\M\Forum', '\G2\A\M\Group', '\G2\A\M\Acl', '\G2\A\M\Extension');
	var $libs = array('\G2\L\Request');
	var $helpers= array(
		//'\G2\H\Display',
		'\G2\H\Html',
		'\G2\H\Sorter',
		'\G2\H\Paginator',
	);
	
	function _initialize(){
		$this->layout('default');
		
		if($this->_validated() === false){
			$session =\GApp::session();
			$domain = str_replace(array('http://', 'https://'), '', \G2\L\Url::domain());
			$session->flash('error', "Your ChronoForums installation on <strong>".$domain."</strong> is NOT validated, all the features are enabled but validating the install would remove the credits link below the forums pages and would help us continue the development process.");
		}
	}
	
	
	function index(){
		
		$Forum = new \G2\A\E\Chronoforums\M\Forum();
		$this->set('forums_count', $Forum->select('count'));
		
		$Topic = new \G2\A\E\Chronoforums\M\Topic();
		$this->set('topics_count', $Topic->select('count'));
		
		$Post = new \G2\A\E\Chronoforums\M\Post();
		$this->set('posts_count', $Post->select('count'));
		
		$Attachment = new \G2\A\E\Chronoforums\M\Attachment();
		$this->set('attachments_count', $Attachment->select('count'));
		
		$User = new \G2\A\M\User();
		$this->set('users_count', $User->select('count'));
	}
	
	function _validated(){
		$this->fparams = \GApp::extension('chronoforums')->settings();
		if((bool)$this->fparams->get('validated', 0) === true){
			return true;
		}
		return false;
	}
	
	function settings(){
		$this->data = $this->Extension->where('name', 'chronoforums')->select('first', ['json' => ['settings']]);
		
		//permissions groups
		$groups = $this->Group->fields(['id', 'title'])->select('list');
		$this->set('groups', $groups);
	}
	
	function save_settings(){
		$this->data['Extension']['name'] = 'chronoforums';
		$this->data['Extension']['enabled'] = 1;
		
		$result = $this->Extension->save($this->data['Extension'], ['json' => ['settings']]);
		
		if($result !== false){
			\GApp::session()->flash('success', rl('Settings saved successfully.'));
		}else{
			\GApp::session()->flash('error', rl('Error updating settings.'));
		}
		
		$this->redirect(r_('index.php?ext=chronoforums&act=settings'));
	}
	
	function users(){
		$return = [];
		$return['success'] = true;
		$return['results'] = [];
		
		if($this->data('q') AND strlen(trim($this->data('q'))) > 1){
			$User = new \G2\A\M\User();
			$users = $User->fields(['id', 'username'])->where('username', $this->data('q').'%', 'LIKE')->select('all');
			foreach($users as $user){
				$return['results'][] = ['name' => $user['User']['username'], 'value' => $user['User']['id']];
			}
		}
		
		return $return;
	}
	
	function permissions(){
		$perms = array(
			'index' => rl('Can access the forums'),
			'topics_add' => rl('Can create new topics'),
			'topics_moderate' => rl('Can manage and update topics'),
			'topics_feature' => rl('Can feature topics'),
			
			'posts_reply' => rl('Can post replies'),
			'posts_index' => rl('Can read topics'),
			'posts_edit' => rl('Can edit posts'),
			'posts_delete' => rl('Can delete posts'),
			'posts_report' => rl('Can post reports'),
			'posts_answer' => rl('Can select answers'),
			'posts_vote' => rl('Can vote for posts'),
			'reports_view' => rl('Can view posts reports'),
			'posts_private' => rl('Can view private content'),
			
			'attachments_list' => rl('Can view attachments list'),
			'attachments_download' => rl('Can download attachments files'),
			'attachments_attach' => rl('Can attach files'),
			
			'users_delete' => rl('Can delete users'),
			'messages_send' => rl('Can send private messages'),
		);
		$this->set('perms', $perms);
		
		//permissions groups
		$groups = array_merge([['Group' => ['id' => 'owner', 'title' => rl('Owner'), '_depth' => 0]]], $this->Group->select('flat'));
		$this->set('groups', $groups);
		
		$acl = $this->Acl->where('aco', 'ext=chronoforums')->select('first', ['json' => ['rules']]);
		if(!empty($acl)){
			$this->data = $acl;
		}
	}
	
	function save_permissions(){
		if(empty($this->data['Acl'])){
			$this->redirect(r_('index.php?ext=chronoforums&act=permissions'));
		}
		$this->data['Acl']['title'] = 'Chronoforums Front Permissions';
		$this->data['Acl']['aco'] = 'ext=chronoforums';
		$this->data['Acl']['enabled'] = 1;
		$result = $this->Acl->save($this->data['Acl'], ['json' => ['rules']]);
		
		if($result !== false){
			\GApp::session()->flash('success', rl('Permissions updated successfully.'));
		}else{
			\GApp::session()->flash('error', rl('Error updating permissions.'));
		}
		
		$this->redirect(r_('index.php?ext=chronoforums&act=permissions'));
	}
	
	function clear_cache(){
		$path = \G2\Globals::get('FRONT_PATH').'cache'.DS;
		$files = \G2\L\Folder::getFiles($path);
		$count = 0;
		foreach($files as $k => $file){
			if(basename($file) != 'index.html'){
				$result = \G2\L\File::delete($file);
				if($result){
					$count++;
				}
			}
		}
		if(function_exists('apc_delete')){
			apc_clear_cache('user');
		}
		$session = \GApp::session();
		$session->flash('info', $count.' '.rl('Cache files deleted successfully.'));
		$this->redirect(r_('index.php?ext=chronoforums'));
	}
	
	function _vupdate($v){
		$ext = $this->Extension->where('name', 'chronoforums')->select('first', ['json' => ['settings']]);
		if(empty($ext)){
			$ext = [];
			$ext['Extension']['name'] = 'chronoforums';
			$ext['Extension']['enabled'] = 1;
		}
		$ext['Extension']['settings']['validated'] = $v;
		$result = $this->Extension->save($ext['Extension'], ['json' => ['settings']]);
		return $result;
	}
	
	function validateinstall(){
		$domain = str_replace(array('http://', 'https://'), '', \G2\L\Url::domain());
		$this->set('domain', $domain);
		if(!empty($this->data['license_key'])){
			
			$fields = '';
			//$postfields = array();
			unset($this->data['option']);
			unset($this->data['act']);
			foreach($this->data as $key => $value){
				$fields .= "$key=".urlencode($value)."&";
			}
			
			$target_url = 'http://www.chronoengine.com/index.php?option=com_chronocontact&task=extra&chronoformname=validateLicense';
			
			$quick_url = $target_url.'&'.rtrim($fields, "& ");
			$response = get_headers($quick_url, 1);
			if(!empty($response['Content-Length']) AND $response['Content-Length'] == '5'){
				$result = $this->_vupdate(1);
				\GApp::session()->flash('success', 'Validated successflly.');
				$this->redirect(r_('index.php?ext=chronoforums'));
			}
			
			if(ini_get('allow_url_fopen')){
				$output = file_get_contents($target_url.'&'.rtrim($fields, "& "));
			}else if(function_exists('currlinit')){
				$ch = currlinit();
				currlsetopt($ch, CURLOPT_URL, $target_url);
				currlsetopt($ch, CURLOPT_HEADER, 0);
				currlsetopt($ch, CURLOPT_RETURNTRANSFER, true);
				currlsetopt($ch, CURLOPT_TIMEOUT, 10);
				currlsetopt($ch, CURLOPT_POSTFIELDS, rtrim($fields, "& "));
				$output = currlexec($ch);
				currlclose($ch);
			}
			$validstatus = $output;
			
			if($validstatus == 'valid'){
				$result = $this->_vupdate(1);
				
				if($result){
					\GApp::session()->flash('success', 'Validated successflly.');
					$this->redirect(r_('index.php?ext=chronoforums'));
				}else{
					\GApp::session()->flash('error', 'Validation error.');
				}
			}else if($validstatus == 'invalid'){
				$result = $this->_vupdate(0);
				
				\GApp::session()->flash('error', 'Validation error, you have provided incorrect data.');
				//$this->redirect(r_('index.php?ext=chronoforums'));
			}else{
				if(!empty($this->data['seriarl_number'])){
					$blocks = explode("-", trim($this->data['seriarl_number']));
					$hash = md5($this->data['pid'].$this->data['license_key'].str_replace('www.', '', $domain).$blocks[3]);
					if(substr($hash, 0, 7) == $blocks[4]){
						$result = $this->_vupdate(1);
						
						if($result){
							\GApp::session()->flash('success', 'Validated successfully.');
							$this->redirect(r_('index.php?ext=chronoforums'));
						}else{
							\GApp::session()->flash('error', 'Validation error.');
						}
					}else{
						\GApp::session()->flash('error', 'Serial number invalid!');
					}
				}
				\GApp::session()->flash('error', 'Validation error, your server does NOT have the CURL function enabled, please ask your host admin to enable the CURL, or please try again using the Instant Code, or please contact us on www.chronoengine.com');
				$this->redirect(r_('index.php?ext=chronoforums'));
			}
		}
	}
}
?>