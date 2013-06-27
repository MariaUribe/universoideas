<div class="forums form">
<?php echo $this->Form->create('Forum'); ?>
	<fieldset>
		<legend><?php echo __('Edit Forum'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('aproved');
		echo $this->Form->input('user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Forum.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Forum.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Forums'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Comments'), array('controller' => 'comments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Comment'), array('controller' => 'comments', 'action' => 'add')); ?> </li>
	</ul>
</div>
