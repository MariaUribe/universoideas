<?php foreach ($article as $art) { ?>
    <!-- Title -->
    <h1><?php echo $art['art']['title']; ?></h1>

    <hr>

    <?php
        $date_modified = $this->Time->format('D-F-j-Y-h:i A', $art['art']['modified']);
        list($dia_sem_mod, $mes_mod, $dia_mod, $ano_mod, $hora_mod) = explode('-', $date_modified);

        $img = "";
        $vid = "";

        $img = $art['img']['image_id'];
        $vid = $art['vid']['video_id'];
    ?>
    
    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Publicado el <?php echo __($dia_sem_mod) . ", " . __($dia_mod) . " de " . __($mes_mod) . " de " . __($ano_mod) .  " " . $hora_mod ?></p>

    <hr>
   
    <?php
        if($img != "") {
            echo $this->Html->image($art['img']['uri'], array('alt' => $art['img']['title'], 'class' => 'img-responsive', 'border' => '0'));
            echo "<hr>";
            
        } elseif ($vid != "") {
            echo "<div>" .  
                    "<iframe width='100%' height='400' src='//" . $art['vid']['source'] . "' frameborder='0' allowfullscreen></iframe>" .
                 "</div>";
            echo "<hr>";
        }
    ?>

    <!-- Post Content -->
    <?php $no_tags_sum = strip_tags($art['art']['summary']); ?>
    <p class="lead"><?php echo $no_tags_sum ?></p>
    <?php echo $art['art']['body']?>

    <hr>
<?php } ?>