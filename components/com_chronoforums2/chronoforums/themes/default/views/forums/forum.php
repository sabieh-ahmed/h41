<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<div class="content forum-body" style="overflow:hidden;">
	<?php $this->view('views.forums.title', ['forum' => $forum]); ?>
	
	<?php if($forum['type'] == 'forum'): ?>
	<div class="description padded vertical">
		<div class="ui label small"><?php el('Topics'); ?><div class="detail"><?php echo $forum['topic_count']; ?></div></div>
		<div class="ui label small"><?php el('Posts'); ?><div class="detail"><?php echo $forum['post_count']; ?></div></div>
	</div>
	<?php endif; ?>
	
	<div class="metadata fluid">
		<?php echo $forum['description']; ?>
	</div>
</div>