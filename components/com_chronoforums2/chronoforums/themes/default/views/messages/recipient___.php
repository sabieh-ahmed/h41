<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<div class="ui minimal comments">
	<div class="comment">
		<?php $this->view('views.profiles.avatar', ['user' => $user, 'profile' => $profile]); ?>
		<div class="content">
			<?php $this->view('views.profiles.username', ['user' => $user]); ?>
		</div>
	</div>
</div>