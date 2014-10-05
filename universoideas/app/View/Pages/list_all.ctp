<link rel="stylesheet" type="text/css" href="/css/jquery.dataTables.css">
<script type="text/javascript" src="/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        $('#table-forums').dataTable({
            "sPaginationType": "full_numbers"
        });
    });
</script>

<input id="page_code" type="hidden" value="foros"/>
<div id="content_col_izq" class="fs11">
    <?php 
        if($has_forum === true) {
            include('includes/published/forums/rios/list_all_table_' . $user['id'] . '.htm' );
        } else {
            echo "<div style='margin-top: 20px;margin-right: 10px;font-size: 12px!important;font-weight: bold;text-align: justify;border: #333 1px solid;padding: 10px;'>";
            echo "<div>No has creado ningún tema en el foro aún. Para crearlo puedes hacerlo haciendo click aquí:</div>";
            echo '<div class="boton fs11 mt20 mb10">';
            echo '<a href="/forums/add" class="mt20" style="cursor: pointer;">Nuevo Tema</a>';
            echo '</div>';
            echo "</div>";
        }
    ?>
</div>

<div id="content_col_der">
    <?php include ("includes/siguenos.htm") ?>
    <div id="publicidadventana5" class="p5 tac"><div class="publicidad tal">ESPACIO PUBLICITARIO</div><a href="#"><img src="/img/publicidad/300x250.gif" width="300" height="250" alt="Publicidad" /></a></div>
    <?php include('includes/published/noticias_destacadas.htm'); ?>
    <?php include ("includes/twitter.htm") ?>
    <?php include ("includes/facebook.htm") ?>
</div>