<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php if(\GApp::user()->get('id') AND (bool)\GApp::user()->get('profile.params.enable_topics_track', 0) !== false): ?>
	<?php if(($topic['LastPostUser']['id'] != \GApp::user()->get('id')) AND ((empty($topic['TopicTrack']['last_visit']) AND strtotime($topic['Topic']['created']) > time() - (int)$this->get('fparams')->get('topics_track_period', 30) * 24 * 60 * 60) OR (!empty($topic['LastPost']['created']) AND !empty($topic['TopicTrack']['last_visit']) AND strtotime($topic['TopicTrack']['last_visit']) < strtotime($topic['LastPost']['created'])))): ?>
	<div class="ui label small black circular empty"></div>
	<?php else: ?>
	<div class="ui label small circular empty read"></div>
	<?php endif; ?>
<?php endif; ?>