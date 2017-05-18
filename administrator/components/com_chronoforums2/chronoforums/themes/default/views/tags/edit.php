<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>

<form action="<?php echo r_('index.php?ext=chronoforums&cont=tags'); ?>" method="post" name="admin_form" id="admin_form" class="ui form">

	<h2 class="ui header"><?php echo !empty($this->data['Tag']['title']) ? $this->data['Tag']['title'] : rl('New forum'); ?></h2>
	<div class="ui">
		<button type="button" class="compact ui button green icon labeled toolbar-button" name="save" data-url="<?php echo r_('index.php?ext=chronoforums&cont=tags&act=edit'); ?>">
			<i class="check icon"></i><?php el('Save'); ?>
		</button>
		<button type="button" class="compact ui button blue icon labeled toolbar-button" name="apply" data-url="<?php echo r_('index.php?ext=chronoforums&cont=tags&act=edit'); ?>">
			<i class="check icon"></i><?php el('Apply'); ?>
		</button>
		<a type="button" class="compact ui button red icon labeled toolbar-button" href="<?php echo r_('index.php?ext=chronoforums&cont=tags'); ?>">
			<i class="cancel icon"></i><?php el('Cancel'); ?>
		</a>
	</div>
	
	<div class="ui clearing divider"></div>
	
	<div class="ui top attached tabular menu G2-tabs">
		<a class="item active" data-tab="general"><?php el('General'); ?></a>
	</div>
	<div class="ui bottom attached tab segment active" data-tab="general">
		<input type="hidden" name="Tag[id]" value="">
		
		<div class="two fields">
			<div class="field">
				<label><?php el('Title'); ?></label>
				<input type="text" placeholder="<?php el('Title'); ?>" name="Tag[title]">
			</div>
			<div class="field">
				<label><?php el('Alias'); ?></label>
				<input type="text" placeholder="<?php el('Alias'); ?>" name="Tag[alias]">
			</div>
		</div>
		<div class="field">
			<div class="ui checkbox">
				<input type="hidden" name="Tag[published]" data-ghost="1" value="">
				<input type="checkbox" class="hidden" name="Tag[published]" value="1">
				<label><?php el('Published'); ?></label>
			</div>
		</div>
		<div class="field">
			<div class="ui checkbox">
				<input type="hidden" name="Tag[public]" data-ghost="1" value="">
				<input type="checkbox" class="hidden" name="Tag[public]" value="1">
				<label><?php el('Public'); ?></label>
			</div>
		</div>
		<div class="field two wide">
			<label><?php el('Order'); ?></label>
			<input type="text" placeholder="<?php el('Order'); ?>" name="Tag[ordering]">
		</div>
		
		<div class="field">
			<label><?php el('Description'); ?></label>
			<textarea placeholder="<?php el('Description'); ?>" name="Tag[description]" rows="5"></textarea>
		</div>
		
		<div class="field two wide">
			<label><?php el('Color'); ?></label>
			<div class="ui fluid selection dropdown">
				<input type="hidden" name="Tag[params][color]" value="forum" />
				<i class="dropdown icon"></i>
				<div class="default text"><?php el('Default'); ?></div>
				<div class="menu">
					<div class="item" data-value="red"><div class="ui red empty fluid label"></div></div>
					<div class="item" data-value="orange"><div class="ui orange empty fluid label"></div></div>
					<div class="item" data-value="yellow"><div class="ui yellow empty fluid label"></div></div>
					<div class="item" data-value="olive"><div class="ui olive empty fluid label"></div></div>
					<div class="item" data-value="green"><div class="ui green empty fluid label"></div></div>
					<div class="item" data-value="teal"><div class="ui teal empty fluid label"></div></div>
					<div class="item" data-value="blue"><div class="ui blue empty fluid label"></div></div>
					<div class="item" data-value="violet"><div class="ui violet empty fluid label"></div></div>
					<div class="item" data-value="purple"><div class="ui purple empty fluid label"></div></div>
					<div class="item" data-value="pink"><div class="ui pink empty fluid label"></div></div>
					<div class="item" data-value="brown"><div class="ui brown empty fluid label"></div></div>
					<div class="item" data-value="grey"><div class="ui grey empty fluid label"></div></div>
					<div class="item" data-value="black"><div class="ui black empty fluid label"></div></div>
				</div>
			</div>
		</div>
	</div>
	
</form>
