<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(\GApp::access('chronoforums', 'topics_moderate') === true): ?>
	<div class="ui button icon very compact <?php if(!empty($topic['published'])): ?>green<?php endif; ?> basic borderless G2-dynamic" data-result="replace/self" data-url="<?php echo r_('index.php?ext=chronoforums&cont=topics&act=publish&tvout=view'.rp('id', $topic['id']).'&value='.(int)!(bool)$topic['published']); ?>" data-hint="<?php el('Publish/Unpublish'); ?>">
	<i class="checkmark icon large"></i>
	</div>
<?php endif; ?>