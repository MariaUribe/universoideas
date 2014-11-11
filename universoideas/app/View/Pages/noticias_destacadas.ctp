<div class="all-themes">
    <div id="content-l" class="content destacada">
        <div class="dark_title">Noticias destacadas</div>
        <hr />
        <?php 
            foreach ($articles_dest as $article) { 
                echo "<p><a class='a-gray' href='/pages/article?id=" . $article['art']['id'] . "'>" . $article['art']['title'] . "</a></p>";
            }
        ?>
        <hr />
    </div>
</div>

<script>
  
    $(document).ready(function(){
        $.mCustomScrollbar.defaults.scrollButtons.enable=true;
        $.mCustomScrollbar.defaults.axis="yx";
        $("#content-l").mCustomScrollbar();
    });
    
</script>