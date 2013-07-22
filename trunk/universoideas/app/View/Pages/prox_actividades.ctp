<div class="title">Próximos Eventos</div>

<?php 
    foreach ($events as $event) {
        $img = "";
        $img = $event['Event']['image_thumb'];
        
        echo "<div class='caja'>";
        echo "<div class='dia'>" . $event['Event']['event_date'] . "</div>";
        echo "<div class='txt'><a href='#'>";
        if($img != "")
            echo $this->Html->image($img, array('align' => 'left', 'border' => '0', 'width' => '50', 'height' => '49'));
        echo $event['Event']['name'];
        echo "</a></div>";
        echo "</div>";
    }
?>