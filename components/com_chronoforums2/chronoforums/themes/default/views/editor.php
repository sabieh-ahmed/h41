<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php
	\GApp::document()->_('g2.editor');
	ob_start();
?>
<script>
	jQuery(document).ready(function($) {
		$.G2.editor.ready($('textarea.editor-text').first());
	});
</script>
<?php
	$wizard_jscode = ob_get_clean();
	\GApp::document()->addHeaderTag($wizard_jscode);
?>
<div class="editor-box">
	
	<div class="ui segment very slim top attached buttons-bar">
		<div class="ui button very compact icon editor-button" title="<?php el('Bold text'); ?>: [b]text[/b]" data-start="[b]" data-end="[/b]"><i class="bold icon large"></i></div>
		<div class="ui button very compact icon editor-button" title="<?php el('Italic text'); ?>: [i]text[/i]" data-start="[i]" data-end="[/i]"><i class="italic icon large"></i></div>
		<div class="ui button very compact icon editor-button" title="<?php el('Underlined text'); ?>: [u]text[/u]" data-start="[u]" data-end="[/u]"><i class="underline icon large"></i></div>
		<div class="ui button very compact icon editor-button" title="<?php el('Quoted text'); ?>: [quote]text[/quote]" data-start="[quote]" data-end="[/quote]"><i class="quote left icon large"></i></div>
		<div class="ui button very compact icon editor-button" title="<?php el('Code'); ?>: [code]code[/code]" data-start="[code]" data-end="[/code]"><i class="code icon large"></i></div>
		
		<div class="ui button very compact icon top right pointing dropdown">
			<i class="unordered list icon large"></i>
			<div class="menu">
			<a class="item editor-button" title="[list]text[/list]" data-start="[list]" data-end="[/list]"><i class="unordered list icon"></i></a>
			<a class="item editor-button" title="[list=]text[/list]" data-start="[list=]" data-end="[/list]"><i class="ordered list icon"></i></a>
			<a class="item editor-button" title="[*]text[/*]" data-start="[*]" data-end="[/*]"><i class="circle icon"></i></a>
			</div>
		</div>
		
		<div class="ui button very compact icon top right pointing dropdown">
			<i class="font icon large"></i>
			<div class="menu">
			<a class="item editor-button" title="[size=70]text[/size]" data-start="[size=70]" data-end="[/size]" style="font-size:0.7rem !important;">ABCDEF</a>
			<a class="item editor-button" title="[size=100]text[/size]" data-start="[size=100]" data-end="[/size]" style="font-size:1rem !important;">ABCDEF</a>
			<a class="item editor-button" title="[size=150]text[/size]" data-start="[size=150]" data-end="[/size]" style="font-size:1.5rem !important;">ABCDEF</a>
			</div>
		</div>
		
		<div class="ui button very compact icon top right pointing dropdown">
			<i class="ui orange icon circle large"></i>
			<div class="menu">
				<div class="item">
					<a class="ui red empty circular label big editor-button" data-start="[color=#db2828]" data-end="[/color]"></a>
					<a class="ui orange empty circular label big editor-button" data-start="[color=#f2711c]" data-end="[/color]"></a>
					<a class="ui yellow empty circular label big editor-button" data-start="[color=#fbbd08]" data-end="[/color]"></a>
					<a class="ui olive empty circular label big editor-button" data-start="[color=#b5cc18]" data-end="[/color]"></a>
					<a class="ui green empty circular label big editor-button" data-start="[color=#21ba45]" data-end="[/color]"></a>
				</div>
				<div class="item">
					<a class="ui teal empty circular label big editor-button" data-start="[color=#00b5ad]" data-end="[/color]"></a>
					<a class="ui blue empty circular label big editor-button" data-start="[color=#2185d0]" data-end="[/color]"></a>
					<a class="ui violet empty circular label big editor-button" data-start="[color=#6435c9]" data-end="[/color]"></a>
					<a class="ui purple empty circular label big editor-button" data-start="[color=#a333c8]" data-end="[/color]"></a>
					<a class="ui pink empty circular label big editor-button" data-start="[color=#e03997]" data-end="[/color]"></a>
				</div>
				<div class="item">
					<a class="ui brown empty circular label big editor-button" data-start="[color=#a5673f]" data-end="[/color]"></a>
					<a class="ui grey empty circular label big editor-button" data-start="[color=#767676]" data-end="[/color]"></a>
					<a class="ui black empty circular label big editor-button" data-start="[color=#1b1c1d]" data-end="[/color]"></a>
				</div>
			</div>
		</div>
		
		<?php if((bool)$this->get('fparams')->get('enable_smilies', 1) === true): ?>
		<?php $emodir = \G2\Globals::ext_url('chronoforums', 'front').'smilies'.DS.'default'.DS;; ?>
		<div class="ui button very compact icon top right pointing dropdown">
			<i class="ui smile icon large"></i>
			<div class="menu" style="min-width:230px;">
				<div class="item">
					<div class="ui image editor-button" data-start="" data-end=" :oops:"><img width="15" height="15" title="Embarrassed" alt="oops" src="<?php echo $emodir; ?>icon_redface.gif"></div>
					<div class="ui image editor-button" data-start="" data-end=" :D"><img width="15" height="15" title="Very Happy" alt=":D" src="<?php echo $emodir; ?>icon_biggrin.gif"></div>
					<div class="ui image editor-button" data-start="" data-end=" :)"><img width="15" height="15" title="Smile" alt=":)" src="<?php echo $emodir; ?>icon_smile.gif"></div>
					<div class="ui image editor-button" data-start="" data-end=" ;)"><img width="15" height="15" title="Wink" alt=";)" src="<?php echo $emodir; ?>icon_wink.gif"></div>
					<div class="ui image editor-button" data-start="" data-end=" :("><img width="15" height="15" title="Sad" alt=":(" src="<?php echo $emodir; ?>icon_sad.gif"></div>
					<div class="ui image editor-button" data-start="" data-end=" :o"><img width="15" height="15" title="Surprised" alt=":o" src="<?php echo $emodir; ?>icon_surprised.gif"></div>
					<div class="ui image editor-button" data-start="" data-end=" :shock:"><img width="15" height="15" title="Shocked" alt=":shock:" src="<?php echo $emodir; ?>icon_eek.gif"></div>
				</div>
				<div class="item">
					<div class="ui image editor-button" data-start="" data-end=" :?"><img width="15" height="15" title="Confused" alt=":?" src="<?php echo $emodir; ?>icon_confused.gif"></div>
					<div class="ui image editor-button" data-start="" data-end=" 8-)"><img width="15" height="15" title="Cool" alt="8-)" src="<?php echo $emodir; ?>icon_cool.gif"></div>
					<div class="ui image editor-button" data-start="" data-end=" :lol:"><img width="15" height="15" title="Laughing" alt=":lol:" src="<?php echo $emodir; ?>icon_lol.gif"></div>
					<div class="ui image editor-button" data-start="" data-end=" :x"><img width="15" height="15" title="Mad" alt=":x" src="<?php echo $emodir; ?>icon_mad.gif"></div>
					<div class="ui image editor-button" data-start="" data-end=" :P"><img width="15" height="15" title="Razz" alt=":P" src="<?php echo $emodir; ?>icon_razz.gif"></div>
					<div class="ui image editor-button" data-start="" data-end=" :cry:"><img width="15" height="15" title="Crying or Very Sad" alt=":cry:" src="<?php echo $emodir; ?>icon_cry.gif"></div>
					<div class="ui image editor-button" data-start="" data-end=" :evil:"><img width="15" height="15" title="Evil or Very Mad" alt=":evil:" src="<?php echo $emodir; ?>icon_evil.gif"></div>
				</div>
				<div class="item">
					<div class="ui image editor-button" data-start="" data-end=" :twisted:"><img width="15" height="15" title="Twisted Evil" alt=":twisted:" src="<?php echo $emodir; ?>icon_twisted.gif"></div>
					<div class="ui image editor-button" data-start="" data-end=" :roll:"><img width="15" height="15" title="Rolling Eyes" alt=":roll:" src="<?php echo $emodir; ?>icon_rolleyes.gif"></div>
					<div class="ui image editor-button" data-start="" data-end=" :!:"><img width="15" height="15" title="Exclamation" alt=":!:" src="<?php echo $emodir; ?>icon_exclaim.gif"></div>
					<div class="ui image editor-button" data-start="" data-end=" :?:"><img width="15" height="15" title="Question" alt=":?:" src="<?php echo $emodir; ?>icon_question.gif"></div>
					<div class="ui image editor-button" data-start="" data-end=" :idea:"><img width="15" height="15" title="Idea" alt=":idea:" src="<?php echo $emodir; ?>icon_idea.gif"></div>
					<div class="ui image editor-button" data-start="" data-end=" :arrow:"><img width="15" height="15" title="Arrow" alt=":arrow:" src="<?php echo $emodir; ?>icon_arrow.gif"></div>
					<div class="ui image editor-button" data-start="" data-end=" :|"><img width="15" height="15" title="Neutral" alt=":|" src="<?php echo $emodir; ?>icon_neutral.gif"></div>
				</div>
				<div class="item">
					<div class="ui image editor-button" data-start="" data-end=" :mrgreen:"><img width="15" height="15" title="Mr. Green" alt=":mrgreen:" src="<?php echo $emodir; ?>icon_mrgreen.gif"></div>
					<div class="ui image editor-button" data-start="" data-end=" :geek:"><img width="17" height="17" title="Geek" alt=":geek:" src="<?php echo $emodir; ?>icon_e_geek.gif"></div>
					<div class="ui image editor-button" data-start="" data-end=" :ugeek:"><img width="17" height="18" title="Uber Geek" alt=":ugeek:" src="<?php echo $emodir; ?>icon_e_ugeek.gif"></div>
				</div>
			</div>
		</div>
		<?php endif; ?>
		
		<?php if((bool)$this->get('fparams')->get('enable_icons', 1) === true): ?>
		<div class="ui button very compact icon top right pointing dropdown">
			<i class="ui paint brush icon large"></i>
			<div class="menu">
				<div class="item">
					<i class="ui paint brush icon link editor-button" data-start="[icon]paint brush[/icon]" data-end=""></i>
					<i class="ui first aid icon link editor-button" data-start="[icon]first aid[/icon]" data-end=""></i>
					<i class="ui food icon link editor-button" data-start="[icon]food[/icon]" data-end=""></i>
					<i class="ui hotel icon link editor-button" data-start="[icon]hotel[/icon]" data-end=""></i>
					<i class="ui car icon link editor-button" data-start="[icon]car[/icon]" data-end=""></i>
					<i class="ui coffee icon link editor-button" data-start="[icon]coffee[/icon]" data-end=""></i>
					<i class="ui tv icon link editor-button" data-start="[icon]tv[/icon]" data-end=""></i>
					<i class="ui university icon link editor-button" data-start="[icon]university[/icon]" data-end=""></i>
				</div>
				<div class="item">
					<i class="ui quote left icon link editor-button" data-start="[icon]quote left[/icon]" data-end=""></i>
					<i class="ui gift icon link editor-button" data-start="[icon]gift[/icon]" data-end=""></i>
					<i class="ui diamond icon link editor-button" data-start="[icon]diamond[/icon]" data-end=""></i>
					<i class="ui star icon link editor-button" data-start="[icon]star[/icon]" data-end=""></i>
					<i class="ui heart icon link editor-button" data-start="[icon]heart[/icon]" data-end=""></i>
					<i class="ui paw icon link editor-button" data-start="[icon]paw[/icon]" data-end=""></i>
					<i class="ui thumbs up icon link editor-button" data-start="[icon]thumbs up[/icon]" data-end=""></i>
					<i class="ui thumbs down icon link editor-button" data-start="[icon]thumbs down[/icon]" data-end=""></i>
				</div>
				<div class="item">
					<i class="ui file icon link editor-button" data-start="[icon]file[/icon]" data-end=""></i>
					<i class="ui laptop icon link editor-button" data-start="[icon]laptop[/icon]" data-end=""></i>
					<i class="ui game icon link editor-button" data-start="[icon]game[/icon]" data-end=""></i>
					<i class="ui mobile icon link editor-button" data-start="[icon]mobile[/icon]" data-end=""></i>
					<i class="ui photo icon link editor-button" data-start="[icon]photo[/icon]" data-end=""></i>
					<i class="ui checkmark icon link editor-button" data-start="[icon]checkmark[/icon]" data-end=""></i>
					<i class="ui remove icon link editor-button" data-start="[icon]remove[/icon]" data-end=""></i>
				</div>
				<div class="item">
					<i class="ui tree icon link editor-button" data-start="[icon]tree[/icon]" data-end=""></i>
					<i class="ui mute icon link editor-button" data-start="[icon]mute[/icon]" data-end=""></i>
					<i class="ui music icon link editor-button" data-start="[icon]music[/icon]" data-end=""></i>
					<i class="ui flag icon link editor-button" data-start="[icon]flag[/icon]" data-end=""></i>
					<i class="ui help icon link editor-button" data-start="[icon]help[/icon]" data-end=""></i>
					<i class="ui warning icon link editor-button" data-start="[icon]warning[/icon]" data-end=""></i>
					<i class="ui birthday icon link editor-button" data-start="[icon]birthday[/icon]" data-end=""></i>
				</div>
				<div class="item">
					<i class="ui trophy icon link editor-button" data-start="[icon]trophy[/icon]" data-end=""></i>
					<i class="ui crosshairs icon link editor-button" data-start="[icon]crosshairs[/icon]" data-end=""></i>
					<i class="ui soccer icon link editor-button" data-start="[icon]soccer[/icon]" data-end=""></i>
					<i class="ui plane icon link editor-button" data-start="[icon]plane[/icon]" data-end=""></i>
					<i class="ui moon icon link editor-button" data-start="[icon]moon[/icon]" data-end=""></i>
					<i class="ui legal icon link editor-button" data-start="[icon]legal[/icon]" data-end=""></i>
					<i class="ui dollar icon link editor-button" data-start="[icon]dollar[/icon]" data-end=""></i>
				</div>
				<div class="item">
					<i class="ui hand peace icon link editor-button" data-start="[icon]hand peace[/icon]" data-end=""></i>
					<i class="ui hand pointer icon link editor-button" data-start="[icon]hand pointer[/icon]" data-end=""></i>
					<i class="ui hand lizard icon link editor-button" data-start="[icon]hand lizard[/icon]" data-end=""></i>
					<i class="ui hand paper icon link editor-button" data-start="[icon]hand paper[/icon]" data-end=""></i>
					<i class="ui hand rock icon link editor-button" data-start="[icon]hand rock[/icon]" data-end=""></i>
					<i class="ui male icon link editor-button" data-start="[icon]male[/icon]" data-end=""></i>
					<i class="ui female icon link editor-button" data-start="[icon]female[/icon]" data-end=""></i>
				</div>
			</div>
		</div>
		<?php endif; ?>
		
		<?php if(!isset($buttons['attachments']) OR $buttons['attachments'] !== false): ?>
		<div class="ui button very compact icon G2-static" data-task="popup" data-id="editor-button"><i class="icon large attach"></i></div>
		<div class="ui popup top right transition hidden G2-static-popup">
			<div class="ui form" id="editor-file-<?php echo $data['id']; ?>" method="post" enctype="multipart/form-data">
				<div class="field">
					<input type="file" name="attachment">
				</div>
				<div class="ui grey progress" data-percent="0">
					<div class="bar"></div>
					<div class="label"></div>
				</div>
				<div class="field">
					<a class="ui button blue icon fluid G2-dynamic" data-id="editor-attach" data-dtask="send:#editor-file-<?php echo $data['id']; ?>" data-url="<?php echo r_('index.php?ext=chronoforums&cont=attachments&act=attach&tvout=view'); ?>">
						<i class="icon large upload"></i>
					</a>
				</div>
			</div>
		</div>
		<?php endif; ?>
		
		<div class="ui button very compact icon G2-static" data-task="popup" data-id="editor-button"><i class="picture icon large"></i></div>
		<div class="ui popup top left transition hidden G2-static-popup">
			<div class="ui form" id="editor-image-<?php echo $data['id']; ?>">
				<div class="field">
					<label><?php el('Image URL'); ?></label>
					<input type="text" data-selection="1" placeholder="<?php el('Image URL'); ?>">
				</div>
				<div class="field">
					<a class="ui button compact labeled icon fluid editor-button" data-text="[img]{0}[/img]" data-include="#editor-image-<?php echo $data['id']; ?>">
						<i class="icon large write"></i>&nbsp;[img]<?php el('Image URL'); ?>[/img]
					</a>
				</div>
			</div>
		</div>
		
		
		<div class="ui button very compact icon G2-static" data-task="popup" data-id="editor-button"><i class="linkify icon large"></i></div>
		<div class="ui popup top left transition hidden G2-static-popup">
			<div class="ui form" id="editor-link-<?php echo $data['id']; ?>">
				<div class="field">
					<label><?php el('Link URL'); ?></label>
					<input type="text" data-selection="1" placeholder="<?php el('Link URL'); ?>">
				</div>
				<div class="field">
					<label><?php el('Link text'); ?></label>
					<input type="text" data-selection="1" placeholder="<?php el('Link text'); ?>">
				</div>
				<div class="field">
					<a class="ui button compact labeled icon fluid editor-button" data-text="[url={0}]{1}[/url]" data-include="#editor-link-<?php echo $data['id']; ?>">
						<i class="icon large write"></i>&nbsp;[url=<?php el('Link URL'); ?>]<?php el('Link text'); ?>[/url]
					</a>
				</div>
			</div>
		</div>
		
		
		<div class="ui button very compact icon G2-static" data-task="popup" data-id="editor-button"><i class="icon large youtube play red"></i></div>
		<div class="ui popup top left transition hidden G2-static-popup">
			<div class="ui form" id="editor-video-<?php echo $data['id']; ?>">
				<div class="field">
					<label><?php el('Video ID'); ?></label>
					<input type="text" data-selection="1" placeholder="<?php el('Video ID'); ?>">
				</div>
				<div class="field">
					<a class="ui button compact labeled icon fluid editor-button" data-text="[youtube]{0}[/youtube]" data-include="#editor-video-<?php echo $data['id']; ?>">
						<i class="icon large write"></i>&nbsp;[youtube]<?php el('Video ID'); ?>[/youtube]
					</a>
				</div>
			</div>
		</div>
		
		<div class="ui button very compact icon editor-button" title="<?php el('Private content'); ?>: [private]data[/private]" data-start="[private]" data-end="[/private]"><i class="privacy icon large"></i></div>
		
	</div>
	<div method="post" class="ui form bottom attached segment" id="editor-form-<?php echo $data['id']; ?>">
		<div class="field">
			<textarea class="editor-text ui segment top attached" name="<?php echo (!empty($name) ? $name : 'Post[text]'); ?>" rows="10"></textarea>
			
			<div class="ui segment bottom attached clearing">
				<?php if(!isset($buttons['save']) OR $buttons['save'] !== false): ?>
				<div class="ui button green icon big circular very compact G2-dynamic" data-type="<?php echo $type; ?>" data-dtask="send:#editor-form-<?php echo $data['id']; ?>" data-id="editor-save" data-url="<?php echo $url; ?>" data-hint="<?php el('Submit'); ?>">
					<i class="checkmark icon"></i>
				</div>
				<?php endif; ?>
				
				<div class="ui button yellow icon big circular very compact G2-static" data-id="editor-clear" data-hint="<?php el('Clear text'); ?>">
					<i class="erase icon"></i>
				</div>
				
				<?php if($type == 'update'): ?>
				<div class="ui button red icon big circular very compact G2-static" data-id="editor-close" data-hint="<?php el('Cancel'); ?>">
					<i class="close icon"></i>
				</div>
				<?php endif; ?>
				
			</div>
		</div>
		
		<?php if(!isset($buttons['attachments']) OR $buttons['attachments'] !== false): ?>
			<div class="ui header top attached grey inverted" style="padding:5px; margin-top:5px;"><i class="attach icon large"></i> <?php el('Attachments'); ?></div>
			<div class="ui divided items attachments segment padded bottom attached">
				<?php if(!empty($attachments)): ?>
					<?php foreach($attachments as $attachment): ?>
					<?php $this->view('views.attachments.editor_attachment', ['file' => $attachment]); ?>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
	
</div>