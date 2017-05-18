<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(\GApp::access('chronoforums', 'posts_reply') === true): ?>
	<div class="ui button icon very compact <?php if(!empty($subscribed)): ?>green<?php endif; ?> basic borderless G2-dynamic" data-result="replace/self" data-url="<?php echo r_('index.php?ext=chronoforums&cont=topics&act=subscribe&tvout=view'.rp('id', $topic).rp('value', !empty($subscribed) ? 0 : 1)); ?>" data-hint="<?php el('Subscribe to new posts'); ?>">
		<?php if(!empty($subscribed)): ?>
		<i class="mail icon large"></i>
		<?php else: ?>
		<i class="mail outline icon large"></i>
		<?php endif; ?>
	</div>
<?php endif; ?>