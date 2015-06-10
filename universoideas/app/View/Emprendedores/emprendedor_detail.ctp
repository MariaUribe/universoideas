<?php echo $this->Form->input('Emprendedore.id', array('type' => 'hidden', 'value' => $emprendedores['Emprendedore']['id'])); ?> 
<?php 
    $date = $this->Time->format('D-F-j-Y-h:i A', $emprendedores['Emprendedore']['modified']);
    list($dia_sem, $mes, $dia, $ano, $hora) = explode('-', $date);
?>
<h1><?php echo $emprendedores['Emprendedore']['title']; ?></h1>

<hr>

<p><span class="glyphicon glyphicon-time"></span> Publicado el <?php echo __($dia_sem) . ", " . __($dia) . " de " . __($mes) . " de " . __($ano) .  " " . $hora ?></p>
<p><span class="glyphicon glyphicon-user"></span> Creado por: <?php echo $emprendedores['User']['username'] ?></p>

<hr>

<!-- Post Content -->
<?php $no_tags_sum = strip_tags($emprendedores['Emprendedore']['resume']); ?>
<p class="lead"><?php echo $no_tags_sum ?></p>
<?php echo $emprendedores['Emprendedore']['description']?>

<hr>

<div class="fs11" style="color: #00355a; margin-top: 20px; font-weight: bold;">
    <?php 
        echo "<a href='/pages/mis_emprendimientos'>Ir a Mis Emprendimientos</a>";
    ?>
</div>
