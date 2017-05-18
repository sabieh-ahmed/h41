<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(\GApp::user()->get('id')): ?>
<a class="item icon <?php if(\G2\L\Request::data('status') == 'favorites'): ?>yellow active<?php endif; ?>" href="<?php echo r_('index.php?ext=chronoforums&cont=topics&status=favorites'); ?>" data-hint="<?php el('My favorite topics'); ?>">
<i class="star icon"></i>
</a>
<?php endif; ?>