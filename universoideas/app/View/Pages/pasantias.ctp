<input id="page_code" type="hidden" value="pasantias"/>

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css">
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/1.0.6/css/dataTables.responsive.css">
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

<div class="table-responsive">
    <table id="table-forums" width="100%" class="table table-striped table-hover dt-responsive dataTable">
        <thead>
            <tr>
                <th>Empresa</th>
                <th>Cargo / Funciones</th>
                <th>Duración</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach ($enterprises as $enterprise) {
                    echo "<tr>";
                    echo "<input id='article_id' type='hidden' value='" . $enterprise['Enterprise']['id'] . "'/>";
                    echo "<td>" . $enterprise['Enterprise']['enterprise'] . "<br/>";
                    echo "<a href=''>" . $enterprise['Enterprise']['email'] . "</a>";
                    echo "</td>";
                    echo "<td>" . $enterprise['Enterprise']['description'] . "</td>";
                    echo "<td>" . $enterprise['Enterprise']['duration'] . "</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</div>