 <div class="title">Calendario</div>

<?php 
    foreach ($events as $event) {
        $img = "";
        $img = $event['Event']['image_thumb'];
        
        echo "<div class='caja'>";
        echo "<div class='dia'>" . $event['Event']['event_date'] . "</div>";
        echo "<div class='txt'>";
        echo "<a href='#'>";
        if($img != "")
            echo $this->Html->image($img, array('align' => 'left', 'border' => '0', 'width' => '50', 'height' => '49'));
        echo "<strong>" . $event['Event']['name'] . "</strong>";
        echo "</a><br/>";
        echo $event['Event']['description'];
        echo "</div>";
        echo "<div><a href='#' class='sleyendo'>Más información &raquo;</a></div>";
        echo "</div>";
    }
?>