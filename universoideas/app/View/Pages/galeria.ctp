<div id="slider1_container" style="position: relative; top: 0px; left: 0px; width: 848px; height: 440px;" class="panel">
    <div u="slides" style="cursor: move; position: absolute; overflow: hidden; left: 0px; top: 0px; width: 848px; height: 440px;">
        
        <?php 
            foreach ($articles_gallery as $article) { 
                $img = "";
                $vid = "";

                $img = $article['img']['image_id'];
                $date = $this->Time->format('D-F-j-Y-h:i A', $article['art']['modified']);
                list($dia_sem, $mes, $dia, $ano) = explode('-', $date);
                $no_tags_desc = strip_tags($article['art']['summary']);
                $art_body = (strlen($no_tags_desc) > 163) ? substr($no_tags_desc,0,160).'...' : $no_tags_desc;

                echo "<input id='article_id' type='hidden' value='" . $article['art']['id'] . "'/>";
                echo "<div>";
                echo $this->Html->image($article['img']['uri'], array('u' => 'image'));
                echo "<div u='caption' t='transition_left' style='position: absolute; top: 285px; left: 20px; width: 805px; height: 110px; color: rgb(61, 61, 61); background-color: rgba(255, 255, 255, 0.6); padding: 3px 0px 0px 10px;'>";
                echo "<a href='/pages/article?id=" . $article['art']['id'] . "' style='color: rgb(61, 61, 61);line-height: 15px;'>";
                //echo $this->Html->image($article['img']['uri'], array('width' => '620', 'height' => '370'));
                echo "<strong style='font-size: 16px;'>" . $article['art']['title'] . "</strong><br/>";
                echo "<div class='dia'>" . __($dia_sem) . " " . __($mes) . " " . __($dia) . ", " . __($ano) . "</div>";
                echo $art_body;
                echo "</a>";
                echo "</div>";
                echo "</div>";
            }
        ?>
    </div>
    <!--#region Bullet Navigator Skin Begin -->
    <!-- Help: http://www.jssor.com/development/slider-with-bullet-navigator-jquery.html -->
    <style>
        /* jssor slider bullet navigator skin 05 css */
        .jssorb05 {
            position: absolute;
        }
        .jssorb05 div, .jssorb05 div:hover, .jssorb05 .av {
            position: absolute;
            /* size of bullet elment */
            width: 16px;
            height: 16px;
            background: url(../img/b05.png) no-repeat;
            overflow: hidden;
            cursor: pointer;
        }
        .jssorb05 div { background-position: -7px -7px; }
        .jssorb05 div:hover, .jssorb05 .av:hover { background-position: -37px -7px; }
        .jssorb05 .av { background-position: -67px -7px; }
        .jssorb05 .dn, .jssorb05 .dn:hover { background-position: -97px -7px; }

        /* jssor slider arrow navigator skin 05 css */
        .jssora05l, .jssora05r {
            display: block;
            position: absolute;
            /* size of arrow element */
            width: 40px;
            height: 40px;
            cursor: pointer;
            background: url(../img/a17.png) no-repeat;
            overflow: hidden;
        }
        .jssora05l { background-position: -10px -40px; }
        .jssora05r { background-position: -70px -40px; }
        .jssora05l:hover { background-position: -130px -40px; }
        .jssora05r:hover { background-position: -190px -40px; }
        .jssora05l.jssora05ldn { background-position: -250px -40px; }
        .jssora05r.jssora05rdn { background-position: -310px -40px; }
    </style>

    <div u="navigator" class="jssorb05" style="bottom: 16px; right: 6px;">
        <div u="prototype"></div>
    </div>
    <!--#endregion Bullet Navigator Skin End -->

    <span u="arrowleft" class="jssora05l" style="top: 123px; left: 8px;"></span>
    <span u="arrowright" class="jssora05r" style="top: 123px; right: 8px;"></span>
</div>

<script>
    jQuery(document).ready(function ($) {
        jssor_slider1_starter();
    });
</script>

<!--div id="slider1">
    <ul id="slider1Content" style=" margin:0 0 0 -40px">
        <php 
            foreach ($articles_gallery as $article) { 
                $img = "";
                $vid = "";

                $img = $article['img']['image_id'];
                $date = $this->Time->format('D-F-j-Y-h:i A', $article['art']['modified']);
                list($dia_sem, $mes, $dia, $ano) = explode('-', $date);

                echo "<li class='slider1Image'>";
                echo "<input id='article_id' type='hidden' value='" . $article['art']['id'] . "'/>";
                echo "<a href='/pages/article?id=" . $article['art']['id'] . "'>";
                echo $this->Html->image($article['img']['uri'], array('width' => '620', 'height' => '370'));
                
                echo "<span class='gright'>";
                echo "<strong>" . $article['art']['title'] . "</strong><br/>";
                echo "<div class='dia'>" . __($dia_sem) . " " . __($mes) . " " . __($dia) . ", " . __($ano) . "</div>";
                echo $article['art']['summary'];
                echo "</span>";
                
                echo "</a>";
                echo "</li>";
            }
        ?>
        <div class="clear slider1Image"></div>
    </ul>
</div-->