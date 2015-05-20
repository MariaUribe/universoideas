<?php
    $cont = 0;
    $cont_2 = 0;
    $total_articles = sizeof($articles_rio);

    foreach ($articles_rio as $article) {
        $cont++;
        $cont_2++;

        if ($cont_2 === 1) {
            echo "<div class='row m0'>";
        }

        //if($cont == 4) {
        //    include ("includes/published/talleres_cursos.htm");
        //} else {
            $img = "";
            $vid = "";

            $img = $article['img']['image_id'];
            $vid = $article['vid']['video_id'];
            $no_tags_desc = strip_tags($article['art']['summary']);
            $art_body = (strlen($no_tags_desc) > 153) ? substr($no_tags_desc,0,150).'...' : $no_tags_desc;

            $date = $this->Time->format('D-F-j-Y-h:i A', $article['art']['modified']);
            list($dia_sem, $mes, $dia, $ano) = explode('-', $date);

            echo "<div class='col-md-4 col-sm-4 p10-10'>";
            echo "<div class='panel panel-default'>";
            echo "<div class='panel-heading channel'>" . strtoupper($article['art']['channel']) . "</div>";
            echo "<input id='article_id' type='hidden' value='" . $article['art']['id'] . "'/>";
            echo "<div class='panel-body'>";
            echo "<h2 class='title_rio'><a href='/pages/article?id=" . $article['art']['id'] . "'>" . $article['art']['title'] . "</a></h2>";
            echo "<div class='dia'>" . __($dia_sem) . " " . __($mes) . " " . __($dia) . ", " . __($ano) . "</div>";
            echo "<div class='body'>";
            if($img != "") {
                echo "<div class='img'>";
                echo $this->Html->image($article['img']['uri_thumb'], array('alt' => $article['img']['title'], 'border' => '0', 'class' => 'img-responsive'));
                echo "</div>";
            } elseif ($vid != "") {
                echo "<div>" .  
                     "<iframe style='width: 100%;' src='//" . $article['vid']['source'] . "' frameborder='0' allowfullscreen></iframe>" .
                     "</div>";
            } else {
                echo "<div class='img mt10 mb10'>";
                echo $this->Html->image('/img/logo.png', array('alt' => 'Universoideas', 'border' => '0', 'width' => '220', 'class' => 'img-responsive'));
                echo "</div>";
            }

            echo "<div class='sumary'>" . $art_body . "</div>";
            echo "<div><a href='/pages/article?id=" . $article['art']['id'] . "' class='sleyendo'>Seguir Leyendo &raquo;</a></div>";
            echo "</div>";
            echo "</div>";

            /*if($cont != $total_articles) {
                echo "<div class='line-separator' style='clear: both'></div>";
            }*/

            echo "</div>";
            echo "</div>";
        //}

        $mod_3 = $total_articles % 3;
        
        if($mod_3 != 0) {
            if ($cont_2 === 3) {
                echo "</div>";
                $cont_2 = 0;
            } else {
                if($cont === $total_articles) {
                    echo "</div>";
                }
            }
            
        } else if ($cont_2 === 3) {
            echo "</div>";
            $cont_2 = 0;
        }
    }
?>