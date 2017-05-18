<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(\GApp::access('chronoforums', 'reports_view') === true): ?>
<?php if(!empty($post['Report'])): ?>
	<?php foreach($post['Report'] as $k => $report): ?>
		<div class="ui message yellow tiny cfu-report">
			<p><?php echo $report['reason']; ?></p>
			<div class="description">
				<div class="metadata fluid">
					<?php $this->view('views.profiles.username', ['user' => $post['ReportAuthor'][$k]]); ?>
					<?php $this->view('views.date', ['timestamp' => strtotime($report['created'])]); ?>
					<?php $this->view('views.reports.delete_link', ['report' => $report]); ?>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
<?php endif; ?>
<?php endif; ?>