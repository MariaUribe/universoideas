<div class="customTexts border">
<?php echo $this->Form->create('CustomText'); ?>
    <fieldset>
        <legend><?php echo __('Editar Texto Custom'); ?></legend>
	<?php
            echo $this->Form->input('CustomText.id');
            echo $this->Form->input('CustomText.section', array('label' => 'Sección', 'maxlength' => '100', 'disabled' => 'true'));
            echo $this->Form->input('CustomText.body', array('label' => 'Cuerpo', 'maxlength' => '5500', 'type' => 'textarea', 'rows' => '10', 'class' => 'ckeditor'));
        ?>
    </fieldset>
<?php echo $this->Form->end(__('Guardar')); ?>
</div>