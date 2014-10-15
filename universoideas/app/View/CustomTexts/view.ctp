<div class="customTexts view">
<h2><?php  echo __('Custom Text'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($customText['CustomText']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Section'); ?></dt>
		<dd>
			<?php echo h($customText['CustomText']['section']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Body'); ?></dt>
		<dd>
			<?php echo h($customText['CustomText']['body']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Custom Text'), array('action' => 'edit', $customText['CustomText']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Custom Text'), array('action' => 'delete', $customText['CustomText']['id']), null, __('Are you sure you want to delete # %s?', $customText['CustomText']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Custom Texts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Custom Text'), array('action' => 'add')); ?> </li>
	</ul>
</div>
