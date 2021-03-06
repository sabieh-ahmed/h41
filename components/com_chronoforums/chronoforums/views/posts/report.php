<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<div class="chronoforums posts report">
	<div class="container">
		<div class="row cfu-header">
			<?php echo $this->Elements->header(); ?>
		</div>
		<div class="row cfu-body">
			<h3><?php echo l_('CHRONOFORUMS_POST_REPORT_HEADER'); ?></h3>
			<p><?php echo l_('CHRONOFORUMS_POST_REPORT_INFO'); ?></p>
			<form action="<?php echo r_('index.php?ext=chronoforums&cont=posts&act=report&p='.$post['Post']['id'].'&t='.$post['Post']['topic_id']); ?>" method="post" name="postform" id="postform">
				<?php echo $this->Html->formSecStart(); ?>
				<?php echo $this->Html->formLine('Report[reason]', array('type' => 'textarea', 'label' => l_('CHRONOFORUMS_REPORT_REASON'), 'rows' => '7', 'cols' => '80')); ?>
				<?php echo $this->Html->formLine('buttons', array('type' => 'multi', 'layout' => 'wide',
					'inputs' => array(
						array('type' => 'submit', 'name' => 'cancel_report', 'value' => l_('CHRONOFORUMS_CANCEL'), 'class' => 'btn btn-default'),
						array('type' => 'submit', 'name' => 'confirm_report', 'value' => l_('CHRONOFORUMS_REPORT'), 'class' => 'btn btn-danger')
					)
				)); ?>
				<?php echo $this->Html->formSecEnd(); ?>
			</form>
			<?php require_once(dirname(__FILE__).DS.'post_body.php'); ?>
		</div>
	</div>
</div>