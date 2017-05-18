<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(!empty($post['VotesCount'])): ?>
	<?php if((int)$post['VotesCount'] > 0): ?>
	<div class="ui label icon green tiny"><i class="arrow up icon"></i>&nbsp;<?php echo $post['VotesCount']; ?></div>
	<?php else: ?>
	<div class="ui label icon red tiny"><i class="arrow down icon"></i>&nbsp;<?php echo $post['VotesCount']; ?></div>
	<?php endif; ?>
<?php endif; ?>