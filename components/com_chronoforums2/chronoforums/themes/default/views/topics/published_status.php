<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(empty($topic['published'])): ?>
<div class="ui label tiny icon red">
	<i class="cancel icon"></i> <?php el('Unpublished'); ?>
</div>
<?php endif; ?>