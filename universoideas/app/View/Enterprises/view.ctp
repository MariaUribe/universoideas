<div class="enterprises view">
<h2><?php  echo __('Enterprise'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($enterprise['Enterprise']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Enterprise'); ?></dt>
		<dd>
			<?php echo h($enterprise['Enterprise']['enterprise']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($enterprise['Enterprise']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($enterprise['Enterprise']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Duration'); ?></dt>
		<dd>
			<?php echo h($enterprise['Enterprise']['duration']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Enabled'); ?></dt>
		<dd>
			<?php echo h($enterprise['Enterprise']['enabled']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($enterprise['Enterprise']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($enterprise['Enterprise']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Enterprise'), array('action' => 'edit', $enterprise['Enterprise']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Enterprise'), array('action' => 'delete', $enterprise['Enterprise']['id']), null, __('Are you sure you want to delete # %s?', $enterprise['Enterprise']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Enterprises'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Enterprise'), array('action' => 'add')); ?> </li>
	</ul>
</div>
