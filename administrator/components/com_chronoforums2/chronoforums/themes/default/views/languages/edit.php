<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>

<form action="<?php echo r_('index.php?ext=chronoforums&cont=forums'); ?>" method="post" name="admin_form" id="admin_form" class="ui form">

	<h2 class="ui header"><?php echo !empty($this->data['Forum']['title']) ? $this->data['Forum']['title'] : rl('New forum'); ?></h2>
	<div class="ui">
		<button type="button" class="compact ui button green icon labeled toolbar-button" name="save" data-url="<?php echo r_('index.php?ext=chronoforums&cont=forums&act=edit'); ?>">
			<i class="check icon"></i><?php el('Save'); ?>
		</button>
		<button type="button" class="compact ui button blue icon labeled toolbar-button" name="apply" data-url="<?php echo r_('index.php?ext=chronoforums&cont=forums&act=edit'); ?>">
			<i class="check icon"></i><?php el('Apply'); ?>
		</button>
		<a type="button" class="compact ui button red icon labeled toolbar-button" href="<?php echo r_('index.php?ext=chronoforums&cont=forums'); ?>">
			<i class="cancel icon"></i><?php el('Cancel'); ?>
		</a>
	</div>
	
	<div class="ui clearing divider"></div>
	
	<div class="ui top attached tabular menu G2-tabs">
		<a class="item active" data-tab="general"><?php el('General'); ?></a>
		<a class="item" data-tab="permissions"><?php el('Permissions'); ?></a>
	</div>
	<div class="ui bottom attached tab segment active" data-tab="general">
		<input type="hidden" name="Forum[id]" value="">
		
		<div class="two fields">
			<div class="field">
				<label><?php el('Title'); ?></label>
				<input type="text" placeholder="<?php el('Title'); ?>" name="Forum[title]">
			</div>
			<div class="field">
				<label><?php el('Alias'); ?></label>
				<input type="text" placeholder="<?php el('Alias'); ?>" name="Forum[alias]">
			</div>
		</div>
		<div class="three fields">
			<div class="field">
				<label><?php el('Type'); ?></label>
				<div class="ui fluid selection dropdown">
					<input type="hidden" name="Forum[type]" value="forum" />
					<i class="dropdown icon"></i>
					<div class="default text"><?php el('Select type'); ?></div>
					<div class="menu">
					<div class="item" data-value="forum"><?php el('Forum'); ?></div>
					<div class="item" data-value="category"><?php el('Category'); ?></div>
					</div>
				</div>
			</div>
			<div class="field">
				<label><?php el('Parent'); ?></label>
				<div class="ui fluid search selection dropdown">
					<input type="hidden" name="Forum[parent_id]" value="" />
					<i class="dropdown icon"></i>
					<div class="default text">-</div>
					<div class="menu">
						<div class="item" data-value="0">-</div>
						<?php foreach($parents as $parent): ?>
							<div class="item" data-value="<?php echo $parent['id']; ?>">
								<?php if($parent['type'] == 'forum'): ?>
								<i class="icon folder"></i>
								<?php else: ?>
								<i class="icon content"></i>
								<?php endif; ?>
								<?php echo str_repeat('<i class="icon long arrow right"></i>', $parent['_depth']).$parent['title']; ?>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
			<div class="field two wide">
				<label><?php el('Order'); ?></label>
				<input type="text" placeholder="<?php el('Order'); ?>" name="Forum[ordering]">
			</div>
		</div>
		<div class="field">
			<div class="ui checkbox">
				<input type="checkbox" tabindex="0" class="hidden" name="Forum[published]" value="1">
				<label><?php el('Published'); ?></label>
			</div>
		</div>
		
		<div class="field">
			<label><?php el('Description'); ?></label>
			<textarea placeholder="<?php el('Description'); ?>" name="Forum[description]" rows="5"></textarea>
		</div>
	</div>
	
	<div class="ui bottom attached tab segment" data-tab="permissions">
		<?php $this->view('permissions', ['model' => 'Forum', 'perms' => $perms, 'groups' => $groups]); ?>
	</div>
	
</form>
