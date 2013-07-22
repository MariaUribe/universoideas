<div class="rio">
    <?php 
        foreach ($articles_rio as $article) { 
            $img = "";
            $vid = "";
            
            $img = $article['img']['image_id'];
            $vid = $article['vid']['video_id'];
            
            echo "<div class='box notas'>";
            echo "<input id='article_id' type='hidden' value='" . $article['art']['id'] . "'/>";
            echo "<h2><a href='#'>" . $article['art']['title'] . "</a></h2>";
            echo "<div>";
            if($img != "") {
                echo $this->Html->image($article['img']['uri_thumb'], array('alt' => $article['img']['title'], 'align' => 'left', 'border' => '0'));
            } elseif ($vid != "") {
                echo "<div>" . $article['vid']['source'] . "</div>";
            }
            echo $article['art']['summary'];
            echo "</div>";
            echo "</div>";
        }
    ?>
</div>