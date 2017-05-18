<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(\GApp::access('chronoforums', 'posts_edit', (int)$post['user_id']) === true): ?>
<div class="ui button blue icon very compact circular G2-dynamic" data-id="edit-post" data-url="<?php echo r_('index.php?ext=chronoforums&cont=posts&act=edit&tvout=view'.rp('t', $post['topic_id']).rp('id', $post)); ?>" data-hint="<?php el('Edit'); ?>">
<i class="write icon"></i>
</div>
<?php endif; ?>