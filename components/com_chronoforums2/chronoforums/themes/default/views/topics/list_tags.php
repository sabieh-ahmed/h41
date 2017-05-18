<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(!empty($tags)): ?>
	<?php foreach($tags as $tag): ?>
		<?php
			$hint = !empty($tag['description']) ? 'data-hint="'.$tag['description'].'"' : '';
			$color = !empty($tag['params']['color']) ? $tag['params']['color'] : 'blue';
		?>
		<a class="ui label tiny <?php echo $color; ?> tag" href="<?php echo r_('index.php?ext=chronoforums&cont=topics'.rp('tagged', $tag['alias'])); ?>" <?php echo $hint; ?>>
			<?php echo $tag['title']; ?>
		</a>
	<?php endforeach; ?>
<?php endif; ?>