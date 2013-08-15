<input id="page_code" type="hidden" value="calendario"/>
<div id="content_col_izq">
    <div class="rio">
        <div class="box notas">
                <h3><?php echo $event['Event']['name']; ?></h3>
                <?php 
                    $date = $this->Time->format('D-F-j-Y-h:i A', $event['Event']['event_date']);
                    list($dia_sem, $mes, $dia, $ano) = explode('-', $date);

                    $img = "";
                    $vid = "";

                    $img = $event['Event']['image'];
                ?>
                
                    <?php 
                        echo "<div style='width: 100%'>";
                        if($img != "") {
                            echo $this->Html->image($event['Event']['image'], array('alt' => $event['Event']['name'], 'align' => 'left', 'border' => '0', 'width' => 440));
                        } 
                        echo "</div>";
                        
                        echo "<div style='float: left;' class='mt15'>";
                        echo "<div><strong>Fecha del evento: </strong>" . __($dia_sem) . " " . __($mes) . " " . __($dia) . ", " . __($ano) . "</div>";
                        echo "<div><strong>Lugar: </strong>" . $event['Event']['place'] . "</div>";
                        echo "<div><strong>Hora de inicio: </strong>" . $event['Event']['init_time'] . "</div>";
                        echo "<div><strong>Hora de fin: </strong>" . $event['Event']['end_time'] . "</div>";
                        echo "<br>";
                        echo $event['Event']['description'];
                        echo "</div>";
                    ?>
        </div>
    </div>
</div>

<div id="content_col_der">
    <?php include ("includes/siguenos.htm") ?>
    <div id="publicidadventana2" class="p5 tac"><div class="publicidad tal">ESPACIO PUBLICITARIO</div><a href="#"><img src="/universoideas/img/publicidad/300x250.gif" width="300" height="250" alt="Publicidad" /></a></div>
    <?php include('noticias_destacadas.ctp'); ?>
</div>
