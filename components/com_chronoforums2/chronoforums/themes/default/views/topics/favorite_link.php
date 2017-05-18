<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(\GApp::access('chronoforums', 'posts_reply') === true): ?>
	<div class="ui button icon very compact <?php if(!empty($favorite)): ?>yellow<?php endif; ?> basic borderless G2-dynamic" data-result="replace/self" data-url="<?php echo r_('index.php?ext=chronoforums&cont=topics&act=favorite&tvout=view'.rp('id', $topic).rp('value', !empty($favorite) ? 0 : 1)); ?>" data-hint="<?php el('Add to my favorites.'); ?>">
		<?php if(!empty($favorite)): ?>
		<i class="star icon large"></i>
		<?php else: ?>
		<i class="star empty icon large"></i>
		<?php endif; ?>
	</div>
<?php endif; ?>