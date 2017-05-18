<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(\GApp::access('chronoforums', 'posts_vote', (int)$post['user_id']) === true): ?>
<div class="ui button <?php if(!empty($vote)): ?>green<?php endif; ?> icon very compact circular right floating G2-dynamic" data-result="replace/closest:.cfu-post" data-url="<?php echo r_('index.php?ext=chronoforums&cont=posts&act=voteup&tvout=view'.rp('id', $post).rp('value', !empty($vote) ? 0 : 1)); ?>" data-hint="<?php el('Like'); ?>">
	<i class="thumbs up icon"></i>
</div>
<?php endif; ?>