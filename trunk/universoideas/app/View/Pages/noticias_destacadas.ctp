<div class="destacada">
    <div class="titulo">Noticias destacadas</div>
    <div class="contenido">
        <ol>
            <?php 
                foreach ($articles_dest as $article) { 
                    echo "<li><a href='/universoideas/pages/article?id=" . $article['art']['id'] . "'>" . $article['art']['title'] . "</a></li>";
                }
            ?>
        </ol>
    </div>
</div>