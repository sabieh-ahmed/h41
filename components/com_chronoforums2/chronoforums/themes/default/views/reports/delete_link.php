<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(\GApp::access('chronoforums', 'topics_moderate') === true): ?>
<div class="ui button red icon big circular very compact G2-static" data-task="popup:#delete-report-<?php echo $report['id']; ?>"><i class="trash icon"></i></div>
<div class="ui fluid popup top left transition hidden G2-static-popup" id="delete-report-<?php echo $report['id']; ?>" style="min-width:200px;">
	<div class="ui button red icon fluid G2-dynamic" data-result="remove/closest:.cfu-report" data-url="<?php echo r_('index.php?ext=chronoforums&cont=posts&act=unreport&tvout=view&id='.$report['id']); ?>"><?php el('Confirm report deletion'); ?></div>
</div>
<?php endif; ?>