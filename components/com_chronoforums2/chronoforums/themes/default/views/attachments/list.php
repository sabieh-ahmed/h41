<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(!empty($attachments) AND \GApp::access('chronoforums', 'attachments_list', $post['user_id']) === true): ?>
<div class="ui segment">
	<div class="ui label top attached"><?php el('Attachments'); ?></div>
	<div class="ui list divided relaxed">
		<?php
			foreach($attachments as $k => $attach){
				$this->view('views.attachments.attachment', ['post' => $post, 'file' => $attach]);
			}
		?>
	</div>
</div>
<?php endif; ?>