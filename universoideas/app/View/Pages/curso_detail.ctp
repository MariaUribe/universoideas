<div class="box notas">
    <h3><?php echo $curso['Curso']['name']; ?></h3>
    <?php 
        $date = $this->Time->format('D-F-j-Y-h:i A', $curso['Curso']['date']);
        list($dia_sem, $mes, $dia, $ano) = explode('-', $date);

        $img = "";
        $vid = "";

        $img = $curso['Curso']['image'];

        echo "<div style='width: 100%'>";
        if($img != "") {
            echo $this->Html->image($curso['Curso']['image'], array('alt' => $curso['Curso']['name'], 'align' => 'left', 'border' => '0', 'width' => 200));
        } 
        echo "</div>";

        echo "<div style='float: left;' class='mt15'>";
        echo "<div><strong>Fecha del curso: </strong>" . __($dia_sem) . " " . __($mes) . " " . __($dia) . ", " . __($ano) . "</div>";
        echo "<br>";
        echo $curso['Curso']['description'];
        echo "</div>";
    ?>
</div>

