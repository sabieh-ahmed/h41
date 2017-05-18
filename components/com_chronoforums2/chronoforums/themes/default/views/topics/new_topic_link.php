<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(\GApp::access('chronoforums', 'topics_add') === true): ?>
	<a class="ui button icon labeled green compact" href="<?php echo r_('index.php?ext=chronoforums&cont=topics&act=add'.rp('f', $this->data)); ?>"><i class="talk icon large"></i>&nbsp;<?php el('New Topic'); ?></a>
<?php endif; ?>