<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(empty($messages)): ?>
	<h3 class="ui icon header center aligned"><i class="ui meh icon big purple"></i><?php el('No messages were found.'); ?></h3>
<?php else: ?>
<table class="ui very compact very basic table small">
	<thead>
		<tr>
			<th class=""></th>
			<th class="ten wide"></th>
			<th class="five wide"><?php el('Last Message'); ?></th>
			<th class=""></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($messages as $message): ?>
		<tr class="cfu-message">
			<td class="collapsing middle aligned">
				<?php $this->view('views.profiles.avatar', ['user' => $message['FirstAuthor'], 'profile' => $message['FirstAuthorProfile']]); ?>
			</td>
			<td>
				<?php $this->view('views.messages.inbox_message', ['message' => $message]); ?>
			</td>
			<td class="middle aligned">
				<?php $this->view('views.lastpost', ['user' => $message['LastAuthor'], 'profile' => $message['LastAuthorProfile'], 'post' => $message['Last']]); ?>
			</td>
			<td class="collapsing middle aligned">
				<?php $this->view('views.messages.delete_link', ['message' => $message]); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php endif; ?>