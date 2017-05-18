<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(\GApp::access('chronoforums', 'topics_moderate') === true): ?>
<div class="ui button blue basic active icon very compact circular G2-static" data-task="popup" data-hint="<?php el('Split this topic here'); ?>"><i class="cut icon"></i></div>
<div class="ui fluid popup top left transition hidden G2-static-popup" id="delete-post-<?php echo $post['id']; ?>">
	<a class="ui button blue active basic icon fluid" href="<?php echo r_('index.php?ext=chronoforums&cont=topics&act=split'.rp('t', $post['topic_id']).rp('p', $post['id'])); ?>"><?php el('Confirm topic split'); ?></a>
</div>
<?php endif; ?>