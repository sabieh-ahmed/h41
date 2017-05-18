<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(\GApp::access('chronoforums', 'topics_moderate') === true): ?>
	<div class="ui button <?php if(!empty($post['published'])): ?>green<?php endif; ?> icon very compact circular G2-dynamic" data-result="replace/closest:.cfu-post" data-url="<?php echo r_('index.php?ext=chronoforums&cont=posts&act=publish&tvout=view&id='.$post['id'].'&value='.(int)!(bool)$post['published']); ?>" data-hint="<?php el('Publish/Unpublish'); ?>"><i class="power icon"></i></div>
<?php endif; ?>