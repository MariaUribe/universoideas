<div class="forums border">
<?php echo $this->Form->create('Forum'); ?>
	<fieldset>
		<legend><?php echo __('Editar Tema'); ?></legend>
	<?php
		echo $this->Form->input('Forum.id');
		echo $this->Form->input('Forum.title', array('label' => 'Asunto'));
                echo $this->Form->input('Forum.content', array('label' => 'Descripción', 'type' => 'textarea', 'cols' => 58, 'rows' => 12, 'maxlength' => 1500, 'class' => 'ckeditor'));
		echo $this->Form->input('Forum.enabled', array('label' => 'Habilitado'));
		echo $this->Form->input('Forum.user_id', array('label' => 'Usuario', 'type' => 'hidden'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Guardar')); ?>
</div>
<!--<div class="actions">
    <h3><php echo __('Acciones'); ?></h3>
    <ul>
        <li><php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $this->Form->value('Forum.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Forum.id'))); ?></li>
    </ul>
</div>-->
