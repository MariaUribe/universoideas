<div class="comments index">
    <?php echo $this->Form->input('Forum.id', array('type' => 'hidden', 'value' => $comments['0']['Forum']['id'])); ?> 
    <h2><?php echo __('Commentarios del Tema: '); ?></h2>
    <h3><?php echo __($comments['0']['Forum']['title']); ?></h3>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th style="width: 550px"><?php echo $this->Paginator->sort('description', 'Comentario'); ?></th>
            <th><?php echo $this->Paginator->sort('user_id', 'Usuario'); ?></th>
            <th><?php echo $this->Paginator->sort('created', 'Creado'); ?></th>
            <th><?php echo $this->Paginator->sort('modified', 'Modificado'); ?></th>
            <th class="actions tac"><?php echo __('Acciones'); ?></th>
        </tr>
        <?php foreach ($comments as $comment): ?>
        <?php 
            $date_created = $this->Time->format('D-F-j-Y-h:i A', $comment['Comment']['created']);
            list($dia_sem_crea, $mes_crea, $dia_crea, $ano_crea, $hora_crea) = explode('-', $date_created);
            
            $date_modified = $this->Time->format('D-F-j-Y-h:i A', $comment['Comment']['modified']);
            list($dia_sem_mod, $mes_mod, $dia_mod, $ano_mod, $hora_mod) = explode('-', $date_modified);
        ?>
        <tr>
            <?php echo $this->Form->input('Comment.id', array('type' => 'hidden', 'value' => $comment['Comment']['id'])); ?> 
                <td><?php echo h($comment['Comment']['description']); ?>&nbsp;</td>
                <td>
                    <?php echo $this->Html->link($comment['User']['username'], array('controller' => 'users', 'action' => 'view', $comment['User']['id'])); ?>
                </td>
                <td>
                    <?php echo __($dia_sem_crea) . " " . __($mes_crea) . " " . __($dia_crea) . ", " . __($ano_crea) .  " " . $hora_crea ?>&nbsp;
                </td>
                <td>
                    <?php echo __($dia_sem_mod) . " " . __($mes_mod) . " " . __($dia_mod) . ", " . __($ano_mod) .  " " . $hora_mod ?>&nbsp;
                </td>
            
                <td class="actions tac">
                    <?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $comment['Comment']['id'])); ?>
                    <?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $comment['Comment']['id']), null, __('Are you sure you want to delete # %s?', $comment['Comment']['id'])); ?>
                </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <p>
    <?php
    echo $this->Paginator->counter(array(
    'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total.')
    ));
    ?>	</p>
    <div class="paging">
    <?php
        echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => ''));
        echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
    ?>
    </div>
</div>