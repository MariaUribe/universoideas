 <div class="title_box">CALENDARIO</div>
 <div class="line-separator" style="clear: both"></div>
 
 <div class="caja pb10">

<?php 
    $cont = 0;
    $total_events = sizeof($events);
    
    foreach ($events as $event) {
        $cont++;
        $img = "";
        $img = $event['Event']['image_thumb'];
        $no_tags_desc = strip_tags($event['Event']['description']);
        $description = (strlen($no_tags_desc) > 203) ? substr($no_tags_desc,0,200).'...' : $no_tags_desc;
        
        $date = $this->Time->format('D-F-j-Y-h:i A', $event['Event']['event_date']);
        list($dia_sem, $mes, $dia, $ano) = explode('-', $date);
        
        echo "<div class='caja-interna'>";
        echo "<div class='txt'>";
        
        if($img != "") {
            echo "<a href='/pages/event?id=" . $event['Event']['id'] . "'>";
            echo $this->Html->image($img, array('align' => 'left', 'border' => '0', 'style' => 'max-width: 190px;margin-bottom: 15px;'));
            echo "</a>";
        }
        
        echo "<p style='margin: 0px 0px 2px 0px!important;font-size: 11px;'>" . __($dia_sem) . " " . __($mes) . " " . __($dia) . ", " . __($ano)  . "</p>";
        
        echo "<a href='/pages/event?id=" . $event['Event']['id'] . "'>";
        echo "<strong style='font-size: 16px'>" . $event['Event']['name'] . "</strong>";
        echo "</a>";
        
        echo "<div class='mod-cal mt10'>";
        echo $description;
        echo "</div>";
        echo "<div style='overflow: hidden;'><a href='/pages/event?id=" . $event['Event']['id'] . "' class='sleyendo_box'>Más información &raquo;</a></div>";
        
        echo "</div>";
        echo "</div>";
        
        if($cont != $total_events) {
            echo "<div class='line-separator' style='clear: both'></div>";
        }
    }
?>
 </div>