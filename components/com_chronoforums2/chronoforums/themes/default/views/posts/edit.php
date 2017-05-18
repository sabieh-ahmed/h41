<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php $this->view('views.editor', [
	'data' => $post['Post'], 
	'attachments' => !empty($post['Attachment']) ? $post['Attachment'] : [], 
	'type' => 'update', 
	'url' => r_('index.php?ext=chronoforums&cont=posts&act=edit&tvout=view&edit=1'.rp('t', $post['Post']['topic_id']).rp('id', $post['Post']))
]); ?>