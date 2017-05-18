<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<div class="content topic-body">
	<?php $this->view('views.topics.locked_status', ['topic' => $topic['Topic']]); ?>
	<?php $this->view('views.topics.read_status', ['topic' => $topic]); ?>
	<a class="ui header" href="<?php echo r_('index.php?ext=chronoforums&cont=posts&t='.$topic['Topic']['id'].rp('alias', $topic['Topic']).rp('keywords', $this->data)); ?>"><?php echo $topic['Topic']['title']; ?></a>
	<div class="description padded vertical">
		<div class="ui label small"><?php el('Posts'); ?><div class="detail"><?php echo $topic['Topic']['post_count']; ?></div></div>
		<div class="ui label small"><?php el('Views'); ?><div class="detail"><?php echo $topic['Topic']['hits']; ?></div></div>
		<div class="metadata nomargin">
			<?php $this->view('views.profiles.username', ['user' => $topic['Author'], 'profile' => $topic['AuthorProfile'], 'trophies' => false]); ?>,&nbsp;
			<?php $this->view('views.date', ['timestamp' => strtotime($topic['Topic']['created'])]); ?>
			<?php el('in'); ?>&nbsp;<a class="" href="<?php echo r_('index.php?ext=chronoforums&cont=topics'.rp('f', $topic['Forum']['id']).rp('alias', $topic['Forum']['alias'])); ?>"><?php echo $topic['Forum']['title']; ?></a>
		</div>
	</div>
	<div class="description padded vertical">
		<?php $this->view('views.topics.list_tags', ['tags' => !empty($topic['Tag']) ? $topic['Tag'] : []]); ?>
		<?php $this->view('views.topics.published_status', ['topic' => $topic['Topic']]); ?>
		<?php $this->view('views.topics.reported_status', ['topic' => $topic['Topic']]); ?>
		
		<?php $this->view('views.topics.featured_status', ['featured' => !empty($topic['Featured']['topic_id'])]); ?>
		<?php $this->view('views.topics.answered_status', ['topic' => $topic['Topic']]); ?>
		<?php $this->view('views.topics.votes_status', ['votes' => isset($topic['Votes']) ? $topic['Votes'] : []]); ?>
		<?php $this->view('views.topics.hot_status', ['topic' => $topic['Topic']]); ?>
		<?php //$this->view('views.topics.actions_link', ['topic' => $topic]); ?>
	</div>
</div>