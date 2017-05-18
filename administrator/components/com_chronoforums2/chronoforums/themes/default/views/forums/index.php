<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>

<form action="<?php echo r_('index.php?ext=chronoforums&cont=forums'); ?>" method="post" name="admin_form" id="admin_form" class="ui form">
	
	<h2 class="ui header"><?php el('Forums manager'); ?></h2>
	<div class="ui">
		<a class="compact ui button blue icon labeled toolbar-button" href="<?php echo r_('index.php?ext=chronoforums&cont=forums&act=edit'); ?>">
			<i class="plus icon"></i><?php el('New'); ?>
		</a>
		<button type="button" class="compact ui button red icon labeled toolbar-button" data-url="<?php echo r_('index.php?ext=chronoforums&cont=forums&act=delete'); ?>">
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
				<th class="single line"><?php echo $this->Sorter->link(rl('ID'), 'forum_id'); ?></th>
				<th class=""><?php echo $this->Sorter->link(rl('Title'), 'forum_title'); ?></th>
				<th class=""><?php el('Parent'); ?></th>
				<th class="single line"><?php el('Topics'); ?></th>
				<th class="single line"><?php el('Posts'); ?></th>
				<th class="single line"><?php el('Type'); ?></th>
				<th class="five wide"><?php el('Description'); ?></th>
				<th class="single line"><?php echo $this->Sorter->link(rl('Published'), 'forum_published'); ?></th>
				<th class="single line"><?php el('Order'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($forums as $i => $forum): ?>
			<tr>
				<td class="collapsing">
					<div class="ui checkbox selector">
						<input type="checkbox" class="hidden" name="gcb[]" value="<?php echo $forum['Forum']['id']; ?>">
						<label></label>
					</div>
				</td>
				<td class="collapsing"><?php echo $forum['Forum']['id']; ?></td>
				<td><?php echo $this->Html->attr('href', r_('index.php?ext=chronoforums&cont=forums&act=edit'.rp('id', $forum['Forum'])))->content($forum['Forum']['title'])->tag('a'); ?></td>
				<td>
					<?php
						if(!empty($parents[$forum['Forum']['parent_id']])){
							echo $this->Html->attr('href', r_('index.php?ext=chronoforums&cont=forums&act=edit'.rp('id', $forum['Forum']['parent_id'])))->content($parents[$forum['Forum']['parent_id']])->tag('a');
						}else{
							echo '-';
						}
					?>
				</td>
				<td>
					<span id="topic-count-<?php echo $forum['Forum']['id']; ?>"><?php echo $forum['Forum']['topic_count']; ?></span>
					<div class="ui button icon very compact circular G2-dynamic" data-result="text:#topic-count-<?php echo $forum['Forum']['id']; ?>" data-url="<?php echo r_('index.php?ext=chronoforums&cont=forums&act=counter_update&type=topics&tvout=view'.rp('f', $forum['Forum']['id'])); ?>" data-hint="<?php el('Refresh counter'); ?>">
						<i class="refresh icon"></i>
					</div>
				</td>
				<td>
					<span id="post-count-<?php echo $forum['Forum']['id']; ?>"><?php echo $forum['Forum']['post_count']; ?></span>
					<div class="ui button icon very compact circular G2-dynamic" data-result="text:#post-count-<?php echo $forum['Forum']['id']; ?>" data-url="<?php echo r_('index.php?ext=chronoforums&cont=forums&act=counter_update&type=posts&tvout=view'.rp('f', $forum['Forum']['id'])); ?>" data-hint="<?php el('Refresh counter'); ?>">
						<i class="refresh icon"></i>
					</div>
				</td>
				<td><?php echo $forum['Forum']['type']; ?></td>
				<td><?php echo $forum['Forum']['description']; ?></td>
				<td>
					<?php
						echo $this->Html
						->attr('href', r_('index.php?ext=chronoforums&cont=tags&act=toggle'.rp('gcb', $forum['Forum']['id']).rp('fld', 'published').rp('val', (int)!(bool)$forum['Forum']['published'])))
						->addClass('compact ui button icon mini circular '.((int)$forum['Forum']['published'] ? 'green' : 'red'))
						->content('<i class="icon '.((int)$forum['Forum']['published'] ? 'check' : 'cancel').'"></i>')
						->tag('a');
					?>
				</td>
				<td><?php echo $forum['Forum']['ordering']; ?></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan="10">
				<?php echo $this->Paginator->navigation('Forum'); ?>
				<?php echo $this->Paginator->limiter('Forum'); ?>
				</th>
			</tr>
		</tfoot>
	</table>
	
</form>
