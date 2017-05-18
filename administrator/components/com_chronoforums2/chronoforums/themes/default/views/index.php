<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<div class="ui container">
	<div class="ui header"><?php el('Board statistics'); ?></div>
	<div class="ui relaxed divided list">
		
		<div class="item">
			<i class="large folder middle aligned icon"></i>
			<div class="content">
				<a class="ui header small"><?php el('Forums'); ?></a>
				<div class="description"><?php echo $forums_count; ?></div>
			</div>
		</div>
		
		<div class="item">
			<i class="large write middle aligned icon"></i>
			<div class="content">
				<a class="ui header small"><?php el('Topics'); ?></a>
				<div class="description"><?php echo $topics_count; ?></div>
			</div>
		</div>
		
		<div class="item">
			<i class="large comment middle aligned icon"></i>
			<div class="content">
				<a class="ui header small"><?php el('Posts'); ?></a>
				<div class="description"><?php echo $posts_count; ?></div>
			</div>
		</div>
		
		<div class="item">
			<i class="large attach middle aligned icon"></i>
			<div class="content">
				<a class="ui header small"><?php el('Attachments'); ?></a>
				<div class="description"><?php echo $attachments_count; ?></div>
			</div>
		</div>
		
		<div class="item">
			<i class="large user middle aligned icon"></i>
			<div class="content">
				<a class="ui header small"><?php el('Users'); ?></a>
				<div class="description"><?php echo $users_count; ?></div>
			</div>
		</div>
	</div>
	
</div>