<div class="articles form">
<?php echo $this->Form->create('Article'); ?>
	<fieldset>
		<legend><?php echo __('Add Article'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('summary');
		echo $this->Form->input('body');
		echo $this->Form->input('enabled');
		echo $this->Form->input('User');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Articles'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Related Images'), array('controller' => 'related_images', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Related Image'), array('controller' => 'related_images', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Related Videos'), array('controller' => 'related_videos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Related Video'), array('controller' => 'related_videos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
