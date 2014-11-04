<div class="customTexts border">
<?php echo $this->Form->create('CustomText'); ?>
    <fieldset>
        <legend><?php echo __('Crear Texto Custom'); ?></legend>
        <?php
            echo $this->Form->input('CustomText.section', array('label' => 'Sección', 'maxlength' => '100', 'style' => 'text-transform:uppercase'));
            echo $this->Form->input('CustomText.description', array('label' => 'Descripción', 'maxlength' => '5000', 'type' => 'textarea', 'rows' => '5'));
            echo $this->Form->input('CustomText.body', array('label' => 'Cuerpo', 'maxlength' => '16000', 'type' => 'textarea', 'rows' => '10', 'class' => 'ckeditor'));
        ?>
    </fieldset>
<?php echo $this->Form->end(__('Guardar')); ?>
</div>
