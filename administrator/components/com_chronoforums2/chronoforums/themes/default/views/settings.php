<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php
	ob_start();
?>
<script>
	jQuery(document).ready(function($) {
		$('.dropdown.G2-options').each(function(i, field){
			$(field).dropdown({
				apiSettings: {
					url: $(field).data('url'),
					cache:false
				},
				saveRemoteData:false
			});
		});
	});
</script>
<?php
	$jscode = ob_get_clean();
	\GApp::document()->addHeaderTag($jscode);
?>
<form action="<?php echo r_('index.php?ext=chronoforums&act=settings'); ?>" method="post" name="admin_form" id="admin_form" class="ui form">

	<h2 class="ui header"><?php el('Settings Manager'); ?></h2>
	<div class="ui">
		<button type="button" class="compact ui button green icon labeled toolbar-button" data-url="<?php echo r_('index.php?ext=chronoforums&act=save_settings'); ?>">
			<i class="check icon"></i><?php el('Save'); ?>
		</button>
	</div>
	
	<div class="ui clearing divider"></div>
	
	<div class="ui segment">
		<input type="hidden" name="Extension[id]" value="">
		
		<div class="ui grid">
			<div class="four wide column">
				<div class="ui vertical pointing menu fluid G2-tabs">
					<a class="blue item active" data-tab="general"><?php el('General'); ?></a>
					<a class="blue item" data-tab="posting"><?php el('Posting'); ?></a>
					<a class="blue item" data-tab="display"><?php el('Display'); ?></a>
					<a class="blue item" data-tab="users"><?php el('Users'); ?></a>
					<a class="blue item" data-tab="notifications"><?php el('Notifications'); ?></a>
					<a class="blue item" data-tab="pm"><?php el('Private messaging'); ?></a>
					<a class="blue item" data-tab="responder"><?php el('Auto responder'); ?></a>
					<a class="blue item" data-tab="styles"><?php el('Styles'); ?></a>
				</div>
			</div>
			<div class="twelve wide stretched column">
			
				<div class="ui segment tab active" data-tab="general">
					<div class="field">
						<div class="ui toggle checkbox">
							<input type="hidden" name="Extension[settings][offline]" data-ghost="1" value="">
							<input type="checkbox" class="hidden" name="Extension[settings][offline]" value="1">
							<label><?php el('Forum offline'); ?></label>
						</div>
					</div>
					<div class="field">
						<label><?php el('Offline message'); ?></label>
						<textarea name="Extension[settings][offline_message]" rows="2"></textarea>
					</div>
					<div class="field">
						<label><?php el('Board announcement'); ?></label>
						<textarea name="Extension[settings][board_announcement]" rows="2"></textarea>
					</div>
					<div class="field">
						<div class="ui toggle checkbox">
							<input type="hidden" name="Extension[settings][forum_permissions]" data-ghost="1" value="">
							<input type="checkbox" class="hidden" name="Extension[settings][forum_permissions]" value="1">
							<label><?php el('Enable distinct forum permissions'); ?></label>
						</div>
						<div class="ui label red small left pointing"><?php el('Do not enable this unless you configure the permissions under each forum.'); ?></div>
					</div>
					<div class="field">
						<div class="ui toggle checkbox">
							<input type="hidden" name="Extension[settings][enable_full_topics_list]" data-ghost="1" value="">
							<input type="checkbox" checked="checked" class="hidden" name="Extension[settings][enable_full_topics_list]" value="1">
							<label><?php el('Enable all forums topics mode'); ?></label>
						</div>
					</div>
					
					<div class="field four wide">
						<label><?php el('Tracked topics period'); ?></label>
						<input type="text" name="Extension[settings][topics_track_period]" value="30">
					</div>
					
					<div class="field four wide">
						<label><?php el('Active topic number of days'); ?></label>
						<input type="text" name="Extension[settings][active_topic_days]" value="7">
					</div>
					
					<div class="field four wide">
						<label><?php el('Auto lock topic for inactivity number of days'); ?></label>
						<input type="text" name="Extension[settings][auto_lock_topic_inactive_limit]" value="0">
					</div>
					
					<div class="field four wide">
						<label><?php el('Topic hot status number of posts per day'); ?></label>
						<input type="text" name="Extension[settings][topic_hot_threshold]" value="5">
					</div>
					
					<div class="field">
						<div class="ui toggle checkbox">
							<input type="hidden" name="Extension[settings][enable_code_highlight]" data-ghost="1" value="">
							<input type="checkbox" checked="checked" class="hidden" name="Extension[settings][enable_code_highlight]" value="1">
							<label><?php el('Enable code highlighting'); ?></label>
						</div>
					</div>
					
					<div class="ui header dividing"><?php el('Attachments settings'); ?></div>
					<div class="field">
						<div class="ui toggle checkbox">
							<input type="hidden" name="Extension[settings][attach_files]" data-ghost="1" value="">
							<input type="checkbox" checked="checked" class="hidden" name="Extension[settings][attach_files]" value="1">
							<label><?php el('Enable attachments'); ?></label>
						</div>
					</div>
					<div class="field">
						<label><?php el('Attachments extensions'); ?></label>
						<input type="text" name="Extension[settings][allowed_extensions]" value="jpg-png-gif-zip-pdf-doc-docx-txt">
					</div>
					<div class="field">
						<label><?php el('Inline preview'); ?></label>
						<input type="text" name="Extension[settings][inline_extensions]" value="jpg-png-gif">
					</div>
					<div class="field four wide">
						<label><?php el('Attachment max size'); ?></label>
						<input type="text" name="Extension[settings][attachment_max_size]" value="1000">
					</div>
					<!--
					<div class="field">
						<div class="ui toggle checkbox">
							<input type="checkbox" class="hidden" name="Extension[settings][user_directory_files]" value="1">
							<label><?php el('Per user attachments directory'); ?></label>
						</div>
					</div>
					-->
					
					<div class="ui header dividing"><?php el('Tags settings'); ?></div>
					<div class="field">
						<div class="ui toggle checkbox">
							<input type="hidden" name="Extension[settings][enable_topics_tags]" data-ghost="1" value="">
							<input type="checkbox" checked="checked" class="hidden" name="Extension[settings][enable_topics_tags]" value="1">
							<label><?php el('Enable topics tags'); ?></label>
						</div>
					</div>
					<div class="field four wide">
						<label><?php el('Tags limit per topic'); ?></label>
						<input type="text" name="Extension[settings][topics_tags_limit]" value="3">
					</div>
					
				</div>
				
				<div class="ui segment tab" data-tab="posting">
					<div class="field">
						<div class="ui toggle checkbox">
							<input type="checkbox" class="hidden" name="Extension[settings][auto_publish_topics]" value="1">
							<label><?php el('Auto publish new topics'); ?></label>
						</div>
					</div>
					<div class="field">
						<div class="ui toggle checkbox">
							<input type="checkbox" class="hidden" name="Extension[settings][auto_publish_replies]" value="1">
							<label><?php el('Auto publish new posts'); ?></label>
						</div>
					</div>
					<div class="field four wide">
						<label><?php el('Auto approval published posts threshold'); ?></label>
						<input type="text" name="Extension[settings][posts_auto_approval_threshold]" value="1">
					</div>
					<div class="field four wide">
						<label><?php el('Unpublished posts threshold'); ?></label>
						<input type="text" name="Extension[settings][non_approved_posts_threshold]" value="1">
					</div>
					
					<div class="field four wide">
						<label><?php el('Approved posts threshold for editing posts'); ?></label>
						<input type="text" name="Extension[settings][posts_edit_threshold]" value="5">
					</div>
					
					<div class="ui header dividing"><?php el('Anti spam'); ?></div>
					
					<div class="field">
						<label><?php el('Minimum time between posts or topics per user in seconds'); ?></label>
						<input type="text" name="Extension[settings][flooding_limit]" value="20">
					</div>
					
					<div class="field">
						<div class="ui toggle checkbox">
							<input type="checkbox" class="hidden" name="Extension[settings][change_post_emails]" value="1">
							<label><?php el('Modify email addresses in posts'); ?></label>
						</div>
					</div>
					
					<div class="field">
						<div class="ui toggle checkbox">
							<input type="checkbox" class="hidden" name="Extension[settings][gcaptcha_enabled]" value="1">
							<label><?php el('Enable Google noCaptcha'); ?></label>
						</div>
					</div>
					<div class="field">
						<label><?php el('noCaptcha site key'); ?></label>
						<input type="text" name="Extension[settings][gcaptcha_sitekey]" value="">
					</div>
					<div class="field">
						<label><?php el('noCaptcha secret key'); ?></label>
						<input type="text" name="Extension[settings][gcaptcha_secretkey]" value="">
					</div>
					<div class="field">
						<label><?php el('NoCaptcha required user groups'); ?></label>
						<select name="Extension[settings][gcaptcha_groups][]" multiple="" class="ui fluid dropdown">
							<option value=""><?php el('Select groups'); ?></option>
							<?php foreach($groups as $id => $title): ?>
							<option value="<?php echo $id; ?>"><?php echo $title; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					
				</div>
				
				<div class="ui segment tab" data-tab="display">
					<div class="field four wide">
						<label><?php el('Topics list limit per page'); ?></label>
						<input type="text" name="Extension[settings][topics_limit]" value="30">
					</div>
					<div class="field four wide">
						<label><?php el('Posts list limit per page'); ?></label>
						<input type="text" name="Extension[settings][posts_limit]" value="30">
					</div>
					
					<div class="field">
						<div class="ui toggle checkbox">
							<input type="hidden" name="Extension[settings][enable_rss]" data-ghost="1" value="">
							<input type="checkbox" checked="checked" class="hidden" name="Extension[settings][enable_rss]" value="1">
							<label><?php el('Enable rss feed button'); ?></label>
						</div>
					</div>
					
					<div class="ui header dividing"><?php el('Editor settings'); ?></div>
					<div class="field">
						<div class="ui toggle checkbox">
							<input type="hidden" name="Extension[settings][enable_smilies]" data-ghost="1" value="">
							<input type="checkbox" checked="checked" class="hidden" name="Extension[settings][enable_smilies]" value="1">
							<label><?php el('Enable smilies'); ?></label>
						</div>
					</div>
					<div class="field">
						<div class="ui toggle checkbox">
							<input type="hidden" name="Extension[settings][enable_icons]" data-ghost="1" value="">
							<input type="checkbox" checked="checked" class="hidden" name="Extension[settings][enable_icons]" value="1">
							<label><?php el('Enable icons'); ?></label>
						</div>
					</div>
					
				</div>
				
				<div class="ui segment tab" data-tab="users">
					<div class="field">
						<div class="ui toggle checkbox">
							<input type="hidden" name="Extension[settings][enable_online_status]" data-ghost="1" value="">
							<input type="checkbox" checked="checked" class="hidden" name="Extension[settings][enable_online_status]" value="1">
							<label><?php el('Show user online status'); ?></label>
						</div>
					</div>
					
					<div class="field four wide">
						<label><?php el('Online time limit in minutes'); ?></label>
						<input type="text" name="Extension[settings][online_time_limit]" value="10">
					</div>
					
					<div class="ui header dividing"><?php el('Avatars settings'); ?></div>
					
					<div class="field four wide">
						<label><?php el('Avatar max file size in KB'); ?></label>
						<input type="text" name="Extension[settings][avatars_max_size]" value="25">
					</div>
					
					<div class="field four wide">
						<label><?php el('Avatar max height in px'); ?></label>
						<input type="text" name="Extension[settings][avatars_max_height]" value="100">
					</div>
					
					<div class="field four wide">
						<label><?php el('Avatar max width in px'); ?></label>
						<input type="text" name="Extension[settings][avatars_max_width]" value="100">
					</div>
					
					<div class="ui header dividing"><?php el('Tropies settings'); ?></div>
					
					<div class="field">
						<div class="ui toggle checkbox">
							<input type="hidden" name="Extension[settings][enable_users_trophies]" data-ghost="1" value="">
							<input type="checkbox" checked="checked" class="hidden" name="Extension[settings][enable_users_trophies]" value="1">
							<label><?php el('Show user tropies'); ?></label>
						</div>
					</div>
					
					<div class="field four wide">
						<label><?php el('Post trophy value'); ?></label>
						<input type="text" name="Extension[settings][post_trophy]" value="1">
					</div>
					<div class="field four wide">
						<label><?php el('Like trophy value'); ?></label>
						<input type="text" name="Extension[settings][vote_trophy]" value="5">
					</div>
					<div class="field four wide">
						<label><?php el('Answer trophy value'); ?></label>
						<input type="text" name="Extension[settings][answer_trophy]" value="10">
					</div>
					
					<div class="ui header dividing"><?php el('Delete user settings'); ?></div>
					
					<div class="field four wide">
						<label><?php el('Delete denial posts threshold'); ?></label>
						<input type="text" name="Extension[settings][users_delete_posts_threshold]" value="3">
					</div>
					<div class="field">
						<label><?php el('Groups which can not be deleted'); ?></label>
						<select name="Extension[settings][undeletable_groups][]" multiple="" class="ui fluid dropdown">
							<option value=""><?php el('Select groups'); ?></option>
							<?php foreach($groups as $id => $title): ?>
							<option value="<?php echo $id; ?>"><?php echo $title; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				
				<div class="ui segment tab" data-tab="notifications">
					
					<div class="ui header dividing"><?php el('Reports notifications'); ?></div>
					<div class="field">
						<div class="ui toggle checkbox">
							<input type="hidden" name="Extension[settings][enable_reports_notification]" data-ghost="1" value="">
							<input type="checkbox" checked="checked" class="hidden" name="Extension[settings][enable_reports_notification]" value="1">
							<label><?php el('Send email on new reports'); ?></label>
						</div>
					</div>
					<div class="field">
						<label><?php el('Reports notified groups'); ?></label>
						<select name="Extension[settings][reports_notification_groups][]" multiple="" class="ui fluid dropdown">
							<option value=""><?php el('Select groups'); ?></option>
							<?php foreach($groups as $id => $title): ?>
							<option value="<?php echo $id; ?>"><?php echo $title; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					
					<div class="ui header dividing"><?php el('Topics notifications'); ?></div>
					<div class="field">
						<div class="ui toggle checkbox">
							<input type="checkbox" class="hidden" name="Extension[settings][enable_topics_notification]" value="1">
							<label><?php el('Send email on new topics'); ?></label>
						</div>
					</div>
					<div class="field">
						<div class="ui toggle checkbox">
							<input type="checkbox" class="hidden" name="Extension[settings][topics_notification_not_approved]" value="1">
							<label><?php el('Send the notification only when the topic is waiting approval'); ?></label>
						</div>
					</div>
					<div class="field">
						<label><?php el('New topics notified groups'); ?></label>
						<select name="Extension[settings][topics_notification_groups][]" multiple="" class="ui fluid dropdown">
							<option value=""><?php el('Select groups'); ?></option>
							<?php foreach($groups as $id => $title): ?>
							<option value="<?php echo $id; ?>"><?php echo $title; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					
					<div class="ui header dividing"><?php el('Posts notifications'); ?></div>
					<div class="field">
						<div class="ui toggle checkbox">
							<input type="hidden" name="Extension[settings][enable_replies_notification]" data-ghost="1" value="">
							<input type="checkbox" checked="checked" class="hidden" name="Extension[settings][enable_replies_notification]" value="1">
							<label><?php el('Notify topic subscribers of new replies'); ?></label>
						</div>
					</div>
					
					<div class="field">
						<div class="ui toggle checkbox">
							<input type="checkbox" class="hidden" name="Extension[settings][enable_posts_notification]" value="1">
							<label><?php el('Send email on new posts'); ?></label>
						</div>
					</div>
					<div class="field">
						<div class="ui toggle checkbox">
							<input type="checkbox" class="hidden" name="Extension[settings][posts_notification_not_approved]" value="1">
							<label><?php el('Send the notification only when the post is waiting approval'); ?></label>
						</div>
					</div>
					<div class="field">
						<label><?php el('New posts notified groups'); ?></label>
						<select name="Extension[settings][posts_notification_groups][]" multiple="" class="ui fluid dropdown">
							<option value=""><?php el('Select groups'); ?></option>
							<?php foreach($groups as $id => $title): ?>
							<option value="<?php echo $id; ?>"><?php echo $title; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					
					<div class="field">
						<div class="ui toggle checkbox">
							<input type="checkbox" class="hidden" name="Extension[settings][enable_posts_edit_notification]" value="1">
							<label><?php el('Send email on editing posts'); ?></label>
						</div>
					</div>
					<div class="field">
						<label><?php el('Edit posts notified groups'); ?></label>
						<select name="Extension[settings][posts_edit_notification_groups][]" multiple="" class="ui fluid dropdown">
							<option value=""><?php el('Select groups'); ?></option>
							<?php foreach($groups as $id => $title): ?>
							<option value="<?php echo $id; ?>"><?php echo $title; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					
					
					<!--
					<div class="field">
						<label><?php el('Reports notified users'); ?></label>
						<div class="ui multiple search selection dropdown G2-options" data-url="<?php echo r_('index.php?ext=chronoforums&act=users&tvout=view&q={query}'); ?>">
							<input type="hidden" name="Extension[settings][reports_notification_users]" value="">
							<i class="dropdown icon"></i>
							<div class="default text"><?php el('Select users'); ?></div>
							<div class="menu">
								
							</div>
						</div>
					</div>
					-->
				</div>
				
				<div class="ui segment tab" data-tab="pm">
					<div class="field">
						<div class="ui toggle checkbox">
							<input type="hidden" name="Extension[settings][enable_pm]" data-ghost="1" value="">
							<input type="checkbox" checked="checked" class="hidden" name="Extension[settings][enable_pm]" value="1">
							<label><?php el('Enable private messaging'); ?></label>
						</div>
					</div>
					
					<div class="field four wide">
						<label><?php el('Approved posts threshold for sending'); ?></label>
						<input type="text" name="Extension[settings][messages_posts_threshold]" value="1">
					</div>
				</div>
				
				<div class="ui segment tab" data-tab="responder">
					<div class="field">
						<div class="ui toggle checkbox">
							<input type="hidden" name="Extension[settings][enable_responder]" data-ghost="1" value="">
							<input type="checkbox" class="hidden" name="Extension[settings][enable_responder]" value="1">
							<label><?php el('Enable auto responder'); ?></label>
						</div>
					</div>
					
					<div class="field four wide">
						<label><?php el('The id of the user account used for auto replies'); ?></label>
						<input type="text" name="Extension[settings][responder_user_id]" value="0">
					</div>
					
					<div class="field">
						<label><?php el('Responder code, should return a non empty string'); ?></label>
						<textarea name="Extension[settings][responder_reply]" rows="10"></textarea>
					</div>
				</div>
				
				<div class="ui segment tab" data-tab="styles">
					<div class="field">
						<label><?php el('Custom styles'); ?></label>
						<textarea name="Extension[settings][custom_styles]" rows="8"></textarea>
					</div>
				</div>
				
			</div>
		</div>
		
	</div>
	
</form>