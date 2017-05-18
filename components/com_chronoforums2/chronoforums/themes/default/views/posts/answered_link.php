<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(\GApp::access('chronoforums', 'posts_answer', (int)$topic['user_id']) === true): ?>
<div class="ui button <?php if(!empty($answer)): ?>green<?php endif; ?> icon very compact circular G2-dynamic" data-result="replace/closest:.cfu-post" data-url="<?php echo r_('index.php?ext=chronoforums&cont=posts&act=answer&tvout=view'.rp('id', $post).rp('value', !empty($answer) ? 0 : 1)); ?>" data-hint="<?php el('Correct answer'); ?>">
	<i class="checkmark icon"></i>
</div>
<?php endif; ?>