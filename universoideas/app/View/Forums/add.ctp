<div class="forums border">
<?php echo $this->Form->create('Forum'); ?>
	<fieldset>
		<legend><?php echo __('Crear Foro'); ?></legend>
	<?php
		echo $this->Form->input('Forum.title', array('label' => 'Nombre'));
//		echo $this->Form->input('Forum.enabled', array('label' => 'Habilitado'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Guardar')); ?>
</div>