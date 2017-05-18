<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<div class="ui segment inline-attachment">
	<?php
		$preview_extensions = $this->get('fparams')->get('attachments_preview_extensions', 'jpg-png-gif');
		$preview_extensions = explode('-', $preview_extensions);
		
		$file['size'] = '('.round(((int)$file['size'])/1024, 2).' KiB)';
		$file['link'] = r_('index.php?ext=chronoforums&cont=attachments&act=download&file_id='.$file['id']);
		$ext = pathinfo($file['filename'], PATHINFO_EXTENSION);
	?>
	<?php if(in_array(strtolower($ext), $preview_extensions) AND (\GApp::access('chronoforums', 'attachments_download', $post['user_id']) === true)): ?>
		<img class="ui image bordered attachment" alt="<?php echo $file['filename']; ?>" src="<?php echo $file['link']; ?>">
	<?php else: ?>
		<i class="icon file big"></i>
	<?php endif; ?>
	<a class="header" href="<?php echo $file['link']; ?>"><?php echo $file['filename']; ?></a>
</div>