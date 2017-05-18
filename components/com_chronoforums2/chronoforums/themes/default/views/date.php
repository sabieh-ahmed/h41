<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(!empty($full)): ?>
<span class="date"><?php echo ($timestamp > 0) ? \G2\L\DateTime::format($timestamp) : rl('long time ago'); ?></span>
<?php else: ?>
<span class="date"><?php echo ($timestamp > 0) ? \G2\L\DateTime::short($timestamp) : rl('long time ago'); ?></span>
<?php endif; ?>