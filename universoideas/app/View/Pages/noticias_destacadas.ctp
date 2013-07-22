<div class="destacada">
    <div class="titulo">Noticias destacadas</div>
    <div class="contenido">
        <ol>
            <?php 
                foreach ($articles_dest as $article) { 
                    echo "<li><a href='#'>" . $article['art']['title'] . "</a></li>";
                }
            ?>
        </ol>
    </div>
</div>