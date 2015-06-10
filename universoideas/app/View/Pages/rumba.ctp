<input id="page_code" type="hidden" value="vida"/>

<div class="row">
    <div class="col-md-12">
        <h4 class="page-head-line channel_name">Rumba</h4>
    </div>
</div>

<div class="row">
    <div class="col-md-9 col-sm-9">
        <?php include ("includes/published/galleries/galeria-rumba.htm") ?>
    </div>
    <div class="col-md-3 col-sm-3">
        <?php include ("includes/siguenos.htm") ?>
        <?php include ("includes/published/join.htm") ?>
    </div>
</div>

<div class="row mt15">
    <div class='col-md-9 col-sm-9 p0-10'>
        <?php include('includes/published/rios/rio-rumba.htm'); ?>
    </div>
    <div class="col-md-3 col-sm-3 cursos p10-10">
        <?php include ("includes/published/talleres_cursos.htm") ?>
    </div>
    <div class="col-md-3 col-sm-3 mb15">
        <div id="publicidadventana1" class="p5 tac">
            <div class="publicidad tal">ESPACIO PUBLICITARIO</div>
            <a href="#">
                <img src="/img/publicidad/300x250.gif" width="300" height="250" alt="Publicidad" class="img-responsive"/>
            </a>
        </div>
    </div>

    <?php
        $no_class = "";
        $offset_class = "col-xs-offset-9";

        /* noticias destacadas */
        if($articles_count <= 3) {
            echo "<div class='col-md-3 col-sm-3 p10-10 mb15 " . $offset_class . "'>";
        } else {
            echo "<div class='col-md-3 col-sm-3 p10-10 mb15'>";
        }
        include('includes/published/noticias_destacadas.htm');
        echo "</div>";

        /* twitter */
        if($articles_count <= 6) {
            echo "<div class='col-md-3 col-sm-3 p10-10 mb20 " . $offset_class . "'>";
        } else {
            echo "<div class='col-md-3 col-sm-3 p10-10 mb20'>";
        }
        include ("includes/twitter.htm");
        echo "</div>";

        /* facebook */
        if($articles_count <= 9) {
            echo "<div class='col-md-3 col-sm-3 " . $offset_class . "'>";
        } else {
            echo "<div class='col-md-3 col-sm-3'>";
        }
        include ("includes/facebook.htm");
        echo "</div>";
    ?>
</div>

<div class="doble">
    <div class="calendario mb40">
        <?php include ("includes/published/prox_actividades.htm") ?>
    </div>
</div>
