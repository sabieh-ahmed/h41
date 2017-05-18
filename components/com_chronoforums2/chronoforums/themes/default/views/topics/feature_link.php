<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(\GApp::access('chronoforums', 'topics_feature') === true): ?>
	<div class="ui button icon very compact <?php if(!empty($featured)): ?>teal<?php endif; ?> basic borderless G2-dynamic" data-result="replace/self" data-url="<?php echo r_('index.php?ext=chronoforums&cont=topics&act=feature&tvout=view'.rp('id', $topic).rp('value', !empty($featured) ? 0 : 1)); ?>" data-hint="<?php el('Featured'); ?>">
		<?php if(!empty($featured)): ?>
		<i class="bookmark icon large"></i>
		<?php else: ?>
		<i class="bookmark remove icon large"></i>
		<?php endif; ?>
	</div>
<?php endif; ?>