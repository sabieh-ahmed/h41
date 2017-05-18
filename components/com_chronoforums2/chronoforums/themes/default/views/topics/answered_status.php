<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(!empty($topic['answered'])): ?>
<div class="ui label tiny green icon">
	<i class="icon checkmark"></i> <?php el('Answered'); ?>
</div>
<?php endif; ?>