<div class="articles index">
    <h2><?php echo __('Artículos'); ?></h2>
    <table cellpadding="0" cellspacing="0">
	<tr>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('channel', 'Canal'); ?></th>
            <th class="w200"><?php echo $this->Paginator->sort('title', 'Título'); ?></th>
            <th class="w380"><?php echo $this->Paginator->sort('summary', 'Sumario'); ?></th>
            <th><?php echo $this->Paginator->sort('enabled', 'Habilitado'); ?></th>
            <th><?php echo $this->Paginator->sort('highlight', 'Destacada'); ?></th>
            <th class="w130"><?php echo $this->Paginator->sort('created', 'Creado'); ?></th>
            <th class="w130"><?php echo $this->Paginator->sort('modified', 'Modificado'); ?></th>
            <th class="actions tac"><?php echo __('Acciones'); ?></th>
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
        <?php 
            $date_created = $this->Time->format('D-F-j-Y-h:i A', $article['Article']['created']);
            list($dia_sem_crea, $mes_crea, $dia_crea, $ano_crea, $hora_crea) = explode('-', $date_created);
            
            $date_modified = $this->Time->format('D-F-j-Y-h:i A', $article['Article']['modified']);
            list($dia_sem_mod, $mes_mod, $dia_mod, $ano_mod, $hora_mod) = explode('-', $date_modified);
        ?>
	<tr>
            <td><?php echo h($article['Article']['id']); ?>&nbsp;</td>
            <td><?php echo $new_channel; ?>&nbsp;</td>
            <td><?php echo h($article['Article']['title']); ?>&nbsp;</td>
            <td><?php echo h($article['Article']['summary']); ?>&nbsp;</td>
            <td class="tac"><?php echo h(($article['Article']['enabled']==1?"SI":"NO")); ?>&nbsp;</td>
            <td class="tac"><?php echo h(($article['Article']['highlight']==1?"SI":"NO")); ?>&nbsp;</td>
            <td><?php echo __($dia_sem_crea) . " " . __($mes_crea) . " " . __($dia_crea) . ", " . __($ano_crea) .  " " . $hora_crea ?>&nbsp;</td>
            <td><?php echo __($dia_sem_mod) . " " . __($mes_mod) . " " . __($dia_mod) . ", " . __($ano_mod) .  " " . $hora_mod ?>&nbsp;</td>
            <td class="actions tac">
                <?php echo '<a href="/pages/article?id=' . $article['Article']['id'] . '">Ver</a>'; ?>
                <?php echo '<a href="/articles/edit/' . $article['Article']['id'] . '">Editar</a>'; ?>
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