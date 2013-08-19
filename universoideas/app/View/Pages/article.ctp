<input id="page_code" type="hidden" value="index"/>
<div id="content_col_izq">
    <div class="rio">
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
                <div class="dia"><?php echo __($dia_sem) . " " . __($mes) . " " . __($dia) . ", " . __($ano);?></div>
                <div>
                    <?php 
                        if($img != "") {
                            echo $this->Html->image($art['img']['uri_thumb'], array('alt' => $art['img']['title'], 'align' => 'left', 'border' => '0'));
                        } elseif ($vid != "") {
                            echo "<div>" .  
                                 "<iframe width='560' height='380' src='//" . $art['vid']['source'] . "' frameborder='0' allowfullscreen></iframe>" .
                                 "</div>";
                        } 
                        
                        echo "<strong>" . $art['art']['summary'] . "</strong>";
                        echo "<br>";
                        echo $art['art']['body'];                        
                    ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<div id="content_col_der">
    <?php include ("includes/siguenos.htm") ?>
    <div id="publicidadventana2" class="p5 tac"><div class="publicidad tal">ESPACIO PUBLICITARIO</div><a href="#"><img src="/universoideas/img/publicidad/300x250.gif" width="300" height="250" alt="Publicidad" /></a></div>
    <?php include('noticias_destacadas.ctp'); ?>
</div>
