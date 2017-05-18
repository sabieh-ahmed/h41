<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(\GApp::access('chronoforums', 'posts_delete', (int)$post['user_id']) === true): ?>
<div class="ui button red icon very compact circular G2-static" data-task="popup:#delete-post-<?php echo $post['id']; ?>" data-hint="<?php el('Delete'); ?>"><i class="trash icon"></i></div>
<div class="ui fluid popup top left transition hidden G2-static-popup" id="delete-post-<?php echo $post['id']; ?>">
	<div class="ui button red icon fluid G2-dynamic" data-result="remove/closest:.cfu-post" data-url="<?php echo r_('index.php?ext=chronoforums&cont=posts&act=delete&tvout=view&id='.$post['id']); ?>"><?php el('Confirm post deletion'); ?></div>
</div>
<?php endif; ?>