<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(\GApp::access('chronoforums', 'posts_report') === true): ?>
<div class="ui button yellow icon very compact circular G2-static" data-task="popup:#report-post-<?php echo $post['id']; ?>" data-hint="<?php el('Report this post to the moderators'); ?>"><i class="warning icon"></i></div>
<div class="ui fluid popup top left transition hidden G2-static-popup" id="report-post-<?php echo $post['id']; ?>">
	<div class="ui form">
		<div class="field">
			<label><?php el('Report message'); ?></label>
			<textarea rows="2" name="text"></textarea>
		</div>
		<div class="field">
			<div class="ui button yellow icon fluid G2-dynamic" data-dtask="send/closest:.ui.form" data-result="replace/closest:.cfu-post" data-url="<?php echo r_('index.php?ext=chronoforums&cont=posts&act=report&tvout=view'.rp('id', $post).rp('t', $post['topic_id'])); ?>"><?php el('Submit report'); ?></div>
		</div>
	</div>
</div>
<?php endif; ?>