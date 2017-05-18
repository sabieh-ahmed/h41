<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<div class="ui menu inverted">
	<a class="item icon blue <?php if($this->action == 'index' AND $this->controller == ''): ?>active<?php endif; ?>" href="<?php echo r_('index.php?ext=chronoforums'); ?>">
		<i class="home icon"></i>
	</a>
	<a class="item blue <?php if($this->controller == 'forums'): ?>active<?php endif; ?>" href="<?php echo r_('index.php?ext=chronoforums&cont=forums'); ?>">
		<i class="folder icon"></i><?php el('Forums manager'); ?>
	</a>
	<a class="item blue <?php if($this->action == 'settings'): ?>active<?php endif; ?>" href="<?php echo r_('index.php?ext=chronoforums&act=settings'); ?>">
		<i class="settings icon"></i><?php el('Settings manager'); ?>
	</a>
	<a class="item blue <?php if($this->action == 'permissions'): ?>active<?php endif; ?>" href="<?php echo r_('index.php?ext=chronoforums&act=permissions'); ?>">
		<i class="key icon"></i><?php el('Permissions manager'); ?>
	</a>
	<a class="item blue <?php if($this->controller == 'tags'): ?>active<?php endif; ?>" href="<?php echo r_('index.php?ext=chronoforums&cont=tags'); ?>">
		<i class="tag icon"></i><?php el('Tags manager'); ?>
	</a>
	<a class="item blue <?php if($this->controller == 'importer'): ?>active<?php endif; ?>" href="<?php echo r_('index.php?ext=chronoforums&cont=importer'); ?>">
		<i class="inbox icon"></i><?php el('Import'); ?>
	</a>
	<a class="item blue <?php if($this->action == 'clear_cache'): ?>active<?php endif; ?>" href="<?php echo r_('index.php?ext=chronoforums&act=clear_cache'); ?>">
		<i class="trash icon"></i><?php el('Clear database cache'); ?>
	</a>
	<a class="item blue <?php if($this->controller == 'languages'): ?>active<?php endif; ?>" href="<?php echo r_('index.php?ext=chronoforums&cont=languages'); ?>">
		<i class="translate icon"></i><?php el('Languages'); ?>
	</a>
	
	<a class="item blue <?php if($this->action == 'validateinstall'): ?>active<?php endif; ?>" href="<?php echo r_('index.php?ext=chronoforums&act=validateinstall'); ?>">
		<i class="checkmark green icon"></i><?php el('Validate install'); ?>
	</a>
</div>
<div class="ui segment fluid container">
	{VIEW}
</div>