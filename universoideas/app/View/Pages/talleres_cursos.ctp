<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="/js/jquery.bxslider.min.js"></script>
<link href="/css/jquery.bxslider.css" rel="stylesheet" />

<script>
    j191 = jQuery.noConflict( true );
    
    j191(document).ready(function(){
        j191('.bxslider').bxSlider();
    });
</script>

<div class="title_box dark_title p-custom">Talleres y Cursos</div>
<div class="line-separator-dark" style="clear: both"></div>

<div class="bxslider">
<?php
    $cont = 0;
    $total_courses = sizeof($cursos);
    
    foreach ($cursos as $curso) {
        $cont++;
        $img = "";
        $img = $curso['Curso']['image_thumb'];
        $no_tags_desc = strip_tags($curso['Curso']['description']);
        $description = (strlen($no_tags_desc) > 203) ? substr($no_tags_desc,0,200).'...' : $no_tags_desc;
        
        $date = $this->Time->format('D-F-j-Y-h:i A', $curso['Curso']['date']);
        list($dia_sem, $mes, $dia, $ano) = explode('-', $date);
        
        echo "<div class='caja'>";
        echo "<div class='txt'>"; 
        
        if($img != "") {
            echo "<div class='mt15 mb15'>";
            echo "<a href='/pages/curso?id=" . $curso['Curso']['id'] . "'>";
            echo $this->Html->image($img, array('align' => 'left', 'border' => '0', 'style' => 'max-width: 190px;', 'class' => 'mr15 ml15 mb15'));
            echo "</a>";
            echo "</div>";
        }
        
        echo "<div class='m15'>";
        
        echo "<p style='margin: 0px 0px 5px 0px!important;font-size: 11px;'>" . __($dia_sem) . " " . __($mes) . " " . __($dia) . ", " . __($ano)  . "</p>";
        
        echo "<a href='/pages/curso?id=" . $curso['Curso']['id'] . "'>";
        echo "<strong style='font-size: 16px; color: #eee'>" . $curso['Curso']['name'] . "</strong>";
        echo "</a>";
        
        echo "<div class='mod-cal mt10 taj'>";
        echo $description;
        echo "</div>";
        
        echo "</div>";
        echo "</div>";
        
        echo "<div><a href='/pages/curso?id=" . $curso['Curso']['id'] . "' class='sleyendo-rbox'>Más información &raquo;</a></div>";
        
        echo "</div>";
    }
?>
</div>

 
<!-- <div class="title_box">Talleres y Cursos</div>

 <div class="line-separator" style="clear: both"></div>

<php
    $cont = 0;
    $total_courses = sizeof($cursos);
    
    foreach ($cursos as $curso) {
        $cont++;
        $img = "";
        $img = $curso['Curso']['image_thumb'];
        $no_tags_desc = strip_tags($curso['Curso']['description']);
        $description = (strlen($no_tags_desc) > 203) ? substr($no_tags_desc,0,200).'...' : $no_tags_desc;
        
        $date = $this->Time->format('D-F-j-Y-h:i A', $curso['Curso']['date']);
        list($dia_sem, $mes, $dia, $ano) = explode('-', $date);
        
        echo "<div class='caja'>";
        echo "<div class='txt'>"; 
        
        if($img != "") {
            echo "<a href='/pages/curso?id=" . $curso['Curso']['id'] . "'>";
            echo $this->Html->image($img, array('align' => 'left', 'border' => '0', 'style' => 'max-width: 190px;margin-bottom: 15px;'));
            echo "</a>";
        }
        
        echo "<p style='margin: 0px 0px 2px 0px!important;font-size: 11px;'>" . __($dia_sem) . " " . __($mes) . " " . __($dia) . ", " . __($ano)  . "</p>";
        
        echo "<a href='/pages/curso?id=" . $curso['Curso']['id'] . "'>";
        echo "<strong style='font-size: 16px'>" . $curso['Curso']['name'] . "</strong>";
        echo "</a>";
        
        echo "<div class='mod-cal mt10'>";
        echo $description;
        echo "</div>";
        
        echo "</div>";
        echo "<div><a href='/pages/curso?id=" . $curso['Curso']['id'] . "' class='sleyendo'>Más información &raquo;</a></div>";
        
        if($cont != $total_courses) {
            echo "<div class='line-separator' style='clear: both'></div>";
        }
        
        echo "</div>";
    }
?>-->