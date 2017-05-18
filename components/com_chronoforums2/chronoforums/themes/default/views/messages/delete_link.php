<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<div class="ui button red icon big very compact circular G2-static" data-task="popup:#delete-message-<?php echo $message['Discussion']['id']; ?>"><i class="trash icon"></i></div>
<div class="ui fluid popup top left transition hidden G2-static-popup" id="delete-message-<?php echo $message['Discussion']['id']; ?>">
	<div class="ui button red icon fluid G2-dynamic" data-result="remove/closest:.cfu-message" data-url="<?php echo r_('index.php?ext=chronoforums&cont=messages&act=delete&tvout=view'.rp('d', $message['Discussion']['id'])); ?>"><?php el('Confirm discussion deletion'); ?></div>
</div>