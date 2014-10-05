<div class="box notas">
    <?php foreach ($article as $art) { ?>
        <h3><?php echo $art['art']['title']; ?></h3>
        <?php 
            $date = $this->Time->format('D-F-j-Y-h:i A', $art['art']['modified']);
            list($dia_sem, $mes, $dia, $ano) = explode('-', $date);

            $img = "";
            $vid = "";

            $img = $art['img']['image_id'];
            $vid = $art['vid']['video_id'];
        ?>
        <div class="dia mb15"><?php echo __($dia_sem) . " " . __($mes) . " " . __($dia) . ", " . __($ano);?></div>
        <div class="taj">
            <?php 
                if($img != "") {
                    echo $this->Html->image($art['img']['uri_thumb'], array('alt' => $art['img']['title'], 'align' => 'left', 'border' => '0'));
                } elseif ($vid != "") {
                    echo "<div>" .  
                            "<iframe width='560' height='380' src='//" . $art['vid']['source'] . "' frameborder='0' allowfullscreen></iframe>" .
                            "</div>";
                } 

                echo "<strong class='mb10'>" . $art['art']['summary'] . "</strong>";
                echo "<br><br>";
                echo $art['art']['body'];                        
            ?>
        </div>
    <?php } ?>
</div>
