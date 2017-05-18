<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<div class="comment cfu-post" id="<?php echo $post['Post']['id']; ?>">
	<?php $this->view('views.profiles.avatar', ['user' => $post['Author'], 'profile' => $post['AuthorProfile']]); ?>
	<div class="content cfu-content">
		<?php $this->view('views.profiles.username', ['user' => $post['Author'], 'profile' => $post['AuthorProfile']]); ?>
		<div class="metadata post-details">
			<?php el('Posted'); ?>&nbsp;<?php $this->view('views.date', ['timestamp' => strtotime($post['Post']['created'])]); ?>
			
			<?php $this->view('views.posts.votes_label', ['post' => $post['Post']]); ?>
			<?php $this->view('views.posts.answered_label', ['post' => $post['Post'], 'answer' => !empty($post['Answer']['post_id']) ? $post['Answer'] : null]); ?>
			<?php $this->view('views.posts.reported_label', ['post' => $post['Post'], 'report' => !empty($post['Report']) ? $post['Report'] : null]); ?>
			<?php $this->view('views.posts.unpublished_label', ['post' => $post['Post']]); ?>
		</div>
		
		<div class="text">
		<?php $this->view('views.posts.content', ['post' => $post, 'user' => $post['Author']]); ?>
		</div>
		
		<div class="ui grid two column">
			<div class="column">
				<div class="description padded vertical">
					<div class="metadata fluid">
						<?php $this->view('views.posts.signature', ['user' => $post['Author'], 'profile' => $post['AuthorProfile']]); ?>
					</div>
				</div>
			</div>
			<div class="column">
				<div class="actions">
					<?php $this->view('views.posts.reply_link', ['post' => $post['Post'], 'topic' => !empty($topic['Topic']) ? $topic['Topic'] : $post['Topic']]); ?>
					<?php $this->view('views.posts.quote_link', ['post' => $post['Post'], 'topic' => !empty($topic['Topic']) ? $topic['Topic'] : $post['Topic']]); ?>
					<?php $this->view('views.posts.answered_link', ['post' => $post['Post'], 'topic' => !empty($topic['Topic']) ? $topic['Topic'] : $post['Topic'], 'answer' => !empty($post['Answer']['post_id']) ? $post['Answer'] : null]); ?>
					
					<?php $this->view('views.posts.report_link', ['post' => $post['Post']]); ?>
					
					<?php $this->view('views.posts.publish_link', ['post' => $post['Post']]); ?>
					<?php $this->view('views.posts.edit_link', ['post' => $post['Post']]); ?>
					<?php $this->view('views.posts.delete_link', ['post' => $post['Post']]); ?>
					<?php $this->view('views.posts.split_link', ['post' => $post['Post']]); ?>
					
					<?php $this->view('views.posts.vote_button', ['post' => $post['Post'], 'vote' => !empty($post['Vote']['post_id']) ? $post['Vote'] : null]); ?>
				</div>
			</div>
		</div>
		
		<?php $this->view('views.posts.reports_list', ['post' => $post]); ?>
		<div class="ui divider posts"></div>
	</div>
</div>