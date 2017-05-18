<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<div class="ui top attached menu inverted clearing">
	<a class="item red <?php if(!empty($box) AND $box == 'inbox'): ?>active<?php endif; ?>" href="<?php echo r_('index.php?ext=chronoforums&cont=messages&act=inbox'.rp('u', \GApp::user()->get('id'))); ?>"><i class="inbox icon"></i><?php el('Inbox'); ?></a>
	<a class="item blue <?php if(!empty($box) AND $box == 'outbox'): ?>active<?php endif; ?>" href="<?php echo r_('index.php?ext=chronoforums&cont=messages&act=outbox'.rp('u', \GApp::user()->get('id'))); ?>"><i class="send icon"></i><?php el('Outbox'); ?></a>
	<div class="right menu">
		<a class="item red <?php if($this->data('msg_filter') == 'unread'): ?>active<?php endif; ?>" href="<?php echo r_('index.php?ext=chronoforums&cont=messages&msg_filter=unread'.rp('act', $this->action).rp('u', \GApp::user()->get('id'))); ?>"><i class="mail icon"></i><?php el('Unread'); ?></a>
	</div>
</div>
<div class="ui attached segment clearing very slim">
	<div class="ui grid">
		<div class="six wide column">
			<?php $this->view('views.messages.compose_link'); ?>
		</div>
		<div class="ten wide column right aligned"><?php echo !empty($this->Paginator) ? $this->Paginator->navigation() : ''; ?></div>
	</div>
</div>
<div class="ui bottom attached segment slim">
{VIEW}
</div>