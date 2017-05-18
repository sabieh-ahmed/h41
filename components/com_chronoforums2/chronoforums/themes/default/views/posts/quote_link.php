<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(\GApp::access('chronoforums', 'posts_reply', (int)$topic['user_id']) === true AND empty($topic['locked'])): ?>
<div class="ui button teal basic icon very compact circular G2-static" data-id="quote-post" data-hint="<?php el('Quote'); ?>"><i class="quote right icon"></i></div>
<?php endif; ?>