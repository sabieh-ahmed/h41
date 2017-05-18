<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<div class="ui list horizontal topic_details">
	<div class="item middle aligned">
	<?php $this->view('views.profiles.username', ['user' => $topic['TopicAuthor'], 'profile' => $topic['TopicAuthorProfile'], 'trophies' => false]); ?>, <?php $this->view('views.date', ['timestamp' => strtotime($topic['Topic']['created'])]); ?>
	</div>
	<div class="item middle aligned">
	<?php $this->view('views.topics.published_status', ['topic' => $topic['Topic']]); ?>
	<?php $this->view('views.topics.featured_status', ['featured' => !empty($topic['Featured']['topic_id'])]); ?>
	</div>
	<div class="item middle aligned">
	<?php $this->view('views.topics.list_tags', ['tags' => !empty($topic['Tag']) ? $topic['Tag'] : []]); ?>
	</div>
</div>