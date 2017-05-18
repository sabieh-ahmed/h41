<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php $this->view('views.announcement'); ?>
<?php $this->view('views.breadcrumbs'); ?>
<div class="ui menu">
	<?php $this->view('views.user_menu'); ?>
	<?php $this->view('views.pm_menu'); ?>
	<?php $this->view('views.favorites_menu'); ?>
	<?php $this->view('views.settings_menu'); ?>
	<?php $this->view('views.clock'); ?>
	<div class="right menu">
		<?php $this->view('views.status_filter'); ?>
		<?php $this->view('views.tags_filter', ['tags_filter' => $tags_filter]); ?>
		<?php $this->view('views.search_filter'); ?>
	</div>
</div>
<?php $this->view('views.page_title'); ?>
<?php
	if($this->controller == 'topics'){
		$this->layout('topics_body');
	}else if($this->controller == 'posts'){
		$this->layout('posts_body');
	}else if($this->controller == 'messages'){
		$this->layout('messages_body');
	}else{
		$this->layout('body');
	}
?>