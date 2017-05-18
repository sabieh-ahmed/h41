<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(!empty($post['id'])): ?>
<div class="ui minimal comments">
	<div class="comment">
		<?php $this->view('views.profiles.avatar', ['user' => $user, 'profile' => $profile]); ?>
		<div class="content">
			<?php $this->view('views.profiles.username', ['user' => $user, 'profile' => $profile]); ?>
			<a class="metadata fluid" href="<?php echo r_('index.php?ext=chronoforums&cont=posts&t='.$post['topic_id']); ?>">
				<?php $this->view('views.date', ['timestamp' => strtotime($post['created'])]); ?><i class="icon right arrow blue fitted"></i>
			</a>
			<div class="text"></div>
		</div>
	</div>
</div>
<?php endif; ?>