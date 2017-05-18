<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<div class="ui card fluid">
	<div class="content ui items">
		<div class="item">
			<?php $this->view('views.profiles.avatar', ['size' => 'medium', 'user' => $user, 'profile' => $profile]); ?>
			<div class="content">
				<?php $this->view('views.profiles.username', ['basic' => true, 'user' => $user, 'profile' => $profile]); ?>
				<div class="meta">
					<?php el('Last seen'); ?>&nbsp;<?php $this->view('views.date', ['timestamp' => strtotime($profile['last_activity'])]); ?>
				</div>
				<div class="description"><?php echo $profile['about']; ?></div>
				<div class="extra"><?php echo $profile['location']; ?></div>
				<div class="extra"><?php echo $profile['website']; ?></div>
			</div>
		</div>
	</div>
	<div class="extra content">
		<?php if(\GApp::access('chronoforums', 'messages_send') === true): ?>
		<a class="ui button large very compact icon" href="<?php echo r_('index.php?ext=chronoforums&cont=messages&act=send'.rp('recipient', $user['id'])); ?>" data-hint="<?php el('Send a message to %s', [$user['username']]); ?>">
			<i class="mail icon"></i>
		</a>
		<?php endif; ?>
		<span class="right floated">
			<?php el('Joined'); ?>&nbsp;<?php $this->view('views.date', ['timestamp' => strtotime($user['register_date'])]); ?>
		</span>
	</div>
</div>