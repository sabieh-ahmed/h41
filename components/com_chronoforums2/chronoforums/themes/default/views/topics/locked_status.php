<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(!empty($topic['locked'])): ?>
<i class="icon lock red fitted link" data-hint="<?php el('Locked'); ?>"></i>
<?php endif; ?>