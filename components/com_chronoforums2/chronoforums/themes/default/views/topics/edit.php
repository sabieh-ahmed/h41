<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<form class="ui form" action="<?php echo r_('index.php?ext=chronoforums&cont=topics&act='.$this->action); ?>" method="post">

	<div class="required field">
		<label><?php el('Topic title'); ?></label>
		<input type="text" placeholder="<?php el('Topic title'); ?>" name="Topic[title]">
	</div>
	
	<input type="hidden" name="f" value="">
	<input type="hidden" name="t" value="">
	
	<?php if(empty($select_forum)): ?>
	<div class="required field">
		<label><?php el('Select forum'); ?></label>
		<div class="ui selection dropdown">
			<input type="hidden" name="f" value="">
			<i class="dropdown icon"></i>
			<div class="default text"><?php el('Select forum'); ?></div>
			<div class="menu">
				<?php foreach($parents as $parent): ?>
					<?php if($parent['type'] == 'forum'): ?>
					<div class="item" data-value="<?php echo $parent['id']; ?>"><?php echo str_repeat('<i class="icon long arrow right"></i>', $parent['_depth']).$parent['title']; ?></div>
					<?php else: ?>
					<div class="header"><i class="icon minus"></i><?php echo str_repeat('- ', $parent['_depth']).$parent['title']; ?></div>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<?php endif; ?>
	
	<?php if((int)$this->get('fparams')->get('enable_topics_tags', 1) AND !empty($tags)): ?>
	<div class="field">
		<label><?php el('Select topic tags'); ?></label>
		<select name="tags[]" multiple="" class="ui fluid dropdown">
			<option value=""><?php el('Select topic tags'); ?></option>
			<?php foreach($tags as $id => $title): ?>
			<option value="<?php echo $id; ?>"><?php echo $title; ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<?php endif; ?>
	
	<?php if($this->action == 'add'): ?>
	<div class="required field">
		<label><?php el('Topic text'); ?></label>
		<?php 
			$this->view('views.editor', [
				'data' => $topic, 
				'type' => 'new', 
				'url' => r_('index.php?ext=chronoforums&cont=topics&act=add&tvout=view&t='.$topic['id']),
				'buttons' => ['save' => false],
			]); 
		?>
	</div>
	<?php endif; ?>
	
	<?php if($this->action == 'add' AND (bool)$this->get('fparams')->get('gcaptcha_enabled', 0) == true AND count(array_intersect($this->get('fparams')->get('gcaptcha_groups', []), \GApp::user()->get('groups')))): ?>
		<?php
			echo '<div class="g-recaptcha" data-sitekey="'.$this->get('fparams')->get('gcaptcha_sitekey', '').'" data-theme="light"></div>';
			\GApp::document()->addJsFile('https://www.google.com/recaptcha/api.js?hl='.explode('_', \G2\L\Config::get('site.language'))[0]);
		?>
	<?php endif; ?>
	
	<?php if($this->action == 'add'): ?>
	<div class="field">
		<button class="ui button icon labeled green" name="add"><i class="checkmark icon large"></i>&nbsp;<?php el('Create new topic'); ?></button>
	</div>
	<?php endif; ?>
	
	<?php if($this->action == 'edit'): ?>
	<div class="field">
		<button class="ui button icon labeled green" name="edit"><i class="checkmark icon large"></i>&nbsp;<?php el('Update topic'); ?></button>
		<a class="ui button icon labeled red" href="<?php echo r_('index.php?ext=chronoforums&cont=posts&t='.$this->data['t']); ?>"><i class="cancel icon large"></i>&nbsp;<?php el('Cancel'); ?></a>
	</div>
	<?php endif; ?>
	
</form>