<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if($this->get('fparams')->get('enable_online_status', 1) AND isset($profile)): ?>
	<?php if(time() < ((int)$this->get('fparams')->get('online_time_limit', 10) * 60) + strtotime($profile['last_activity'])): ?>
		<div class="ui label mini circular empty green"></div>
	<?php else: ?>
		<div class="ui label mini circular empty"></div>
	<?php endif; ?>
<?php endif; ?>