<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(!empty($user['id'])): ?>
	<?php $this->view('views.profiles.online_status', ['user' => $user, 'profile' => !empty($profile) ? $profile : false]); ?>
	<?php if(!empty($basic)): ?>
		<a class="author" href="<?php echo r_('index.php?ext=chronoforums&cont=profiles'.rp('u', $user['id'])); ?>"><?php echo $user['username']; ?></a>
	<?php else: ?>
		<a class="author G2-static G2-dynamic" data-task="popup" data-result="html/next" data-once="1" data-url="<?php echo r_('index.php?ext=chronoforums&cont=profiles&act=mini&tvout=view'.rp('u', $user['id'])); ?>" href="<?php echo r_('index.php?ext=chronoforums&cont=profiles'.rp('u', $user['id'])); ?>"><?php echo $user['username']; ?></a>
		<div class="ui fluid popup transition hidden G2-static-popup" style="padding:0;" data-position="top right"><div class="ui active inline centered loader"></div></div>
	<?php endif; ?>
	<?php if(!empty($trophies) OR !isset($trophies)): ?>
		<?php $this->view('views.profiles.trophies', ['user' => $user, 'profile' => !empty($profile) ? $profile : false]); ?>
	<?php endif; ?>
<?php else: ?>
	<a class="author"><?php echo rl('Guest'); ?></a>
<?php endif; ?>