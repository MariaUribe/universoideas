<div class="rio">
    <?php 
        foreach ($articles_rio as $article) { 
            $img = "";
            $vid = "";
            
            $img = $article['img']['image_id'];
            $vid = $article['vid']['video_id'];
            
            $date = $this->Time->format('D-F-j-Y-h:i A', $article['art']['modified']);
            list($dia_sem, $mes, $dia, $ano) = explode('-', $date);
            
            echo "<div class='box notas'>";
            echo "<input id='article_id' type='hidden' value='" . $article['art']['id'] . "'/>";
            echo "<h2 class='title_rio'><a href='/pages/article?id=" . $article['art']['id'] . "'>" . $article['art']['title'] . "</a></h2>";
            echo "<div class='dia'>" . __($dia_sem) . " " . __($mes) . " " . __($dia) . ", " . __($ano) . "</div>";
            echo "<div>";
            if($img != "") {
                echo $this->Html->image($article['img']['uri_thumb'], array('alt' => $article['img']['title'], 'align' => 'left', 'border' => '0'));
            } elseif ($vid != "") {
                echo "<div>" .  
                     "<iframe width='320' height='215' src='//" . $article['vid']['source'] . "' frameborder='0' allowfullscreen></iframe>" .
                     "</div>";
            }
            echo $article['art']['summary'];
            echo "<div><a href='/pages/article?id=" . $article['art']['id'] . "' class='sleyendo'>Seguir Leyendo &raquo;</a></div>";
            echo "</div>";
            echo "</div>";
        }
    ?>
</div>