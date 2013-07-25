<div class="forums border">
<?php echo $this->Form->create('Foro'); ?>
	<fieldset>
		<legend><?php echo __('Editar Foro'); ?></legend>
	<?php
		echo $this->Form->input('Forum.id');
		echo $this->Form->input('Forum.title', array('label' => 'Nombre'));
		echo $this->Form->input('Forum.aproved', array('label' => 'Aprobado'));
		echo $this->Form->input('Forum.user_id', array('label' => 'Usuario'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Guardar')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Acciones'); ?></h3>
    <ul>
        <li><?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $this->Form->value('Forum.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Forum.id'))); ?></li>
    </ul>
</div>
