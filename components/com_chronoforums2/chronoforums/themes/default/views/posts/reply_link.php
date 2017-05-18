<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(\GApp::access('chronoforums', 'posts_reply', (int)$topic['user_id']) === true AND empty($topic['locked'])): ?>
<div class="ui button teal icon very compact circular G2-static" data-task="scroll:.editor-box" data-hint="<?php el('Reply'); ?>"><i class="reply icon"></i></div>
<?php endif; ?>