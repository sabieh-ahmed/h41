<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(trim($this->get('fparams')->get('board_announcement', ''))): ?>
<div class="ui icon message info">
	<i class="warning icon"></i>
	<?php echo $this->get('fparams')->get('board_announcement', ''); ?>
</div>
<?php endif; ?>