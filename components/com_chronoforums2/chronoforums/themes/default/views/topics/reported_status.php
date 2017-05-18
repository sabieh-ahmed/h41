<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(!empty($topic['ReportsCount'])): ?>
<div class="ui label tiny icon orange">
	<i class="icon warning"></i> <?php el('Reported'); ?>
</div>
<?php endif; ?>