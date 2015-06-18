<input id="page_code" type="hidden" value="index"/>

<div class="row">
    <div class="col-md-9 col-sm-9">
        <?php 
            if (sizeof($articles) === 0 && sizeof($events) === 0 && sizeof($cursos) === 0 && sizeof($forums) === 0) {
                echo "<h2>No se encontraron resultados para la búsqueda: \"" . $text . "\"</h2>";
            } else {
        ?>
        
        <?php echo "<h2>Resultados de búsqueda para: \"" . $text . "\"</h2>"?>
        <hr>
        
        <?php if (sizeof($articles) !== 0) { ?>
        
            <h3>Resultados encontrados en: Artículos</h3>
            <hr>
            <?php 
                foreach ($articles as $article) { 
                    $date = $this->Time->format('D-F-j-Y-h:i A', $article['article']['modified']);
                    list($dia_sem, $mes, $dia, $ano, $hora) = explode('-', $date);

                    echo "<input id='article_id' type='hidden' value='" . $article['article']['id'] . "'/>";
                    echo "<h3><a href='/pages/article?id=" . $article['article']['id'] . "'>" . $article['article']['title'] . "</a></h3>";
                    echo "<p><span class='glyphicon glyphicon-time'></span> Publicado el " . __($dia_sem) . ", " . __($dia) . " de " . __($mes) . " de " . __($ano) .  " " . $hora . "</p>";
                    echo "<div>";
                    echo $article['article']['summary'];
                    echo "<div><a href='/pages/article?id=" . $article['article']['id'] . "' class='sleyendo'>Ir al detalle &raquo;</a></div>";
                    echo "</div>";
                    echo "<hr>";
                }
                echo "<div class='tac'><a class='btn btn-success' href='/pages/search_articles?q=" . $text . "'>Ver todos los resultados en Artículos</a></div>";
                echo "<hr>";
            }
        ?>

        <?php if (sizeof($events) !== 0) { ?>

            <h3>Resultados encontrados en: Eventos</h3>
            <hr>
            <?php 
                foreach ($events as $event) {
                    $date = $this->Time->format('D-F-j-Y-h:i A', $event['event']['modified']);
                    list($dia_sem, $mes, $dia, $ano, $hora) = explode('-', $date);

                    echo "<div class='box oh'>";
                    echo "<input id='event_id' type='hidden' value='" . $event['event']['id'] . "'/>";
                    echo "<a href='/pages/event?id=" . $event['event']['id'] . "'><strong>" . $event['event']['name'] . "</strong></a>";
                    echo "<p><span class='glyphicon glyphicon-time'></span> Publicado el " . __($dia_sem) . ", " . __($dia) . " de " . __($mes) . " de " . __($ano) .  " " . $hora . "</p>";
                    echo "<div>";
                    echo $event['event']['description'];
                    echo "<div><a href='/pages/event?id=" . $event['event']['id'] . "' class='sleyendo'>Ir al detalle &raquo;</a></div>";
                    echo "</div>";
                    echo "</div>";
                    echo "<hr>";
                }
                echo "<div class='tac'><a class='btn btn-success' href='/pages/search_events?q=" . $text . "'>Ver todos los resultados en Eventos</a></div>";
                echo "<hr>";
            }
        ?>

        <?php if (sizeof($cursos) !== 0) { ?>
            <h3>Resultados encontrados en: Cursos</h3>
            <hr>
            <?php 
                foreach ($cursos as $curso) { 
                    $date = $this->Time->format('D-F-j-Y-h:i A', $curso['curso']['modified']);
                    list($dia_sem, $mes, $dia, $ano, $hora) = explode('-', $date);

                    echo "<div class='box oh'>";
                    echo "<input id='curso_id' type='hidden' value='" . $curso['curso']['id'] . "'/>";
                    echo "<a href='/pages/curso?id=" . $curso['curso']['id'] . "'><strong>" . $curso['curso']['name'] . "</strong></a>";
                    echo "<p><span class='glyphicon glyphicon-time'></span> Publicado el " . __($dia_sem) . ", " . __($dia) . " de " . __($mes) . " de " . __($ano) .  " " . $hora . "</p>";
                    echo "<div>";
                    echo $curso['curso']['description'];
                    echo "<div><a href='/pages/curso?id=" . $curso['curso']['id'] . "' class='sleyendo'>Ir al detalle &raquo;</a></div>";
                    echo "</div>";
                    echo "</div>";
                    echo "<hr>";
                }
                echo "<div class='tac'><a class='btn btn-success' href='/pages/search_cursos?q=" . $text . "'>Ver todos los resultados en Cursos</a></div>";
                echo "<hr>";
            }
        ?>

        <?php if (sizeof($forums) !== 0) { ?>
        
            <h3>Resultados encontrados en: Foro</h3>
            <hr>
            <?php 
                foreach ($forums as $forum) { 
                    $date = $this->Time->format('D-F-j-Y-h:i A', $forum['forum']['modified']);
                    list($dia_sem, $mes, $dia, $ano, $hora) = explode('-', $date);

                    echo "<div class='box oh'>";
                    echo "<input id='forum_id' type='hidden' value='" . $forum['forum']['id'] . "'/>";
                    echo "<a href='/forums/view/" . $forum['forum']['id'] . "'><strong>" . $forum['forum']['title'] . "</strong></a>";
                    echo "<p><span class='glyphicon glyphicon-time'></span> Publicado el " . __($dia_sem) . ", " . __($dia) . " de " . __($mes) . " de " . __($ano) .  " " . $hora . "</p>";
                    echo "<div>";
                    echo $forum['forum']['content'];
                    echo "<div><a href='/forums/view/" . $forum['forum']['id'] . "' class='sleyendo'>Ir al detalle &raquo;</a></div>";
                    echo "</div>";
                    echo "</div>";
                    echo "<hr>";
                }

                echo "<div class='tac'><a class='btn btn-success' href='/pages/search_forums?q=" . $text . "'>Ver todos los resultados en el Foro</a></div>";
                echo "<hr>";
            } ?>
        <?php } ?>
    </div>
    <div class="col-md-3 col-sm-3">
        <?php include ("includes/siguenos.htm") ?>
        <?php include ("includes/published/join.htm") ?>
        <?php include('includes/published/noticias_destacadas.htm'); ?>
        <?php include ("includes/twitter.htm") ?>
        <?php include ("includes/facebook.htm") ?>
    </div>
</div>
