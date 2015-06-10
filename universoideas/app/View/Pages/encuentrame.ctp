<input id="page_code" type="hidden" value="encuentrame"/>

<div class="row">
    <div class="col-md-12">
        <h4 class="page-head-line channel_name">Encuéntrame</h4>
    </div>
</div>

<div class="row">
    <div class="col-md-9 col-sm-9">
        <?php include ("includes/published/galleries/galeria-encuentrame.htm") ?>
    </div>
    <div class="col-md-3 col-sm-3">
        <?php include ("includes/siguenos.htm") ?>
        <?php include ("includes/published/join.htm") ?>
    </div>
</div>

<div class="row mt15">
    <div class='col-md-9 col-sm-9 p0-10'>
        <?php include('includes/published/rios/rio-encuentrame.htm'); ?>
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

<!--div id="content_col_izq">
    <php include ("includes/published/galleries/galeria-encuentrame.htm") ?>
 
    <div id="publicidadrio1" class="p5 tac mt20"><div class="publicidad tal">ESPACIO PUBLICITARIO</div><a href="#"><img src="/img/publicidad/500x90.gif" width="500" height="90" alt="Publicidad" /></a></div>

    <php include('includes/published/rios/rio-encuentrame.htm'); ?>
    <div class="doble">
        <div class="calendario mb40">
            <php include ("includes/published/prox_actividades.htm") ?>
        </div>
    </div>
</div>

<div id="content_col_der">
    <php include ("includes/siguenos.htm") ?>
    <div class="cursos mt10 mb10">
        <php include ("includes/published/talleres_cursos.htm") ?>
    </div>
    <div id="publicidadventana1" class="p5 tac"><div class="publicidad tal">ESPACIO PUBLICITARIO</div><a href="#"><img src="/img/publicidad/300x250.gif" width="300" height="250" alt="Publicidad" /></a></div>
    <php include('includes/published/noticias_destacadas.htm'); ?>
    <php include ("includes/twitter.htm") ?>
    <php include ("includes/facebook.htm") ?>
    <div id="publicidadrcielo1" class="mt10 p5 tac"><div class="publicidad tal">ESPACIO PUBLICITARIO</div><a href="#"><img src="/img/publicidad/300x600.gif" width="250" alt="Publicidad" /></a></div>
</div-->