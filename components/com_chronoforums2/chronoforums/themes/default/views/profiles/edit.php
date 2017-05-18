<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php
	\GApp::document()->_('calendar');
	ob_start();
?>
<script>
	jQuery(document).ready(function($){
		$('.G2-calendar').calendar({
			startMode:'year',
			type:'date',
			
			formatter:{
				date: function (date, settings) {
					if (!date) return '';
					var day = date.getDate();
					var month = date.getMonth() + 1;
					var year = date.getFullYear();
					return year + '-' + month + '-' + day;
				}
			},
			popupOptions:{
				position: 'top center'
			},

			text:{
				days: ['S', 'M', 'T', 'W', 'T', 'F', 'S'],
				months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
				monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
				today: 'Today',
				now: 'Now',
				am: 'AM',
				pm: 'PM'
			}
		});
		
		function readURL(input){
			if(input.files && input.files[0]){
				var reader = new FileReader();
				reader.onload = function (e) {
					$('#ProfileAvatarPreview').html($('<img class="ui image small" />').attr('src', e.target.result));
				}
				reader.readAsDataURL(input.files[0]);
			}
		}

		$('#ProfileAvatar').change(function(){
			readURL(this);
		});
	});
</script>
<?php
	$wizard_jscode = ob_get_clean();
	\GApp::document()->addHeaderTag($wizard_jscode);
?>
<form class="ui form" id="edit-profile" method="post" enctype="multipart/form-data" action="<?php echo r_('index.php?ext=chronoforums&cont=profiles&act=edit'.rp('u', $this->data)); ?>">
	<div class="two fields">
		<div class="field">
			<label><?php el('Location'); ?></label>
			<div class="ui input icon">
				<i class="icon globe"></i>
				<input type="text" name="Profile[location]" placeholder="<?php el('Location'); ?>">
			</div>
		</div>
		<div class="field">
			<label><?php el('Your Website'); ?></label>
			<input type="text" name="Profile[website]" placeholder="">
		</div>
	</div>
	<div class="two fields">
		<div class="field">
			<label><?php el('About you'); ?></label>
			<textarea type="text" name="Profile[about]" rows="3" placeholder="<?php el('About you'); ?>"></textarea>
		</div>
		<div class="field">
			<label><?php el('Signature'); ?></label>
			<textarea type="text" name="Profile[signature]" rows="3" placeholder="<?php el('Signature to add to your posts'); ?>"></textarea>
		</div>
	</div>
	<div class="two fields">
		<div class="field G2-calendar">
			<label><?php el('Date of birth'); ?></label>
			<div class="ui input icon">
				<i class="icon calendar"></i>
				<input type="text" name="Profile[dob]" placeholder="" class="">
			</div>
		</div>
	</div>
	<div class="fields">
		<div class="ten wide field">
			<label><?php el('Avatar'); ?></label>
			<input type="file" name="avatar" id="ProfileAvatar">
		</div>
		<div class="field" id="ProfileAvatarPreview">
			<?php $this->view('views.profiles.avatar', ['size' => 'medium', 'user' => $user['User'], 'profile' => $user['Profile']]); ?>
		</div>
	</div>
	<div class="field">
		<button class="ui button green icon labeled" name="edit">
			<i class="icon checkmark"></i><?php el('Update'); ?>
		</button>
		<a class="ui button red icon labeled" href="<?php echo r_('index.php?ext=chronoforums&cont=profiles'.rp('u', $this->data)); ?>"><i class="icon cancel"></i><?php el('Cancel'); ?></a>
	</div>
</form>