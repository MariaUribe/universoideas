<div class="forums view">
    <?php echo $this->Form->input('Forum.id', array('type' => 'hidden', 'value' => $forum['Forum']['id'])); ?> 
    <?php
        $date = $this->Time->format('D-F-j-Y-h:i A', $forum['Forum']['modified']);
        list($dia_sem, $mes, $dia, $ano, $hora) = explode('-', $date);

        echo "<div class='box'>";
        echo "<h3>" . $forum['Forum']['title'] . "</h3>";
        echo "<div class='fs11'> Creado por: " . $forum['User']['username'] . " » " . __($dia_sem) . " " . __($mes) . " " . __($dia) . ", " . __($ano) .  " " . $hora . "</div>"; 
        echo "</div>";

        echo "<div class='fs12'>";
        echo $forum['Forum']['content']; 
        echo "</div>";
    ?>
</div>

<div class="related mt50">
    <h3 class="fs13"><?php echo __('Comentarios'); ?></h3>
    <table cellpadding = "0" cellspacing = "0" class="fs12" style="width: 100%">
    <?php if (!empty($forum['Comment'])): ?>
    <?php
        $cont = 0;

        foreach ($comments as $comment) { 
            $comment_date = $this->Time->format('D-F-j-Y-h:i A', $comment['Comment']['modified']);
            list($dia_sem_com, $mes_com, $dia_com, $ano_com, $hora_com) = explode('-', $comment_date);

            if (($cont % 2) == 0)
                echo "<tr class='bgbebe'>";
            if (($cont % 2) == 1)
                echo "<tr>";

            echo "<td style='border-top: #333 1px solid;padding: 10px;'>";
            echo $comment['Comment']['description'] . "<br><br>";
            echo "<div class='fs11'>"; 
            echo "Comentario por: <strong>" . $comment['usr']['username'] . "</strong> » " . __($dia_sem_com) . " " . __($mes_com) . " " . __($dia_com) . ", " . __($ano_com) .  " " . $hora_com; 
            echo "</div>";
            echo "</td>";
            echo "</tr>";
            $cont ++;
        } 
    ?>
    <?php else: ?>
        <?php
            echo "<tr class='bgbebe'>";
            echo "<td style='border-top: #333 1px solid;padding: 10px;'>";
            echo "No existen comentarios para este tema.";
            echo "</td>";
            echo "</tr>";
        ?>
    <?php endif; ?>
    </table>
</div>
<div class="boton fs11 mt20">
    <?php echo $this->Html->link(__('Responder'), array('controller' => 'comments', 'action' => 'add?forum_id='.$forum['Forum']['id'])); ?>

</div>
<div class="fs11" style="color: #00355a; margin-top: 20px; font-weight: bold;">
    <?php 
        echo "<a href='/pages/list_all'>Ir a Mis Temas</a>";
    ?>
</div>
