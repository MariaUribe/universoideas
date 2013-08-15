 <div class="title">Calendario</div>

<?php 
    foreach ($events as $event) {
        $img = "";
        $img = $event['Event']['image_thumb'];
        
        $date = $this->Time->format('D-F-j-Y-h:i A', $event['Event']['event_date']);
        list($dia_sem, $mes, $dia, $ano) = explode('-', $date);
        
        echo "<div class='caja'>";
        echo "<div class='dia'>" . __($dia_sem) . " " . __($mes) . " " . __($dia) . ", " . __($ano)  . "</div>";
        echo "<div class='txt'>";
        echo "<a href='/universoideas/pages/event?id=" . $event['Event']['id'] . "'>";
        if($img != "")
            echo $this->Html->image($img, array('align' => 'left', 'border' => '0', 'width' => '50', 'height' => '49'));
        echo "<strong>" . $event['Event']['name'] . "</strong>";
        echo "</a><br/>";
        echo $event['Event']['description'];
        echo "</div>";
        echo "<div><a href='/universoideas/pages/event?id=" . $event['Event']['id'] . "' class='sleyendo'>Más información &raquo;</a></div>";
        echo "</div>";
    }
?>