<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<form class="right menu" action="<?php echo r_(\G2\L\Url::build('index.php?ext=chronoforums', array_merge($_GET, ['cont' => 'topics', 't' => null]))); ?>" method="post">
	<div class="ui dropdown icon item labels">
		<i class="search icon"></i>
		<div class="menu drop">
			<div class="ui form segment basic" style="min-width:250px;">
				<div class="field">
					<input name="keywords" class="prompt" autocomplete="off" type="text" placeholder="<?php el('Search forums'); ?>...">
				</div>
				<div class="grouped fields">
					<label><?php el('Forums to search'); ?></label>
					<?php if($this->data('f')): ?>
					<div class="field">
						<div class="ui radio checkbox">
							<input type="radio" name="f" value="<?php echo $this->data('f'); ?>" tabindex="0" class="hidden">
							<label><?php el('This forum'); ?></label>
						</div>
					</div>
					<?php endif; ?>
					<div class="field">
						<div class="ui radio checkbox">
							<input type="radio" name="f" value="" <?php echo ($this->data('f') ? '' : 'checked="checked"'); ?> tabindex="0" class="hidden">
							<label><?php el('All forums'); ?></label>
						</div>
					</div>
				</div>
			</div>
			<div class="item">
				<button class="ui button compact green"><?php el('Search'); ?></button>
			</div>
		</div>
	</div>
</form>