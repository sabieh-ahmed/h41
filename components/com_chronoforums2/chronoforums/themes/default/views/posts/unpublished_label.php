<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(empty($post['published'])): ?>
<div class="ui label icon red tiny"><i class="warning icon"></i>&nbsp;<?php el('Unpublished'); ?></div>
<?php endif; ?>