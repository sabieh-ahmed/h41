<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>

<form action="<?php echo r_('index.php?ext=chronoforums&cont=importer'); ?>" method="post" name="admin_form" id="admin_form" class="ui form">
	
	<div class="ui">
		<button type="button" class="compact ui button green icon labeled toolbar-button" name="start" data-url="<?php echo r_('index.php?ext=chronoforums&cont=importer'); ?>">
			<i class="check icon"></i><?php el('Start'); ?>
		</button>
	</div>
	
	<div class="ui message info"><?php el('Make sure to copy the avatars and attachments directories to the new extension path after you finish.'); ?></div>
	
	<div class="ui clearing divider"></div>
	
	<div class="field five wide">
		<label><?php el('Type'); ?></label>
		<div class="ui fluid selection dropdown">
			<input type="hidden" name="source" value="" />
			<i class="dropdown icon"></i>
			<div class="default text"><?php el('Select source'); ?></div>
			<div class="menu">
			<div class="item" data-value="chronoforums1"><?php el('Chronoforums1'); ?></div>
			</div>
		</div>
	</div>
	
	<h2 class="ui header dividing">
		<?php el('Database details'); ?>
		<div class="sub header"><?php el('Leave this section empty if the tables are on the same database.'); ?></div>
	</h2>
	
	<div class="field four wide">
		<label><?php el('Database name'); ?></label>
		<input type="text" name="db[name]" placeholder="">
	</div>
	<div class="field four wide">
		<label><?php el('Database user'); ?></label>
		<input type="text" name="db[user]" placeholder="">
	</div>
	<div class="field four wide">
		<label><?php el('Database user password'); ?></label>
		<input type="text" name="db[pass]" placeholder="">
	</div>
	<div class="field four wide">
		<label><?php el('Database host'); ?></label>
		<input type="text" name="db[host]" value="localhost" placeholder="">
	</div>
	<div class="field four wide">
		<label><?php el('Database prefix'); ?></label>
		<input type="text" name="db[prefix]" placeholder="">
	</div>
	<div class="field four wide">
		<label><?php el('Database type'); ?></label>
		<input type="text" name="db[type]" value="<?php echo \G2\L\Config::get('db.type'); ?>" placeholder="">
	</div>
	
	
</form>
