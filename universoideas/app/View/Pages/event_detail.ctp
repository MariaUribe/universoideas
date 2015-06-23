    <!-- Title -->
    <h1><?php echo $event['Event']['name']; ?></h1>

    <hr>

    <?php
        $date_modified = $this->Time->format('D-F-j-Y-h:i A', $event['Event']['modified']);
        list($dia_sem_mod, $mes_mod, $dia_mod, $ano_mod, $hora_mod) = explode('-', $date_modified);
        
        $date = $this->Time->format('D-F-j-Y-h:i A', $event['Event']['event_date']);
        list($dia_sem, $mes, $dia, $ano, $hora) = explode('-', $date);

        $img = $event['Event']['image'];
    ?>
    
    <div class="nav-container2">
        <ul class="social-media-list">
            <li>
                <div class="fb-share-button" data-href="http://www.universoideas.com/pages/event?id=<?php echo $event['Event']['id'] ?>" data-layout="button_count"></div>
            </li>
            <li>
                <a class="twitter-share-button" href="https://twitter.com/intent/tweet?text=<?php echo $event['Event']['name']; ?> via @universoideasc - http://www.universoideas.com/pages/article?id=<?php echo $event['Event']['id'] ?>">Tweet</a>
            </li>
            <li> 
                <div class="g-plus" data-action="share" data-annotation="bubble" data-href="http://www.universoideas.com/pages/event?id=<?php echo $event['Event']['id'] ?>"></div>
            </li>
        </ul>
    </div>
    
    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Publicado el <?php echo __($dia_sem_mod) . ", " . __($dia_mod) . " de " . __($mes_mod) . " de " . __($ano_mod) .  " " . $hora_mod ?></p>

    <hr>
   
    <?php
        if($img != "") {
            echo $this->Html->image($event['Event']['image'], array('alt' => $event['Event']['name'], 'class' => 'img-responsive', 'border' => '0'));
            echo "<hr>";
        }
    ?>

    <!-- Post Content -->
    <?php $no_tags_sum = strip_tags($event['Event']['description']); ?>
    <?php echo $no_tags_sum ?>
    <br><br>
    <?php 
        echo "<div><span class='bold-span'>Fecha del evento:</span> " . __($dia_sem) . " " . __($mes) . " " . __($dia) . ", " . __($ano) . "</div>";
        echo "<div><span class='bold-span'>Lugar:</span> " . $event['Event']['place'] . "</div>";
        echo "<div><span class='bold-span'>Hora de inicio:</span> " . $event['Event']['init_time'] . "</div>";
        echo "<div><span class='bold-span'>Hora de fin:</span> " . $event['Event']['end_time'] . "</div>";
    ?>

    <hr>
