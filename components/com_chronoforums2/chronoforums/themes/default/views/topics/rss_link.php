<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if((bool)$this->get('fparams')->get('enable_rss', 1) === true): ?>
	<a class="ui button icon orange very compact" href="<?php echo r_('index.php?ext=chronoforums&cont=topics&_format=rss&tvout=view'.rp('f', $this->data).rp('status', $this->data).rp('keywords', $this->data).rp('tagged', $this->data)); ?>" data-hint="<?php el('RSS feed of this list'); ?>"><i class="feed icon large"></i></a>
<?php endif; ?>