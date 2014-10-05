<div class="comments border">
<?php echo $this->Form->create('Comment'); ?>
    <fieldset>
        <legend><?php echo __('Editar Comentario'); ?></legend>
        <h3><?php echo $comment['Forum']['title']; ?></h3>

        <?php   
            echo $this->Form->input('Comment.id');
            echo $this->Form->input('Comment.forum_id', array('type' => 'hidden'));
            echo $this->Form->input('Comment.user_id', array('type' => 'hidden'));
            echo $this->Form->input('Comment.description', array('label' => 'Descripción', 'type', 'textarea', 'cols' => 58, 'rows' => 12, 'maxlength' => 1500, 'class' => 'jqte-editor'));
        ?>
    </fieldset>
<?php echo $this->Form->end(__('Guardar')); ?>
</div>