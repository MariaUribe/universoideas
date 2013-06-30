<div class="articles form">
<?php echo $this->Form->create('Article'); ?>
	<fieldset>
		<legend><?php echo __('Editar Artículo'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title', array('label' => 'Título'));
		echo $this->Form->input('summary', array('label' => 'Sumario'));
		echo $this->Form->input('body', array('label' => 'Cuerpo', 'type' => 'textarea'));
		echo $this->Form->input('enabled', array('label' => 'Habilitado'));
//		echo $this->Form->input('User');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Guardar')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Article.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Article.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar Artículos'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Related Images'), array('controller' => 'related_images', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Related Image'), array('controller' => 'related_images', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Related Videos'), array('controller' => 'related_videos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Related Video'), array('controller' => 'related_videos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
