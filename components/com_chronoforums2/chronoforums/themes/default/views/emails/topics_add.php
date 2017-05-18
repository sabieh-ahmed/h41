<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php el('Hello %s', [$user['User']['name']]); ?>
<p>
	<?php el('A new topic has been posted on "%s"', [\GApp::config()->get('site.title')]); ?>, <?php el('You can check it at the link below:'); ?>
</p>
<p>
	<a href="<?php echo r_('index.php?ext=chronoforums&cont=posts'.rp('t', $topic['id']).'#'.$post_id, false, true); ?>">
		<?php echo $topic['title']; ?>
	</a>
</p>