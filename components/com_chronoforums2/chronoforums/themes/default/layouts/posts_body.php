<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<div class="ui top attached segment clearing very slim">
	<?php $this->view('views.topics.details', ['topic' => $topic]); ?>
</div>
<div class="ui attached segment clearing very slim">
	<div class="ui grid">
		<div class="six wide column"><?php $this->view('views.topics.status_links', ['topic' => $topic]); ?></div>
		<div class="ten wide column right aligned"><?php echo $this->Paginator->navigation(); ?></div>
	</div>
</div>
<div class="ui attached segment slim">
{VIEW}
</div>
<div class="ui bottom attached segment clearing very slim">
	<div class="ui grid">
		<div class="six wide column"></div>
		<div class="ten wide column right aligned"><?php echo $this->Paginator->navigation(); ?></div>
	</div>
</div>