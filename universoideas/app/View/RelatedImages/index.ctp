<div class="relatedImages index">
	<h2><?php echo __('Related Images'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('uri'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('uri_thumb'); ?></th>
			<th><?php echo $this->Paginator->sort('width'); ?></th>
			<th><?php echo $this->Paginator->sort('height'); ?></th>
			<th><?php echo $this->Paginator->sort('width_thumb'); ?></th>
			<th><?php echo $this->Paginator->sort('height_thumb'); ?></th>
			<th><?php echo $this->Paginator->sort('article_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($relatedImages as $relatedImage): ?>
	<tr>
		<td><?php echo h($relatedImage['RelatedImage']['id']); ?>&nbsp;</td>
		<td><?php echo h($relatedImage['RelatedImage']['uri']); ?>&nbsp;</td>
		<td><?php echo h($relatedImage['RelatedImage']['name']); ?>&nbsp;</td>
		<td><?php echo h($relatedImage['RelatedImage']['title']); ?>&nbsp;</td>
		<td><?php echo h($relatedImage['RelatedImage']['uri_thumb']); ?>&nbsp;</td>
		<td><?php echo h($relatedImage['RelatedImage']['width']); ?>&nbsp;</td>
		<td><?php echo h($relatedImage['RelatedImage']['height']); ?>&nbsp;</td>
		<td><?php echo h($relatedImage['RelatedImage']['width_thumb']); ?>&nbsp;</td>
		<td><?php echo h($relatedImage['RelatedImage']['height_thumb']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($relatedImage['Article']['title'], array('controller' => 'articles', 'action' => 'view', $relatedImage['Article']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $relatedImage['RelatedImage']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $relatedImage['RelatedImage']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $relatedImage['RelatedImage']['id']), null, __('Are you sure you want to delete # %s?', $relatedImage['RelatedImage']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Related Image'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Articles'), array('controller' => 'articles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Article'), array('controller' => 'articles', 'action' => 'add')); ?> </li>
	</ul>
</div>
