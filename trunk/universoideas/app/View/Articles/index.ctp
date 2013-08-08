<div class="articles index">
    <h2><?php echo __('Artículos'); ?></h2>
    <table cellpadding="0" cellspacing="0">
	<tr>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th class="w250"><?php echo $this->Paginator->sort('channel', 'Canal'); ?></th>
            <th class="w250"><?php echo $this->Paginator->sort('title', 'Título'); ?></th>
            <th class="w380"><?php echo $this->Paginator->sort('summary', 'Sumario'); ?></th>
            <th><?php echo $this->Paginator->sort('enabled', 'Habilitado'); ?></th>
            <th><?php echo $this->Paginator->sort('highlight', 'Destacada'); ?></th>
            <th><?php echo $this->Paginator->sort('created', 'Creado'); ?></th>
            <th><?php echo $this->Paginator->sort('modified', 'Modificado'); ?></th>
            <th class="actions"><?php echo __('Acciones'); ?></th>
        </tr>
                         
	<?php foreach ($articles as $article): ?>
        <?php 
            $canal = $article['Article']['channel']; 
            $new_channel = $canal;
            
            if($canal == "principal")
                $new_channel = "Principal";
            else if($canal == "encuentrame")
                $new_channel = "Encuéntrame";
            else if($canal == "rumba")
                $new_channel = "Rumba";
            else if($canal == "arte")
                $new_channel = "Arte y Cultura";
            else if($canal == "ciencia")
                $new_channel = "Ciencia y Tecnología";
            else if($canal == "sexualidad")
                $new_channel = "Sexualidad al día";
            else if($canal == "moda")
                $new_channel = "Moda";
        ?>
	<tr>
            <td><?php echo h($article['Article']['id']); ?>&nbsp;</td>
            <td><?php echo $new_channel; ?>&nbsp;</td>
            <td><?php echo h($article['Article']['title']); ?>&nbsp;</td>
            <td><?php echo h($article['Article']['summary']); ?>&nbsp;</td>
            <td class="tac"><?php echo h(($article['Article']['enabled']==1?"SI":"NO")); ?>&nbsp;</td>
            <td class="tac"><?php echo h(($article['Article']['highlight']==1?"SI":"NO")); ?>&nbsp;</td>
            <td><?php echo h($article['Article']['created']); ?>&nbsp;</td>
            <td><?php echo h($article['Article']['modified']); ?>&nbsp;</td>
            <td class="actions tal">
<!--                <php echo $this->Html->link(__('Ver'), array('action' => 'view', $article['Article']['id'])); ?>-->
                <?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $article['Article']['id'])); ?>
                <?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $article['Article']['id']), null, __('Are you sure you want to delete # %s?', $article['Article']['id'])); ?>
            </td>
	</tr>
        <?php endforeach; ?>
    </table>
    <p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Página {:page} de {:pages}, mostrando {:current} artículos de {:count} total.')
	));
	?>	
    </p>
    <div class="paging">
	<?php
            echo $this->Paginator->prev('< ' . __('anterior'), array(), null, array('class' => 'prev disabled'));
            echo $this->Paginator->numbers(array('separator' => ''));
            echo $this->Paginator->next(__('siguiente') . ' >', array(), null, array('class' => 'next disabled'));
	?>
    </div>
</div>