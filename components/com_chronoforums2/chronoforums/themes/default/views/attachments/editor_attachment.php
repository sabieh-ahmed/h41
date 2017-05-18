<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<div class="item cfu-attachment">
	<i class="icon file big"></i>
	<div class="content">
		<a class="header"><?php echo $file['filename']; ?></a>
		<div class="extra">
			<div class="ui button red icon big circular very compact G2-dynamic" data-id="delete-attachment" data-url="<?php echo r_('index.php?ext=chronoforums&cont=attachments&act=delete&tvout=view&id='.$file['id'].'&vfilename='.$file['vfilename']); ?>">
				<i class="trash icon"></i>
			</div>
			<div class="ui button blue icon big circular very compact G2-static editor-button" data-id="insert-attachment" data-start="[attachment=<?php echo $file['vfilename']; ?>]" data-end="[/attachment]">
				<i class="attach icon"></i>
			</div>
			<div class="ui button yellow icon big circular very compact G2-static" data-task="popup">
				<i class="write icon"></i>
			</div>
			<div class="ui fluid popup top left transition hidden G2-static-popup" id="comment-attachment-<?php echo $file['id']; ?>">
				<div class="ui form">
					<div class="field">
						<label><?php el('Attachment description'); ?></label>
						<textarea placeholder="<?php el('Attachment description'); ?>" name="Attachment[comment][]" rows="2"><?php echo $file['comment']; ?></textarea>
					</div>
					<div class="field">
						<div class="ui button green icon big circular very compact G2-static" data-task="hide/closest:.popup"><i class="check mark icon"></i></div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
	<input type="hidden" name="Attachment[filename][]" value="<?php echo $file['filename']; ?>">
	<input type="hidden" name="Attachment[vfilename][]" value="<?php echo $file['vfilename']; ?>">
	<input type="hidden" name="Attachment[size][]" value="<?php echo $file['size']; ?>">
	<input type="hidden" name="Attachment[id][]" value="<?php echo $file['id']; ?>">
</div>