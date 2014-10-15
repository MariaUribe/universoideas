<div class="emprendedores view">
    <?php echo $this->Form->input('Emprendedore.id', array('type' => 'hidden', 'value' => $emprendedores['Emprendedore']['id'])); ?> 
    <?php
        $date = $this->Time->format('D-F-j-Y-h:i A', $emprendedores['Emprendedore']['modified']);
        list($dia_sem, $mes, $dia, $ano, $hora) = explode('-', $date);

        echo "<div class='box fs20 weight_normal'>";
        echo "<h3>" . $emprendedores['Emprendedore']['title'] . "</h3>";
        echo "<div class='fs12'> Creado por: " . $emprendedores['User']['username'] . " » " . __($dia_sem) . " " . __($mes) . " " . __($dia) . ", " . __($ano) .  " " . $hora . "</div>"; 
        echo "</div>";

        echo "<div class='fs14 taj lh20'>";
        echo $emprendedores['Emprendedore']['description']; 
        echo "</div>";
    ?>
</div>

<div class="fs11" style="color: #00355a; margin-top: 20px; font-weight: bold;">
    <?php 
        echo "<a href='/pages/mis_emprendimientos'>Ir a Mis Emprendimientos</a>";
    ?>
</div>
