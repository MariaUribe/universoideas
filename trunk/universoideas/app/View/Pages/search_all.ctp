<input id="page_code" type="hidden" value="index"/>
<div id="content_col_izq">
    <div class="rio">
        <?php 
            if (sizeof($articles) === 0 && sizeof($events) === 0 && sizeof($cursos) === 0 && sizeof($forums) === 0) {
                echo "<h2>No se encontraron resultados para la búsqueda: \"" . $text . "\"</h2>";
            } else {
        ?>
        
        <?php echo "<h2>Resultados de búsqueda para: \"" . $text . "\"</h2>"?>
        <div class="notas">
            <?php if (sizeof($articles) !== 0) { ?>
            
            <h2>Artículos</h2>
            <?php
                echo "<div class='mt5 mb20'><a href='/pages/search_articles?q=" . $text . "'>Ver todos los resultados de Artículos</a></div>";
            ?>

            <?php 
                foreach ($articles as $article) { 
                    $date = $this->Time->format('D-F-j-Y-h:i A', $article['article']['modified']);
                    list($dia_sem, $mes, $dia, $ano) = explode('-', $date);

                    echo "<div class='box oh'>";
                    echo "<input id='article_id' type='hidden' value='" . $article['article']['id'] . "'/>";
                    echo "<a href='/pages/article?id=" . $article['article']['id'] . "'><strong>" . $article['article']['title'] . "</strong></a>";
                    echo "<div class='dia'>" . __($dia_sem) . " " . __($mes) . " " . __($dia) . ", " . __($ano) . "</div>";
                    echo "<div>";
                    echo $article['article']['summary'];
                    echo "<div><a href='/pages/article?id=" . $article['article']['id'] . "' class='sleyendo'>Ir al detalle &raquo;</a></div>";
                    echo "</div>";
                    echo "</div>";
                }
            } ?>
            
            <?php if (sizeof($events) !== 0) { ?>
            
            <h2>Eventos</h2>
            <?php
                echo "<div class='mt5 mb20'><a href='/pages/search_events?q=" . $text . "'>Ver todos los resultados de Eventos</a></div>";
            ?>

            <?php 
                foreach ($events as $event) { 
                    $date = $this->Time->format('D-F-j-Y-h:i A', $event['event']['modified']);
                    list($dia_sem, $mes, $dia, $ano) = explode('-', $date);

                    echo "<div class='box oh'>";
                    echo "<input id='event_id' type='hidden' value='" . $event['event']['id'] . "'/>";
                    echo "<a href='/pages/event?id=" . $event['event']['id'] . "'><strong>" . $event['event']['name'] . "</strong></a>";
                    echo "<div class='dia'>" . __($dia_sem) . " " . __($mes) . " " . __($dia) . ", " . __($ano) . "</div>";
                    echo "<div>";
                    echo $event['event']['description'];
                    echo "<div><a href='/pages/event?id=" . $event['event']['id'] . "' class='sleyendo'>Ir al detalle &raquo;</a></div>";
                    echo "</div>";
                    echo "</div>";
                }
            } ?>
            
            <?php if (sizeof($cursos) !== 0) { ?>
            
            <h2>Cursos</h2>
            <?php
                echo "<div class='mt5 mb20'><a href='/pages/search_cursos?q=" . $text . "'>Ver todos los resultados de Cursos</a></div>";
            ?>

            <?php 
                foreach ($cursos as $curso) { 
                    $date = $this->Time->format('D-F-j-Y-h:i A', $curso['curso']['modified']);
                    list($dia_sem, $mes, $dia, $ano) = explode('-', $date);

                    echo "<div class='box oh'>";
                    echo "<input id='curso_id' type='hidden' value='" . $curso['curso']['id'] . "'/>";
                    echo "<a href='/pages/curso?id=" . $curso['curso']['id'] . "'><strong>" . $curso['curso']['name'] . "</strong></a>";
                    echo "<div class='dia'>" . __($dia_sem) . " " . __($mes) . " " . __($dia) . ", " . __($ano) . "</div>";
                    echo "<div>";
                    echo $curso['curso']['description'];
                    echo "<div><a href='/pages/curso?id=" . $curso['curso']['id'] . "' class='sleyendo'>Ir al detalle &raquo;</a></div>";
                    echo "</div>";
                    echo "</div>";
                }
            }
            ?>
            
            <?php if (sizeof($forums) !== 0) { ?>
             
            <h2>Temas del Foro</h2>
            <?php
                echo "<div class='mt5 mb20'><a href='/pages/search_forums?q=" . $text . "'>Ver todos los resultados de Foros</a></div>";
            ?>

            <?php 
                foreach ($forums as $forum) { 
                    $date = $this->Time->format('D-F-j-Y-h:i A', $forum['forum']['modified']);
                    list($dia_sem, $mes, $dia, $ano) = explode('-', $date);

                    echo "<div class='box oh'>";
                    echo "<input id='forum_id' type='hidden' value='" . $forum['forum']['id'] . "'/>";
                    echo "<a href='/forums/view/" . $forum['forum']['id'] . "'><strong>" . $forum['forum']['title'] . "</strong></a>";
                    echo "<div class='dia'>" . __($dia_sem) . " " . __($mes) . " " . __($dia) . ", " . __($ano) . "</div>";
                    echo "<div>";
                    echo $forum['forum']['content'];
                    echo "<div><a href='/forums/view/" . $forum['forum']['id'] . "' class='sleyendo'>Ir al detalle &raquo;</a></div>";
                    echo "</div>";
                    echo "</div>";
                }
            }
            ?>
        </div>
        <?php } ?>
    </div>
</div>

<div id="content_col_der">
    <?php include ("includes/siguenos.htm") ?>
    <div id="publicidadventana2" class="p5 tac"><div class="publicidad tal">ESPACIO PUBLICITARIO</div><a href="#"><img src="/universoideas/img/publicidad/300x250.gif" width="300" height="250" alt="Publicidad" /></a></div>
    <?php include('includes/published/noticias_destacadas.htm'); ?>
</div>
