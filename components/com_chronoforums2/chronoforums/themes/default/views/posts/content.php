<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php
	$content = $post['Post']['text'];
	//$user = $post['Author'];
	
	if(!empty($this->data['keywords'])){
		$keywords = explode(' ', str_replace('"', '', $this->data['keywords']));
		foreach($keywords as $keyword){
			$content = str_ireplace($keyword, '[color=#a333c8][b][u]'.$keyword.'[/u][/b][/color]', $content);
		}
	}
	
	$content = $this->Bbcode->parse($content);
	
	if($this->get('fparams')->get('enable_private_data', 1)){
		$content = preg_replace_callback('/\[private\](.*?)\[\/private\]/msi', function($s) use ($user){
			$private_area = '
			<div class="ui segment">
				<div class="ui top attached label icon _TYPE_"><i class="icon privacy"></i>'.rl('Private content').'</div>
				<div class="">_CONTENT_</div>
			</div>';
			if(\GApp::access('chronoforums', 'posts_private', (int)geta($user, 'id')) === true){
				return str_replace(array('_TYPE_', '_CONTENT_'), array('orange', $s[1]), $private_area);
			}else{
				return str_replace(array('_TYPE_', '_CONTENT_'), array('red', rl('The content here is visible only for authorized users.')), $private_area);
			}
		}, $content);
	}
	
	$inline_attachments_keys = array();
	//remove the inline files
	preg_match_all('/\[attachment=(.*?)](.*?)\[\/attachment\]/ms', $content, $inline_files);
	if(isset($inline_files[1]) AND !empty($inline_files[1]) AND is_array($inline_files[1])){
		$inline_attachments_keys = $inline_files[1];
	}
	
	if(!empty($inline_attachments_keys)){
		foreach($inline_attachments_keys as $r_k => $at_k){
			if(is_numeric($at_k)){
				//legacy bbcode
				if(!empty($post['Attachment'][$at_k])){
					$inline_output = $this->view('views.attachments.inline_attachment', ['post' => $post['Post'], 'file' => $post['Attachment'][$at_k]], true);
					$content = str_replace($inline_files[0][$r_k], htmlspecialchars_decode($inline_output), $content);
					continue;
				}
				$content = str_replace($inline_files[0][$r_k], '', $content);
			}else{
				//new bbcode
				foreach($post['Attachment'] as $k => $attach){
					if($attach['vfilename'] == $at_k){
						$inline_output = $this->view('views.attachments.inline_attachment', ['post' => $post['Post'], 'file' => $post['Attachment'][$k]], true);
						$content = str_replace($inline_files[0][$r_k], htmlspecialchars_decode($inline_output), $content);
						continue 2;
					}
				}
				$content = str_replace($inline_files[0][$r_k], '', $content);
			}
		}
	}
	
	echo $content;
	
	if(!empty($attachment_outputs)){
		foreach($attachment_outputs as $k => $attachment_output){
			echo $attachment_output;
		}
	}
	$this->view('views.attachments.list', ['post' => $post['Post'], 'attachments' => !empty($post['Attachment']) ? $post['Attachment'] : []]);
?>