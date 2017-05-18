<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(\GApp::access('chronoforums', 'topics_moderate', $topic['user_id']) === true): ?>
<div class="ui button icon very compact blue basic borderless G2-static" data-task="popup:#edit-topic-<?php echo $topic['id']; ?>" data-hint="<?php el('Edit'); ?>"><i class="write icon large"></i></div>
<div class="ui fluid popup top left transition hidden G2-static-popup" id="edit-topic-<?php echo $topic['id']; ?>">
	<a class="ui button blue icon fluid" data-id="edit-topic" href="<?php echo r_('index.php?ext=chronoforums&cont=topics&act=edit&t='.$topic['id']); ?>"><?php el('Edit this topic.'); ?></a>
</div>
<?php endif; ?>