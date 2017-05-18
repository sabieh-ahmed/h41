<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php
	if(empty($size)){
		$aclass = 'avatar';
		$imgclass = 'ui image mini rounded';
	}else if($size == 'medium'){
		$aclass = 'ui image tiny';
		$imgclass = 'ui image tiny rounded';
	}
	
	$colors = ['red', 'orange', 'yellow', 'olive', 'green', 'teal', 'blue', 'violet', 'purple', 'pink', 'brown', 'grey', 'black'];
?>
<a class="<?php echo $aclass; ?> center aligned">
	<?php if(!empty($profile['avatar'])): ?>
		<img class="<?php echo $imgclass; ?>" src="<?php echo r_('index.php?ext=chronoforums&cont=profiles&act=avatar&tvout=file'.rp('u', $profile['user_id']).rp('av', $profile['avatar'])); ?>">
	<?php else: ?>
		<?php if(!empty($user['username'])): ?>
		<?php
			$char = mb_substr($user['username'], 0, 1);
			$position = ord(strtoupper($char)) + strlen($user['username']);
			$position = (int)substr((string)$position, -1);
		?>
		<div class="ui label circular <?php echo $colors[$position]; ?> big"><?php echo $char; ?></div>
		<?php else: ?>
		<div class="ui label circular big">?</div>
		<?php endif; ?>
	<?php endif; ?>
</a>