<div class="relatedImages view">
<h2><?php  echo __('Related Image'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($relatedImage['RelatedImage']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Uri'); ?></dt>
		<dd>
			<?php echo h($relatedImage['RelatedImage']['uri']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($relatedImage['RelatedImage']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($relatedImage['RelatedImage']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Uri Thumb'); ?></dt>
		<dd>
			<?php echo h($relatedImage['RelatedImage']['uri_thumb']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Width'); ?></dt>
		<dd>
			<?php echo h($relatedImage['RelatedImage']['width']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Height'); ?></dt>
		<dd>
			<?php echo h($relatedImage['RelatedImage']['height']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Width Thumb'); ?></dt>
		<dd>
			<?php echo h($relatedImage['RelatedImage']['width_thumb']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Height Thumb'); ?></dt>
		<dd>
			<?php echo h($relatedImage['RelatedImage']['height_thumb']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Article'); ?></dt>
		<dd>
			<?php echo $this->Html->link($relatedImage['Article']['title'], array('controller' => 'articles', 'action' => 'view', $relatedImage['Article']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Related Image'), array('action' => 'edit', $relatedImage['RelatedImage']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Related Image'), array('action' => 'delete', $relatedImage['RelatedImage']['id']), null, __('Are you sure you want to delete # %s?', $relatedImage['RelatedImage']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Related Images'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Related Image'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Articles'), array('controller' => 'articles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Article'), array('controller' => 'articles', 'action' => 'add')); ?> </li>
	</ul>
</div>
