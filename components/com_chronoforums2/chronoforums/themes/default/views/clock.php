<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<div class="ui dropdown icon item labels">
	<i class="clock icon"></i>&nbsp;<?php echo date('H:i'); ?>
	<div class="menu drop">
		<div class="ui info message">
			<i class="icon clock large"></i><?php $this->view('views.date', ['timestamp' => time(), 'full' => true]); ?>
		</div>
	</div>
</div>