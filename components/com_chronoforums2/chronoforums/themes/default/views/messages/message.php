<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<div class="comment cfu-post" id="<?php echo $message['Message']['id']; ?>">
	<?php $this->view('views.profiles.avatar', ['user' => $message['Author'], 'profile' => $message['AuthorProfile']]); ?>
	<div class="content cfu-content">
		<?php $this->view('views.profiles.username', ['user' => $message['Author'], 'profile' => $message['AuthorProfile']]); ?>
		<div class="description padded vertical">
			<div class="metadata fluid">
				<?php el('Posted'); ?>&nbsp;<?php $this->view('views.date', ['timestamp' => strtotime($message['Message']['created'])]); ?>
			</div>
		</div>
		<div class="text">
		<?php echo $this->Bbcode->parse($message['Message']['text']); ?>
		</div>
		<div class="actions">
			<?php $this->view('views.messages.reply_link', ['post' => $message['Message']]); ?>
		</div>
		<div class="ui divider"></div>
	</div>
</div>