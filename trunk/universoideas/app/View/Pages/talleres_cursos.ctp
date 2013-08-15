<div class="title">Talleres y Cursos</div>

<?php 
    foreach ($cursos as $curso) {
        $img = "";
        $img = $curso['Curso']['image_thumb'];
        
        echo "<div class='caja'>";
        echo "<div class='dia'>" . $curso['Curso']['date'] . "</div>";
        echo "<div class='txt'>"; 
        echo "<a href='/universoideas/pages/curso?id=" . $curso['Curso']['id'] . "'>";
        if($img != "")
            echo $this->Html->image($img, array('align' => 'left', 'border' => '0', 'width' => '50', 'height' => '49'));
        echo "<strong>" . $curso['Curso']['name'] . "</strong>";
        echo "</a><br/>";
        echo $curso['Curso']['description'];
        echo "</div>";
        echo "<div><a href='/universoideas/pages/curso?id=" . $curso['Curso']['id'] . "' class='sleyendo'>Más información &raquo;</a></div>";
        echo "</div>";
    }
?>