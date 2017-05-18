<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php el('Hello %s', [$user['User']['name']]); ?>
<p>
	<?php el('A new private message was sent to you by "%s" on - %s', [$sender['name'], \GApp::config()->get('site.title')]); ?>, <?php el('You can read it at the link below:'); ?>
</p>
<p>
	<a href="<?php echo r_('index.php?ext=chronoforums&cont=messages&act=read'.rp('d', $discussion['id']), false, true); ?>">
		<?php echo r_('index.php?ext=chronoforums&cont=messages&act=read'.rp('d', $discussion['id']), false, true); ?>
	</a>
</p>