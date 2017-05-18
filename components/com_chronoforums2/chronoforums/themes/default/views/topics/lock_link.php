<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(\GApp::access('chronoforums', 'topics_moderate') === true): ?>
	<div class="ui button icon very compact <?php if(!empty($topic['locked'])): ?>red<?php endif; ?> basic borderless G2-dynamic" data-result="replace/self" data-url="<?php echo r_('index.php?ext=chronoforums&cont=topics&act=lock&tvout=view'.rp('id', $topic['id']).rp('value', (int)!(bool)$topic['locked'])); ?>" data-hint="<?php el('Lock/Unlock'); ?>">
		<?php if(!empty($topic['locked'])): ?>
		<i class="lock icon large"></i>
		<?php else: ?>
		<i class="unlock icon large"></i>
		<?php endif; ?>
	</div>
<?php endif; ?>