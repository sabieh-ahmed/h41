<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if($this->get('fparams')->get('enable_users_trophies', 1) AND !empty($profile)): ?>
	<?php
		$score = ((int)$profile['post_count'] * (int)$this->get('fparams')->get('post_trophy', 1)) + ((int)$profile['vote_count'] * $this->get('fparams')->get('vote_trophy', 5)) + ((int)$profile['answer_count'] * $this->get('fparams')->get('answer_trophy', 10));
		$gold = floor($score / 10000);
		$silver = floor(($score - $gold * 10000) / 100);
		$bronze = ($score - $gold * 10000 - $silver * 100);
	?>
	<div class="metadata">
		<?php if(!empty($gold)): ?>
			<i class="icon yellow trophy"></i><?php echo $gold; ?>
		<?php endif; ?>
		<?php if(!empty($silver)): ?>
			<i class="icon grey trophy"></i><?php echo $silver; ?>
		<?php endif; ?>
		<?php if(!empty($bronze)): ?>
			<i class="icon brown trophy"></i><?php echo $bronze; ?>
		<?php endif; ?>
	</div>
<?php endif; ?>