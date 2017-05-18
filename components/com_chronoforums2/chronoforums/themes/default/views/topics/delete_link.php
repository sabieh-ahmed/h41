<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(\GApp::access('chronoforums', 'topics_moderate') === true): ?>
<div class="ui button icon very compact red basic borderless G2-static" data-task="popup:#delete-topic-<?php echo $topic['id']; ?>" data-hint="<?php el('Delete'); ?>"><i class="trash icon large"></i></div>
<div class="ui fluid popup top left transition hidden G2-static-popup" id="delete-topic-<?php echo $topic['id']; ?>">
	<a class="ui button red icon fluid" data-id="delete-topic" href="<?php echo r_('index.php?ext=chronoforums&cont=topics&act=delete'.rp('id', $topic)); ?>"><?php el('Confirm topic deletion.'); ?></a>
</div>
<?php endif; ?>