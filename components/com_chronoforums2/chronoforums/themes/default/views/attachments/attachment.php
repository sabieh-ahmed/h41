<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<div class="item">
	<?php
		$preview_extensions = $this->get('fparams')->get('attachments_preview_extensions', 'jpg-png-gif');
		$preview_extensions = explode('-', $preview_extensions);
		
		$file['size'] = '('.round(((int)$file['size'])/1024, 2).' KiB)';
		$file['link'] = r_('index.php?ext=chronoforums&cont=attachments&act=download&file_id='.$file['id']);
		$ext = pathinfo($file['filename'], PATHINFO_EXTENSION);
	?>
	<?php if(in_array(strtolower($ext), $preview_extensions) AND (\GApp::access('chronoforums', 'attachments_download', $post['user_id']) === true)): ?>
		<div class="ui small image attachment-image">
			<div class="ui dimmer">
				<div class="content">
					<div class="center">
						<div class="ui button basic circlular icon inverted"><i class="ui icon zoom large"></i></div>
					</div>
				</div>
			</div>
			<img class="ui image centered small" alt="<?php echo $file['filename']; ?>" src="<?php echo $file['link']; ?>">
		</div>
	<?php else: ?>
		<div class="ui image small"><i class="huge file middle aligned icon"></i></div>
	<?php endif; ?>
	
	<div class="content">
		<a class="header" href="<?php echo $file['link']; ?>">
			<i class="large download middle aligned icon"></i>
			<?php echo $file['filename']; ?>
		</a>
		<div class="description">
			<div class="metadata fluid"><?php echo $file['comment']; ?></div>
		</div>
		<div class="description">
			<div class="ui label small basic"><?php echo $file['size']; ?></div>
			<div class="ui label small basic"><?php echo $file['downloads']; ?>&nbsp;<?php el('Downloads/Views'); ?></div>
		</div>
	</div>
</div>