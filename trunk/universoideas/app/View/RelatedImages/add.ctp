<div class="relatedImages form">
<?php echo $this->Form->create('RelatedImage'); ?>
	<fieldset>
		<legend><?php echo __('Add Related Image'); ?></legend>
	<?php
		echo $this->Form->input('uri');
		echo $this->Form->input('name');
		echo $this->Form->input('title');
		echo $this->Form->input('uri_thumb');
		echo $this->Form->input('width');
		echo $this->Form->input('height');
		echo $this->Form->input('width_thumb');
		echo $this->Form->input('height_thumb');
		echo $this->Form->input('article_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Related Images'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Articles'), array('controller' => 'articles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Article'), array('controller' => 'articles', 'action' => 'add')); ?> </li>
	</ul>
</div>
