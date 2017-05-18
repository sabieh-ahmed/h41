<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>

<form action="<?php echo r_('index.php?ext=chronoforums&act=permissions'); ?>" method="post" name="admin_form" id="admin_form" class="ui form">

	<h2 class="ui header"><?php el('Permissions manager'); ?></h2>
	<div class="ui">
		<button type="button" class="compact ui button green icon labeled toolbar-button" data-url="<?php echo r_('index.php?ext=chronoforums&act=save_permissions'); ?>">
			<i class="check icon"></i><?php el('Save'); ?>
		</button>
	</div>
	
	<div class="ui clearing divider"></div>
	
	<div class="ui segment">
		<input type="hidden" name="Acl[id]" value="">
		
		<?php $this->view('permissions_manager', ['model' => 'Acl', 'perms' => $perms, 'groups' => $groups]); ?>
	</div>
	
</form>
