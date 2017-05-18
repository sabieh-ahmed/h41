<?php
/**
* COMPONENT FILE HEADER
**/
namespace G2\A\E\Chronoforums\C;
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
class Tags extends \G2\L\Controller {
	var $models = array('\G2\A\E\Chronoforums\M\Tag', '\G2\A\M\Group');
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
		$this->Composer->paginate('Tag', $this->Tag);
		
		$order = $this->Composer->sorter(['tag_title' => 'Tag.title', 'tag_id' => 'Tag.id', 'tag_published' => 'Tag.published']);
		$this->Tag->order($order);
		
		$tags = $this->Tag->select();
		$this->set('tags', $tags);
	}
	
	//data reading
	function edit(){
		
		if(isset($this->data['save']) OR isset($this->data['apply'])){
			$result = false;
			if(!empty($this->data['Tag'])){
				$result = $this->Tag->save($this->data['Tag'], ['validate' => true, 'json' => ['params'], 'alias' => ['title' => 'alias']]);
			}
			
			if($result === true){
				
				if(isset($this->data['apply'])){
					$redirect = r_('index.php?ext=chronoforums&cont=tags&act=edit&id='.$this->Tag->id);
				}else{
					$redirect = r_('index.php?ext=chronoforums&cont=tags');
				}
				return ['success' => rl('Tag saved successfully.'), 'redirect' => $redirect];
			}else{
				
				$this->errors['Tag'] = $this->Tag->errors;
				unset($this->data['save']);
				unset($this->data['apply']);
				return ['error' => $this->Tag->errors, 'reload' => true];
			}
		}
		
		if(!empty($this->data['id'])){
			$tag = $this->Tag->where('id', $this->data('id', null))->select('first', ['json' => ['params']]);
			if(!empty($tag)){
				$this->data = $tag;
			}
			$this->set('tag', $tag);
		}
	}
	
	function toggle(){
		$result = $this->Tag->where('id', $this->data('gcb'))->update([$this->data('fld') => $this->data('val')]);
		
		if($result !== false){
			\GApp::session()->flash('success', rl('Tag updated successfully.'));
		}else{
			\GApp::session()->flash('error', rl('Tag update error.'));
		}
		
		$this->redirect(r_('index.php?ext=chronoforums&cont=tags'));
	}
	
	function delete(){
		if(is_array($this->data('gcb'))){
			
			$result = $this->Tag->where('id', $this->data('gcb'), 'in')->delete();
			
			if($result !== false){
				\GApp::session()->flash('success', rl('Tag deleted successfully.'));
			}else{
				\GApp::session()->flash('error', rl('Tag delete error.'));
			}
		}
		
		$this->redirect(r_('index.php?ext=chronoforums&cont=tags'));
	}
}
?>