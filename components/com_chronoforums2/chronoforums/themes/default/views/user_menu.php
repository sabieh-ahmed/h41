<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(\GApp::user()->get('id')): ?>
<a class="item icon <?php if($this->controller == 'profiles' AND $this->action != 'settings'): ?>blue active<?php endif; ?>" href="<?php echo r_('index.php?ext=chronoforums&cont=profiles'.rp('u', \GApp::user()->get('id'))); ?>"><i class="user icon"></i></a>
<?php endif; ?>