<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(!empty($forums)): ?>
	<div class="ui segment slim">
	<?php $this->view('views.index', ['forums' => $forums]); ?>
	</div>
<?php endif; ?>

<?php if(empty($_forum) OR $_forum['type'] != 'category'): ?>
	<?php if(in_array($this->action, ['index', 'tagged', 'search'])): ?>
		<div class="ui top attached segment clearing very slim">
			<div class="ui grid">
				<div class="six wide column">
				<?php if(!empty($_forum)): ?>
					<?php $this->view('views.topics.new_topic_link'); ?>
				<?php endif; ?>
				</div>
				<div class="ten wide column right aligned"><?php echo $this->Paginator->navigation(); ?></div>
			</div>
		</div>
		<div class="ui attached segment slim">
		{VIEW}
		</div>
		<div class="ui bottom attached segment clearing very slim">
			<div class="ui grid">
				<div class="six wide column">
				<?php if(!empty($_forum)): ?>
					<?php $this->view('views.topics.new_topic_link'); ?>
				<?php endif; ?>
				</div>
				<div class="ten wide column right aligned"><?php echo $this->Paginator->navigation(); ?></div>
			</div>
		</div>
	<?php else: ?>
		<div class="ui segment slim">
		{VIEW}
		</div>
	<?php endif; ?>
<?php endif; ?>