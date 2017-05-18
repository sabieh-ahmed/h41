<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php
	ob_start();
?>
<script>
	jQuery(document).ready(function($) {
		$('#recipients-lookup').dropdown({
			apiSettings: {
				url: '<?php echo r_('index.php?ext=chronoforums&cont=messages&act=recipients&tvout=view&q={query}'); ?>',
				cache:false
			},
			message:{noResults:'<?php el('No results found.'); ?>'},
			saveRemoteData:false
		});
	});
</script>
<?php
	$wizard_jscode = ob_get_clean();
	\GApp::document()->addHeaderTag($wizard_jscode);
?>
<form class="ui form" action="<?php echo r_('index.php?ext=chronoforums&cont=messages&act=send'); ?>" method="post">

	<div class="required field">
		<label><?php el('Subject'); ?></label>
		<input type="text" placeholder="<?php el('Subject'); ?>" name="Discussion[subject]">
	</div>
	
	
	<div class="required field">
		<label><?php el('Select recipients'); ?></label>
		<div class="ui search selection dropdown" id="recipients-lookup">
			<input type="hidden" name="DiscussionUser[recipients][]" value="">
			<i class="dropdown icon"></i>
			<div class="default text"><?php el('Select recipients'); ?></div>
			<div class="menu">
				<?php if(!empty($recipients)): ?>
					<?php foreach($recipients as $recipient): ?>
					<div class="item" data-value="<?php echo $recipient['id']; ?>"><?php echo $recipient['username']; ?></div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
	
	<div class="required field">
		<label><?php el('Message'); ?></label>
		<?php 
			$this->view('views.editor', [
				'data' => ['id' => 0], 
				'type' => 'new', 
				'buttons' => ['save' => false, 'attachments' => false],
				'name' => 'Message[text]'
			]); 
		?>
	</div>
	
	<div class="field">
		<button class="ui button icon labeled green" name="send"><i class="send icon large"></i>&nbsp;<?php el('Send Message'); ?></button>
	</div>
	
</form>