<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(empty($topics)): ?>
	<h3 class="ui icon header center aligned"><i class="ui ban icon big red"></i><?php el('No topics were found.'); ?></h3>
<?php else: ?>
<table class="ui very compact very basic table small">
	<thead>
		<tr>
			<th class=""><?php $this->view('views.topics.rss_link', ['topics' => $topics]); ?></th>
			<th class="eleven wide"></th>
			<th class="four wide"><?php el('Last Post'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($topics as $topic): ?>
		<tr>
			<td class="collapsing middle aligned">
				<?php $this->view('views.profiles.avatar', ['user' => $topic['Author'], 'profile' => $topic['AuthorProfile']]); ?>
			</td>
			<td>
				<?php $this->view('views.topics.topic', ['topic' => $topic]); ?>
			</td>
			<td class="middle aligned">
				<?php $this->view('views.lastpost', ['user' => $topic['LastPostUser'], 'profile' => $topic['LastPostUserProfile'], 'post' => $topic['LastPost']]); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php endif; ?>