<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>

<form action="<?php echo r_('index.php?ext=chronoforums&cont=tags'); ?>" method="post" name="admin_form" id="admin_form" class="ui form">
	
	<h2 class="ui header"><?php el('Tags manager'); ?></h2>
	<div class="ui">
		<a class="compact ui button blue icon labeled toolbar-button" href="<?php echo r_('index.php?ext=chronoforums&cont=tags&act=edit'); ?>">
			<i class="plus icon"></i><?php el('New'); ?>
		</a>
		<button type="button" class="compact ui button red icon labeled toolbar-button" data-url="<?php echo r_('index.php?ext=chronoforums&cont=tags&act=delete'); ?>">
			<i class="trash icon"></i><?php el('Delete'); ?>
		</button>
	</div>
	
	<div class="ui clearing divider"></div>
	
	<table class="ui selectable table">
		<thead>
			<tr>
				<th class="">
					<div class="ui select_all checkbox">
						<input type="checkbox">
						<label></label>
					</div>
				</th>
				<th class="single line"><?php echo $this->Sorter->link(rl('ID'), 'tag_id'); ?></th>
				<th class=""><?php echo $this->Sorter->link(rl('Title'), 'tag_title'); ?></th>
				<th class=""><?php el('Alias'); ?></th>
				<th class="five wide"><?php el('Description'); ?></th>
				<th class="single line"><?php echo $this->Sorter->link(rl('Published'), 'tag_published'); ?></th>
				<th class="single line"><?php echo $this->Sorter->link(rl('Public'), 'tag_public'); ?></th>
				<th class="single line"><?php el('Order'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($tags as $i => $tag): ?>
			<tr>
				<td class="collapsing">
					<div class="ui checkbox selector">
						<input type="checkbox" class="hidden" name="gcb[]" value="<?php echo $tag['Tag']['id']; ?>">
						<label></label>
					</div>
				</td>
				<td class="collapsing"><?php echo $tag['Tag']['id']; ?></td>
				<td><?php echo $this->Html->attr('href', r_('index.php?ext=chronoforums&cont=tags&act=edit'.rp('id', $tag['Tag'])))->content($tag['Tag']['title'])->tag('a'); ?></td>
				<td><?php echo $tag['Tag']['alias']; ?></td>
				<td><?php echo $tag['Tag']['description']; ?></td>
				<td>
					<?php
						echo $this->Html
						->attr('href', r_('index.php?ext=chronoforums&cont=tags&act=toggle'.rp('gcb', $tag['Tag']['id']).rp('fld', 'published').rp('val', (int)!(bool)$tag['Tag']['published'])))
						->addClass('compact ui button icon mini circular '.((int)$tag['Tag']['published'] ? 'green' : 'red'))
						->content('<i class="icon '.((int)$tag['Tag']['published'] ? 'check' : 'cancel').'"></i>')
						->tag('a');
					?>
				</td>
				<td>
					<?php
						echo $this->Html
						->attr('href', r_('index.php?ext=chronoforums&cont=tags&act=toggle'.rp('gcb', $tag['Tag']['id']).rp('fld', 'public').rp('val', (int)!(bool)$tag['Tag']['public'])))
						->addClass('compact ui button icon mini circular '.((int)$tag['Tag']['public'] ? 'green' : 'red'))
						->content('<i class="icon '.((int)$tag['Tag']['public'] ? 'check' : 'cancel').'"></i>')
						->tag('a');
					?>
				</td>
				<td><?php echo $tag['Tag']['ordering']; ?></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan="8">
				<?php echo $this->Paginator->navigation('Tag'); ?>
				<?php echo $this->Paginator->limiter('Tag'); ?>
				</th>
			</tr>
		</tfoot>
	</table>
	
</form>
