<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(!empty($topic['post_count'])): ?>
<?php
	$period = ceil((time() - strtotime($topic['created']))/(24 * 60 * 60));
	$hot = ((int)$topic['post_count']/$period) >= $this->get('fparams')->get('topic_hot_threshold', 5);
?>
	<?php if($hot): ?>
	<div class="ui label tiny red icon">
		<i class="icon fire"></i> <?php el('Hot'); ?>
	</div>
	<?php endif; ?>
<?php endif; ?>