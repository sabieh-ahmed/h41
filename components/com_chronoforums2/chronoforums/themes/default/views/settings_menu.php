<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(\GApp::user()->get('id')): ?>
<a class="item icon <?php if($this->controller == 'profiles' AND $this->action == 'settings'): ?>purple active<?php endif; ?>" href="<?php echo r_('index.php?ext=chronoforums&cont=profiles&act=settings'.rp('u', \GApp::user()->get('id'))); ?>" data-hint="<?php el('Board preferences'); ?>">
<i class="settings icon"></i>
</a>
<?php endif; ?>