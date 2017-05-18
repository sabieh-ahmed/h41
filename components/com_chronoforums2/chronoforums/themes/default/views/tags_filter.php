<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if((int)$this->get('fparams')->get('enable_topics_tags', 1) AND !empty($tags_filter)): ?>
<div class="ui dropdown icon item labels">
	<input type="hidden" name="tagged">
	<i class="tag icon"></i>
	<span class="text"></span>
	<div class="menu drop">
		<div class="header">
			<i class="tag icon"></i>
			<?php el('Select tag'); ?>
		</div>
		<div class="scrolling menu">
			<?php foreach($tags_filter as $tag): ?>
			<?php $color = !empty($tag['Tag']['params']['color']) ? $tag['Tag']['params']['color'] : 'blue'; ?>
			<a class="item" data-value="<?php echo $tag['Tag']['alias']; ?>" href="<?php echo r_(\G2\L\Url::build('index.php?ext=chronoforums', array_merge($_GET, ['cont' => 'topics', 'act' => 'index', 'tagged' => $tag['Tag']['alias']]))); ?>">&nbsp;<div class="ui label <?php echo $color; ?>"><?php echo $tag['Tag']['title']; ?></div></a>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<?php endif; ?>