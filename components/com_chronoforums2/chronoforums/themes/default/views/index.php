<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(!empty($forums)): ?>
<table class="ui very compact very basic table small">
	<?php if(empty($noheader)): ?>
	<thead>
		<tr>
			<th class=""></th>
			<th class=""><?php el('Last Post'); ?></th>
		</tr>
	</thead>
	<?php endif; ?>
	<tbody>
		<?php foreach($forums as $forum): ?>
		<tr class="<?php if($forum['Forum']['type'] != 'forum'): ?><?php endif; ?>">
			<td class="twelve wide" style="padding-left:<?php echo ((int)$forum['Forum']['_depth'] * 3).'em'; ?>;">
				<?php $this->view('views.forums.icon', ['forum' => $forum['Forum']]); ?>
				<?php $this->view('views.forums.forum', ['forum' => $forum['Forum']]); ?>
			</td>
			<td class="top aligned four wide">
				<?php $this->view('views.lastpost', ['user' => $forum['LastPostUser'], 'profile' => $forum['LastPostUserProfile'], 'post' => $forum['LastPost']]); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php endif; ?>