<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if($forum['type'] == 'forum'): ?>
<a class="ui header" href="<?php echo r_('index.php?ext=chronoforums&cont=topics&f='.$forum['id'].'&alias='.$forum['alias']); ?>"><?php echo $forum['title']; ?></a>
<?php else: ?>
<a class="ui header big <?php echo geta($forum, 'params.color', 'blue'); ?>" href="<?php echo r_('index.php?ext=chronoforums&cont=topics&f='.$forum['id'].'&alias='.$forum['alias']); ?>"><?php echo $forum['title']; ?></a>
<?php endif; ?>