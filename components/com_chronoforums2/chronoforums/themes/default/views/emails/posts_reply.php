<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php el('Hello %s', [$user['User']['name']]); ?>
<p>
	<?php el('A new post was made on "%s"', [$topic['title']]); ?>, <?php el('You can read it at the link below:'); ?>
</p>
<p>
	<a href="<?php echo r_('index.php?ext=chronoforums&cont=posts'.rp('t', $topic['id']).'#'.$post_id, false, true); ?>">
		<?php echo r_('index.php?ext=chronoforums&cont=posts'.rp('t', $topic['id']).'#'.$post_id, false, true); ?>
	</a>
</p>