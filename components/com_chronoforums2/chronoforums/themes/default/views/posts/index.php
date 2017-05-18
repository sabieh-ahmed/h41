<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php
	ob_start();
?>
<script>
	jQuery(document).ready(function($) {
		$.G2.actions.include({
			'report-post': {
				'success' : function(action, html, json){
					if(json == false){
						var newPost = $(html);
						action.closest('.cfu-post').replaceWith(newPost);
						//$.G2.composer.ready('post', {actions : [newPost]});
					}
				}
			},
			'quote-post': {
				'click' : function(button){
					var username = $.trim(button.closest('.cfu-content').find('.author').first().text());
					var content = $.trim(button.closest('.cfu-content').find('div.text p').first().text());
					$('.editor-box').find('textarea').val('[quote="'+username+'"]' + content + '[/quote]');
					$.G2.scrollTo($('.editor-box'));
				}
			},
			'edit-post': {
				'beforeStart' : function(button){
					if(button.closest('.cfu-content').find('textarea.editor-text').length > 0){
						return false;
					}
				},
				'success' : function(action, html, json){
					if(json == false){
						var newEditor = $(html);
						action.closest('.cfu-content').append(newEditor);
						$.G2.editor.ready(newEditor.find('textarea.editor-text').first());
						$.G2.actions.ready(newEditor);
					}
				}
			},
		});
		
		$.G2.image_browser.ready('body', '.attachment-image', '.cfu-post');
		
		//$.G2.composer.init('post', {actions : [], image_browser : ['body', '.attachment-image', '.cfu-post']});
		//$.G2.composer.ready('post', {actions : []});
	});
</script>
<?php
	$wizard_jscode = ob_get_clean();
	\GApp::document()->_('g2.image_browser');
	\GApp::document()->addHeaderTag($wizard_jscode);
?>

<div class="ui comments">
	<?php foreach($posts as $post): ?>
		<?php $this->view('views.posts.post', ['post' => $post, 'topic' => $topic['Topic']]); ?>
	<?php endforeach; ?>
	
	<?php if(\GApp::access('chronoforums', 'posts_reply', $topic['TopicAuthor']['id']) === true AND empty($topic['Topic']['locked'])): ?>
		<?php $this->view('views.editor', ['data' => $topic['Topic'], 'type' => 'new', 'url' => r_('index.php?ext=chronoforums&cont=posts&act=reply&tvout=view&t='.$topic['Topic']['id'])]); ?>
	<?php endif; ?>
</div>