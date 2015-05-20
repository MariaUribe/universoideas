<input id="page_code" type="hidden" value="emprendedores"/>
<link rel="stylesheet" type="text/css" href="/css/jquery.dataTables.css">
<script type="text/javascript" src="/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        $('#table-forums').dataTable({
            "sPaginationType": "full_numbers"
        });
    });
</script>

<input id="page_code" type="hidden" value="emprendedor"/>
<div id="content_col_izq" class="fs11">
    <?php include('includes/published/emprendedores_table.htm'); ?>
</div>

<div id="content_col_der">
    <?php include ("includes/siguenos.htm") ?>
    <div id="publicidadventana5" class="p5 tac"><div class="publicidad tal">ESPACIO PUBLICITARIO</div><a href="#"><img src="/img/publicidad/300x250.gif" width="300" height="250" alt="Publicidad" /></a></div>
    <?php include('includes/published/noticias_destacadas.htm'); ?>
    <?php include ("includes/twitter.htm") ?>
    <?php include ("includes/facebook.htm") ?>
</div>