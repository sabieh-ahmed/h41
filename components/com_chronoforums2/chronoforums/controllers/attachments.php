<?php
/**
* COMPONENT FILE HEADER
**/
namespace G2\E\Chronoforums\C;
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
class Attachments extends \G2\E\Chronoforums\Chronoforums {
	var $models = array('\G2\A\E\Chronoforums\M\Attachment');
	
	
	function download(){
		if(\GApp::access('chronoforums', 'attachments_download') !== true){
			return ['error' => rl('You are not allowed to download attachments.')];
		}
		$file_id = $this->Request->data('file_id');
		$file = $this->Attachment->where('id', $file_id)->select('first');
		if(!empty($file)){
			$this->Attachment->where('id', $file_id)->update([], ['increment' => ['downloads' => 1]]);
			//get physical file name
			$filename = $file['Attachment']['vfilename'];
			$real_filename = $file['Attachment']['filename'];
			
			$attachments_path = $this->fparams->get('attachments_path');
			
			if(file_exists($attachments_path.$filename)){
				$ext = pathinfo($attachments_path.$filename, PATHINFO_EXTENSION);
				$inline_extensions = $this->fparams->get('inline_extensions', 'jpg-png-gif');
				$inline_extensions = explode('-', $inline_extensions);
				$view = 'D';
				if(in_array(strtolower($ext), $inline_extensions)){
					$view = 'I';
				}
				\G2\L\Download::send($attachments_path.$filename, $view, $real_filename);
			}else{
				
			}
		}
	}
	
	function attach(){
		$session = \GApp::session();
		$user = \GApp::user();
		
		if((bool)$this->fparams->get('attach_files', 1) === true AND \GApp::access('chronoforums', 'attachments_attach') === true){
			
			if(empty($_FILES['attachment']['name'])){
				return ['error' => rl('No file received.')];
			}
			$file = $_FILES['attachment'];
			
			$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
			$allowed_extensions = explode('-', $this->fparams->get('allowed_extensions', 'jpg-png-gif-zip-pdf-doc-docx-txt'));
			if(!in_array($ext, $allowed_extensions)){
				return ['error' => rl('The file extension is not in the allowed list of %s', [implode(', ', $allowed_extensions)])];
			}
			if($file['size']/1000 > (int)$this->fparams->get('attachment_max_size', 1000)){
				return ['error' => rl('File size exceeds the maximum limit of %s', [$this->fparams->get('attachment_max_size', 1000)])];
			}
			$fname = \G2\L\Str::slug($file['name']);
			$file['name'] = \G2\L\File::makeSafe($file['name']);
			
			$fname = $user->get('id').'_'.date('YmdHis').'_'.$fname;
			$vfilename = $fname.'.'.$ext;
			
			$target = $this->fparams->get('attachments_path').$vfilename;
			
			$saved = \G2\L\Upload::save($file['tmp_name'], $target);
			if(!$saved){
				return ['error' => rl('Error saving the attachment file.')];
			}else{
				if(isset($this->data['Attachment'])){
					$count = count($this->data['Attachment']);
				}else{
					$count = 0;
				}
				$attachment = [];
				$attachment['vfilename'] = $vfilename;
				$attachment['filename'] = $file['name'];
				$attachment['comment'] = '';
				$attachment['id'] = '';
				$attachment['size'] = filesize($target);
				$this->set('file', $attachment);
				$this->view = 'views.attachments.editor_attachment';
			}
		}else{
			return ['error' => rl('You are not allowed to attach files.')];
		}
		
	}
	
	function delete(){
		if(!$this->data('id')){
			return ['error' => 0];
		}
		
		if(\GApp::access('chronoforums', 'posts_edit') !== true){
			return ['error' => rl('You are not allowed to edit posts.')];
		}
		
		//return $this->_delete([['id', $this->data('id')]]);
		$attachments = $this->Attachment->where('id', $this->data('id'))->fields(['id', 'vfilename'])->select('all');
		
		$result = $this->Attachment->where('id', $this->data('id'))->delete();
		if($result !== false){
			$this->Attachment->removeFiles($attachments);
			return true;
		}
		return false;
	}
}
?>