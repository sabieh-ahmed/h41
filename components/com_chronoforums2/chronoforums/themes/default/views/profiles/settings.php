<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<form class="ui form" id="edit-profile" method="post" enctype="multipart/form-data" action="<?php echo r_('index.php?ext=chronoforums&cont=profiles&act=settings'.rp('u', $this->data['u'])); ?>">
	<div class="field">
		<label><?php el('Enable topics tracking'); ?></label>
		<div class="ui selection dropdown">
			<input type="hidden" name="Profile[params][enable_topics_track]" value="0">
			<i class="dropdown icon"></i>
			<div class="default text"></div>
			<div class="menu">
				<div class="item" data-value="1"><?php el('Enabled'); ?></div>
				<div class="item" data-value="0"><?php el('Disabled'); ?></div>
			</div>
		</div>
	</div>
	<div class="field">
		<label><?php el('Posts order'); ?></label>
		<div class="ui selection dropdown">
			<input type="hidden" name="Profile[params][posts_ordering]" value="lastpost_asc">
			<i class="dropdown icon"></i>
			<div class="default text"></div>
			<div class="menu">
				<div class="item" data-value="lastpost_asc"><?php el('Oldest first'); ?></div>
				<div class="item" data-value="lastpost_desc"><?php el('Latest first'); ?></div>
			</div>
		</div>
	</div>
	<div class="field">
		<button class="ui button green icon labeled" name="settings">
			<i class="icon checkmark"></i><?php el('Update'); ?>
		</button>
	</div>
</form>