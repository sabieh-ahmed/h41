<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php
	ob_start();
?>
<script>
	jQuery(document).ready(function($) {
		$('.step').on('click', function(){
			var step = $(this);
			
			$('.ui.progress').progress({
				percent: 1
			});
			
			step.addClass('disabled');
			step.append('<div class="ui active loader"></div>');
			
			check(step, 0, 0, '');
		});
		
		function check(step, startat, count, task){
			$.ajax({
				url: "<?php echo r_('index.php?ext=chronoforums&cont=importer&act='.$source.'&tvout=view'); ?>",
				data: {'id' : step.data('step'), 'startat' : startat, 'count' : count, 'task' : task},
				success: function(result){
					result = JSON.parse(result);
					
					if(result.hasOwnProperty('completed')){
						$('.ui.progress').progress({
							percent: 100
						});
						
						step.removeClass('active');
						step.addClass('completed disabled');
						step.find('.ui.loader').remove();
						
						if(step.next('.step').length > 0){
							step.next('.step').removeClass('disabled');
							step.next('.step').addClass('active');
						}
					}else{
						var count = result.count;
						var finished = result.finished;
						var percent = (parseInt(finished)/parseInt(count)) * 100;
						
						if(count == finished){
							percent = 100;
						}
						
						var task = result.task;
						
						$('.ui.progress').progress({
							percent: percent
						});
						$('.ui.progress').find('.label').text(percent + '%');
						
						check(step, finished, count, task);
					}
				}
			});
		}
	});
</script>
<?php
	$jscode = ob_get_clean();
	\GApp::document()->addHeaderTag($jscode);
?>
<form action="<?php echo r_('index.php?ext=chronoforums&cont=importer'); ?>" method="post" name="admin_form" id="admin_form" class="ui form">
	
	<button type="button" class="compact ui button green icon labeled toolbar-button" name="start" data-url="<?php echo r_('index.php?ext=chronoforums&cont=importer'); ?>">
		<i class="check icon"></i><?php el('Start'); ?>
	</button>
	
	<div class="ui message info"><?php el('Make sure to copy the avatars and attachments directories to the new extension path after you finish.'); ?></div>
	
	<div class="ui clearing divider"></div>
	
	<div class="ui vertical ordered steps">
		<div class="active step link" data-step="forums">
			<div class="content">
				<div class="title"><?php el('Categories and Forums'); ?></div>
				<div class="description"><?php el('Import categories and forums.'); ?></div>
			</div>
		</div>
		<div class="disabled step link" data-step="topics">
			<div class="content">
				<div class="title"><?php el('Topics'); ?></div>
				<div class="description"><?php el('Import topics and their data.'); ?></div>
			</div>
		</div>
		<div class="disabled step link" data-step="posts">
			<div class="content">
				<div class="title"><?php el('Posts'); ?></div>
				<div class="description"><?php el('Import posts and their data.'); ?></div>
			</div>
		</div>
		<div class="disabled step link" data-step="pm">
			<div class="content">
				<div class="title"><?php el('Private messages'); ?></div>
				<div class="description"><?php el('Import private messages.'); ?></div>
			</div>
		</div>
		<div class="disabled step link" data-step="profiles">
			<div class="content">
				<div class="title"><?php el('Users profiles'); ?></div>
				<div class="description"><?php el('Import users profiles.'); ?></div>
			</div>
		</div>
	</div>
	
	<div class="ui progress">
		<div class="bar"></div>
		<div class="label"></div>
	</div>
	
</form>
