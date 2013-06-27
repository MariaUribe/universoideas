<div class="relatedVideos view">
<h2><?php  echo __('Related Video'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($relatedVideo['RelatedVideo']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($relatedVideo['RelatedVideo']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Source'); ?></dt>
		<dd>
			<?php echo h($relatedVideo['RelatedVideo']['source']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Article'); ?></dt>
		<dd>
			<?php echo $this->Html->link($relatedVideo['Article']['title'], array('controller' => 'articles', 'action' => 'view', $relatedVideo['Article']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Related Video'), array('action' => 'edit', $relatedVideo['RelatedVideo']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Related Video'), array('action' => 'delete', $relatedVideo['RelatedVideo']['id']), null, __('Are you sure you want to delete # %s?', $relatedVideo['RelatedVideo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Related Videos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Related Video'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Articles'), array('controller' => 'articles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Article'), array('controller' => 'articles', 'action' => 'add')); ?> </li>
	</ul>
</div>
