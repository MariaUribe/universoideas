<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Mi Perfil'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('username', array('label' => 'Nombre de usuario'));
		echo $this->Form->input('password', array('label' => 'Contraseña'));
		echo $this->Form->input('name', array('label' => 'Nombre'));
		echo $this->Form->input('lastname', array('label' => 'Apellido'));
		echo $this->Form->input('mail', array('label' => 'Correo'));
		echo $this->Form->input('role_id', array('type' => 'hidden'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Guardar')); ?>
</div>

<span><a href="/universoideas/forums/add">Crear Foro</a></span>
<span><a href="/universoideas/forums/list_all">Ver Mis Foros</a></span>