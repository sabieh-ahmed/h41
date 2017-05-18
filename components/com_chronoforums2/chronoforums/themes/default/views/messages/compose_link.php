<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(\GApp::access('chronoforums', 'messages_send') === true): ?>
	<a class="ui button icon labeled green compact" href="<?php echo r_('index.php?ext=chronoforums&cont=messages&act=send'.rp('u', \GApp::user()->get('id'))); ?>"><i class="write icon large"></i>&nbsp;<?php el('New message'); ?></a>
<?php endif; ?>