<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Registro de Usuario'); ?></legend>
	<?php
		echo $this->Form->input('username', array('label' => 'Nombre de Usuario'));
		echo $this->Form->input('password', array('label' => 'Contraseña'));
		echo $this->Form->input('name', array('label' => 'Nombre'));
		echo $this->Form->input('lastname', array('label' => 'Apellido'));
		echo $this->Form->input('mail', array('label' => 'Correo'));
		echo $this->Form->input('role_id', array('type' => 'hidden', 'value' => 2));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Guardar')); ?>
</div>