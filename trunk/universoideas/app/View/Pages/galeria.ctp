<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="js/s3Slider.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#slider1').s3Slider({
            timeOut: 4000 
        });
    });
</script>

<div id="slider1">
    <ul id="slider1Content" style=" margin:0 0 0 -40px">
        <?php 
            foreach ($articles_gallery as $article) { 
                $img = "";
                $vid = "";

                $img = $article['img']['image_id'];

                echo "<li class='slider1Image'>";
                echo "<input id='article_id' type='hidden' value='" . $article['art']['id'] . "'/>";
                echo "<a href=''>";
                echo $this->Html->image($article['img']['uri'], array('width' => '550', 'height' => '266'));
                
                echo "<span class='gright'>";
                echo "<strong>" . $article['art']['title'] . "</strong><br/>";
                echo $article['art']['summary'];
                echo "</span>";
                
                echo "</a>";
                echo "</li>";
            }
        ?>
        <div class="clear slider1Image"></div>
    </ul>
</div>