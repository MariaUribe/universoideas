<input id="page_code" type="hidden" value="emprendedores"/>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css">
<script type="text/javascript" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/responsive/1.0.6/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        $('#table-forums').dataTable({
            "sPaginationType": "full_numbers",
            "language": {
                "lengthMenu": "Mostrando _MENU_ registros por página",
                "zeroRecords": "No se encontraron registros",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "No se encontraron registros",
                "infoFiltered": "(filtrados de _MAX_ registros en total)",
                "search": "Buscar:",
                "paginate": {
                    "first": "Primera",
                    "last": "Última",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });
    });
</script>

<div class="row">
    <div class="col-md-9 col-sm-9">
        <div style="margin-bottom: 20px;"><h2>Mis publicaciones de emprendimiento</h2></div>
        <hr>
        
        <div class="boton fs13 mt20 mb20">
            <a href="/emprendedores/add" class="mt20" style="cursor: pointer;"><img src="/img/notification_add.png" alt="Crear Emprendimiento"></a>
            <a href="/emprendedores/add" class="mt20" style="cursor: pointer;">Nuevo Emprendimiento</a>
        </div>

        <?php 
            if($has_emp === true) {
                include('includes/published/emprendedores/rios/mis_emprendimientos_table_' . $user['id'] . '.htm'); 
            } else {
                echo "<div style='margin-top: 20px;margin-right: 10px;font-size: 12px!important;font-weight: bold;text-align: justify;border: #333 1px solid;padding: 10px;'>";
                echo "<div>En esta sección puedes ingresar información acerca de trabajos de emprendimientos que estés llevando a cabo actualmente, las empresas que ingresen al site podrán visualizarlas y contactarse contigo.</div><br>";
                echo "<div>No has creado ningún trabajo de emprendimiento aún. Para crearlo puedes hacerlo haciendo click aquí:</div>";
                
                echo '<hr>';
                echo '<div class="boton fs11 mt20 mb10">';
                echo '<a href="/emprendedores/add" class="mt20" style="cursor: pointer;">Nuevo Emprendimiento</a>';
                echo '</div>';
                echo "</div>";
            }
        ?>
    </div>
    <div class="col-md-3 col-sm-3">
        <?php include ("includes/siguenos.htm") ?>
        <?php include ("includes/published/join.htm") ?>
        <?php include('includes/published/noticias_destacadas.htm'); ?>
        <?php include ("includes/twitter.htm") ?>
        <?php include ("includes/facebook.htm") ?>
    </div>
</div>
