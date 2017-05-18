<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(!empty($activities)): ?>
<div class="ui feed small activities">
	<?php foreach($activities as $activity): ?>
	<div class="event">
		<div class="">
			<?php if($activity['Activity']['type'] == 'topic'): ?>
				<i class="icon talk circular"></i>
			<?php elseif($activity['Activity']['type'] == 'post'): ?>
				<i class="icon reply teal circular"></i>
			<?php endif; ?>
		</div>
		<div class="content">
			<div class="summary">
				<?php if($activity['Activity']['type'] == 'topic'): ?>
					<?php el('Posted'); ?>&nbsp;<a href="<?php echo r_('index.php?ext=chronoforums&cont=posts'.rp('t', $activity['Topic']['id']).rp('alias', $activity['Topic']['alias'])); ?>"><?php echo $activity['Topic']['title']; ?></a>
				<?php elseif($activity['Activity']['type'] == 'post'): ?>
					<?php el('Replied on'); ?>&nbsp;<a href="<?php echo r_('index.php?ext=chronoforums&cont=posts'.rp('t', $activity['Topic']['id']).rp('alias', $activity['Topic']['alias']).'#'.$activity['Activity']['title']); ?>"><?php echo $activity['Topic']['title']; ?></a>
				<?php endif; ?>
				
				<?php $this->view('views.date', ['timestamp' => strtotime($activity['Activity']['created'])]); ?>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
</div>
<?php endif; ?>