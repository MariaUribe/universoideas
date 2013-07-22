<div class="title">Talleres y Cursos</div>

<?php 
    foreach ($cursos as $curso) {
        $img = "";
        $img = $curso['Curso']['image_thumb'];
        
        echo "<div class='caja'>";
        echo "<div class='dia'>" . $curso['Curso']['date'] . "</div>";
        echo "<div class='txt'><a href='#'>";
        if($img != "")
            echo $this->Html->image($img, array('align' => 'left', 'border' => '0', 'width' => '50', 'height' => '49'));
        echo $curso['Curso']['name'];
        echo "</a></div>";
        echo "</div>";
    }
?>