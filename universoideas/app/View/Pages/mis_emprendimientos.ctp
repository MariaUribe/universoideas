<link rel="stylesheet" type="text/css" href="/universoideas/css/jquery.dataTables.css">
<script type="text/javascript" src="/universoideas/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        $('#table-forums').dataTable({
            "sPaginationType": "full_numbers"
        });
    });
</script>

<input id="page_code" type="hidden" value="emprendedor"/>
<div id="content_col_izq" class="fs11">
    <?php 
        if($has_emp === true)
            include('includes/published/emprendedores/rios/mis_emprendimientos_table_' . $user['id'] . '.htm'); 
        else {
            echo "<div style='margin-top: 20px;margin-right: 10px;font-size: 12px!important;font-weight: bold;text-align: justify;border: #333 1px solid;padding: 10px;'>";
            echo "<div>En esta sección puedes ingresar información acerca de trabajos de emprendimientos que estés llevando a cabo actualmente, las empresas que ingresen al site podrán visualizarlas y contactarse contigo.</div><br>";
            echo "<div>No has creado ningún trabajo de emprendimiento aún. Para crearlo puedes hacerlo haciendo click aquí:</div>";
            echo '<div class="boton fs11 mt20 mb10">';
            echo '<a href="/emprendedores/add" class="mt20" style="cursor: pointer;">Nuevo Emprendimiento</a>';
            echo '</div>';
            echo "</div>";
        }
    ?>
</div>

<div id="content_col_der">
    <?php include ("includes/siguenos.htm") ?>
    <div id="publicidadventana5" class="p5 tac"><div class="publicidad tal">ESPACIO PUBLICITARIO</div><a href="#"><img src="/universoideas/img/publicidad/300x250.gif" width="300" height="250" alt="Publicidad" /></a></div>
    <?php include('includes/published/noticias_destacadas.htm'); ?>
    <?php include ("includes/twitter.htm") ?>
    <?php include ("includes/facebook.htm") ?>
</div>