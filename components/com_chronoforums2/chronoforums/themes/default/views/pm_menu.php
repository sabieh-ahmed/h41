<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(\GApp::user()->get('id')): ?>
<a class="item icon <?php if($this->controller == 'messages'): ?>blue active<?php endif; ?>" href="<?php echo r_('index.php?ext=chronoforums&cont=messages'.rp('u', \GApp::user()->get('id'))); ?>">
	<i class="mail icon"></i>
	<?php if(!empty($unreadPM)): ?>
	<div class="ui label red small"><?php echo $unreadPM; ?></div>
	<?php endif; ?>
</a>
<?php endif; ?>