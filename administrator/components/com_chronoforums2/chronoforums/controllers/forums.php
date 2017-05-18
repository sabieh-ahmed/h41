<?php
/**
* COMPONENT FILE HEADER
**/
namespace G2\A\E\Chronoforums\C;
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
class Forums extends \G2\L\Controller {
	var $models = array('\G2\A\E\Chronoforums\M\Forum', '\G2\A\M\Group');
	var $libs = array('\G2\L\Composer');
	var $helpers= array(
		//'\G2\H\Display',
		'\G2\H\Html',
		'\G2\H\Sorter',
		'\G2\H\Paginator',
	);
	
	function _initialize(){
		$this->layout('default');
	}
	
	function index(){
		$parents = $this->Forum->fields(['id', 'title'])->select('list');
		$this->set('parents', $parents);
		
		$this->Composer->paginate('Forum', $this->Forum);
		
		$order = $this->Composer->sorter(['forum_title' => 'Forum.title', 'forum_id' => 'Forum.id', 'forum_published' => 'Forum.published']);
		$this->Forum->order($order);
		
		$forums = $this->Forum->select();
		$this->set('forums', $forums);
	}
	
	//data reading
	function edit(){
		
		if(isset($this->data['save']) OR isset($this->data['apply'])){
			$result = false;
			if(!empty($this->data['Forum'])){
				$result = $this->Forum->save($this->data['Forum'], ['validate' => true, 'json' => ['rules'], 'alias' => ['title' => 'alias']]);
			}
			
			if($result === true){
				
				if(isset($this->data['apply'])){
					$redirect = r_('index.php?ext=chronoforums&cont=forums&act=edit&id='.$this->Forum->id);
				}else{
					$redirect = r_('index.php?ext=chronoforums&cont=forums');
				}
				return ['success' => rl('Forum saved successfully.'), 'redirect' => $redirect];
			}else{
				
				$this->errors['Forum'] = $this->Forum->errors;
				unset($this->data['save']);
				unset($this->data['apply']);
				return ['error' => $this->Forum->errors, 'reload' => true];
			}
		}
		
		if(!empty($this->data['id'])){
			$forum = $this->Forum->where('id', $this->data('id', null))->select('first', ['json' => ['rules', 'params']]);
			if(!empty($forum)){
				$this->data = $forum;
			}
			$this->set('forum', $forum);
		}
		
		//get forums list for parents
		$forums = $this->Forum->fields(['id', 'title', 'parent_id', 'type'])->where('Forum.id', $this->data('id', 0), '<>')->select('flat');
		$this->set('parents', \G2\L\Arr::getVal($forums, ['[n]', 'Forum']));
		
		//permissions groups
		$groups = $this->Group->select('flat');
		$this->set('groups', $groups);
		
		$perms = array(
			'index' => rl('Can access this forum'),
			//'topics_add' => rl('Can create new topics'),
			//'posts_reply' => rl('Can post replies'),
			//'posts_index' => rl('Can read topics'),
		);
		
		$this->set('perms', $perms);
	}
	
	function toggle(){
		$result = $this->Forum->where('id', $this->data('gcb'))->update([$this->data('fld') => $this->data('val')]);
		
		if($result !== false){
			\GApp::session()->flash('success', rl('Forum updated successfully.'));
		}else{
			\GApp::session()->flash('error', rl('Forum update error.'));
		}
		
		$this->redirect(r_('index.php?ext=chronoforums&cont=forums'));
	}
	
	function delete(){
		if(is_array($this->data('gcb'))){
			
			$result = $this->Forum->where('id', $this->data('gcb'), 'in')->delete();
			
			if($result !== false){
				\GApp::session()->flash('success', rl('Forum deleted successfully.'));
			}else{
				\GApp::session()->flash('error', rl('Forum delete error.'));
			}
		}
		
		$this->redirect(r_('index.php?ext=chronoforums&cont=forums'));
	}
	
	function update_path(){
		$forums = $this->Forum->select('flat');
		foreach($forums as $forum){
			$this->Forum->save($forum['Forum']);
		}
		\GApp::session()->flash('success', rl('Forums paths updated.'));
		$this->redirect(r_('index.php?ext=chronoforums&cont=forums'));
	}
	
	function counter_update(){
		if($this->data('type')){
			if($this->data('type') == 'topics'){
				$Topic = new \G2\A\E\Chronoforums\M\Topic();
				$count = $Topic->where('forum_id', $this->data('f'))->select('count');
				$this->Forum->where('id', $this->data('f'))->update(['topic_count' => $count]);
				echo $count;
			}
			
			if($this->data('type') == 'posts'){
				$Topic = new \G2\A\E\Chronoforums\M\Topic();
				$count = $Topic->where('forum_id', $this->data('f'))->fields(['SUM(post_count)' => 'post_count'])->select('first');
				$this->Forum->where('id', $this->data('f'))->update(['post_count' => $count['Topic']['post_count']]);
				echo is_null($count['Topic']['post_count']) ? 0 : $count['Topic']['post_count'];
			}
		}
	}
}
?>