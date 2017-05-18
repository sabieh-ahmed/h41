<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<div class="ui buttons">
	<?php $this->view('views.topics.publish_link', ['topic' => $topic['Topic']]); ?>
	<?php $this->view('views.topics.lock_link', ['topic' => $topic['Topic']]); ?>
</div>
<div class="ui buttons">
	<?php $this->view('views.topics.delete_link', ['topic' => $topic['Topic']]); ?>
	<?php $this->view('views.topics.edit_link', ['topic' => $topic['Topic']]); ?>
</div>
<div class="ui buttons">
	<?php $this->view('views.topics.subscribe_link', ['topic' => $topic['Topic'], 'subscribed' => $topic['TopicSubscriber']['topic_id']]); ?>
	<?php $this->view('views.topics.favorite_link', ['topic' => $topic['Topic'], 'favorite' => $topic['Favorite']['topic_id']]); ?>
	<?php $this->view('views.topics.feature_link', ['topic' => $topic['Topic'], 'featured' => $topic['Featured']['topic_id']]); ?>
</div>