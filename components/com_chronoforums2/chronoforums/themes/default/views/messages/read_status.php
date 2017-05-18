<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(strtotime($message['DiscussionUser']['last_read']) < strtotime($message['Last']['created'])): ?>
<div class="ui label small black circular empty"></div>
<?php else: ?>
<div class="ui label small circular empty read"></div>
<?php endif; ?>