<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<div class="ui dropdown icon item labels">
	<input type="hidden" name="status">
	<i class="filter icon"></i>
	<span class="text"></span>
	<div class="menu drop">
		<a class="item" data-value="unanswered" href="<?php echo r_('index.php?ext=chronoforums&cont=topics'.rp('f', $this->data)); ?>">&nbsp;<?php el('Clear filter'); ?></a>
		<div class="header">
			<i class="filter icon"></i>&nbsp;
			<?php el('Filter by status'); ?>
		</div>
		<div class="ui divider"></div>
		<a class="item" data-value="unanswered" href="<?php echo r_('index.php?ext=chronoforums&cont=topics&status=unanswered'.rp('f', $this->data)); ?>">&nbsp;<div class="ui label red basic"><?php el('No Replies'); ?></div></a>
		<a class="item" data-value="new" href="<?php echo r_('index.php?ext=chronoforums&cont=topics&status=new'.rp('f', $this->data)); ?>">&nbsp;<div class="ui label blue basic"><?php el('New'); ?></div></a>
		<a class="item" data-value="active" href="<?php echo r_('index.php?ext=chronoforums&cont=topics&status=active'.rp('f', $this->data)); ?>">&nbsp;<div class="ui label green basic"><?php el('Active'); ?></div></a>
		<a class="item" data-value="featured" href="<?php echo r_('index.php?ext=chronoforums&cont=topics&status=featured'.rp('f', $this->data)); ?>">&nbsp;<div class="ui label teal"><?php el('Featured'); ?></div></a>
		<?php if(\GApp::access('chronoforums', 'topics_moderate') === true): ?>
		<a class="item" data-value="unpublished" href="<?php echo r_('index.php?ext=chronoforums&cont=topics&status=unpublished'.rp('f', $this->data)); ?>">&nbsp;<div class="ui label red"><?php el('Unpublished'); ?></div></a>
		<?php endif; ?>
	</div>
</div>