<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php
	ob_start();
?>
<script>
	jQuery(document).ready(function($) {
		$.G2.actions.include({
			'load-activities':{
				'beforeStart' : function(action, event){
					action.data('url', action.data('url') + '&startat='+ $('.activities').find('.event').length);
				},
				'success' : function(action, html, json){
					if(json == false){
						if(html.length == 0){
							action.hide();
						}
						var newResults = $(html);
						action.before(newResults);
					}
				}
			}
		});
	});
</script>
<?php
	$jscode = ob_get_clean();
	\GApp::document()->addHeaderTag($jscode);
?>
<div class="ui pointing menu small G2-tabs">
	<a class="item active" data-tab="basics"><?php el('Basics'); ?></a>
	<a class="item" data-tab="activity"><?php el('Activity'); ?></a>
	
	<div class="menu right">
		<?php if(\GApp::access('chronoforums', 'users_delete') === true): ?>
			<div class="item">
				<div class="compact ui button red icon labeled G2-static" data-task="popup" data-hint="<?php el('Delete this user and all their data.'); ?>"><i class="trash icon"></i><?php el('Delete'); ?></div>
				<div class="ui fluid popup top left transition hidden G2-static-popup">
					<a class="ui button red icon fluid" href="<?php echo r_('index.php?ext=chronoforums&cont=profiles&act=delete'.rp('u', $user['User']['id'])); ?>"><?php el('Delete this user and all their data.'); ?></a>
				</div>
			</div>
		<?php endif; ?>
		<?php if($user['User']['id'] == \GApp::user()->get('id')): ?>
		<div class="item right">
			<a type="button" class="compact ui button blue icon labeled" href="<?php echo r_('index.php?ext=chronoforums&cont=profiles&act=edit'.rp('u', $user['User']['id'])); ?>">
				<i class="write icon"></i><?php el('Edit'); ?>
			</a>
		</div>
		<div class="item">
			<div class="compact ui button icon labeled G2-static" data-task="popup" data-hint="<?php el('Unsubscribe from all the topics on this board.'); ?>"><i class="mail icon"></i><?php el('Unsubscribe'); ?></div>
			<div class="ui fluid popup top left transition hidden G2-static-popup">
				<a class="ui button red icon fluid" href="<?php echo r_('index.php?ext=chronoforums&cont=profiles&act=unsubscribe'.rp('u', $user['User']['id'])); ?>"><?php el('Yes, unsubscribe me.'); ?></a>
			</div>
		</div>
		<?php endif; ?>
	</div>
</div>
<div class="ui tab active" data-tab="basics">
	<?php $this->view('views.profiles.basics', ['user' => $user['User'], 'profile' => $user['Profile']]); ?>
</div>
<div class="ui tab" data-tab="activity">
	<?php $this->view('views.profiles.activities', ['user' => $user['User'], 'profile' => $user['Profile'], 'activities' => $activities]); ?>
	<div class="ui button icon fluid G2-dynamic" data-id="load-activities" data-url="<?php echo r_('index.php?ext=chronoforums&cont=profiles&act=activities&tvout=view'.rp('u', $user['User']['id'])); ?>"><i class="refresh layout icon"></i>&nbsp;<?php el('Load more...'); ?></div>
</div>