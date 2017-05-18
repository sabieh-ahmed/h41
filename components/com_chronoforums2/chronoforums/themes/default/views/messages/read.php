<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<div class="ui comments">
	<?php foreach($messages as $message): ?>
		<?php $this->view('views.messages.message', ['message' => $message]); ?>
	<?php endforeach; ?>
	
	<?php $this->view('views.editor', [
		'data' => ['id' => $this->data['d']], 
		'buttons' => ['attachments' => false], 
		'type' => 'new', 
		'name' => 'Message[text]',
		'url' => r_('index.php?ext=chronoforums&cont=messages&act=reply&tvout=view'.rp('d', $this->data))
	]); ?>
</div>