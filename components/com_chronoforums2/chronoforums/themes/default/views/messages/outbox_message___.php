<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<div class="content topic-body">
	<?php $this->view('views.messages.read_status', ['message' => $message]); ?>
	<a class="ui header" href="<?php echo r_('index.php?ext=chronoforums&cont=messages&act=read'.rp('d', $message['Discussion']['id'])); ?>"><?php echo $message['Discussion']['subject']; ?>&nbsp;(<?php echo $message['Discussion']['message_count']; ?>)</a>
	<div class="description padded vertical">
		<div class="metadata nomargin">
			<?php $this->view('views.profiles.username', ['user' => $message['FirstAuthor']]); ?>,&nbsp;
			<?php $this->view('views.date', ['timestamp' => strtotime($message['First']['created'])]); ?>
		</div>
	</div>
</div>