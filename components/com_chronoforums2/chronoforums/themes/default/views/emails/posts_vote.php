<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php el('Hello %s', [$user['User']['name']]); ?>
<p>
	<?php el('Your post on "%s" has received an upvote by "%s"', [$topic['title'], \GApp::user()->get('username')]); ?>, <?php el('You can read it at the link below:'); ?>
</p>
<p>
	<a href="<?php echo r_('index.php?ext=chronoforums&cont=posts'.rp('t', $topic['id']).'#'.$post['id'], false, true); ?>">
		<?php echo r_('index.php?ext=chronoforums&cont=posts'.rp('t', $topic['id']).'#'.$post['id'], false, true); ?>
	</a>
</p>