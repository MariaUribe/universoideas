<input id="page_code" type="hidden" value="calendario"/>

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
                <th>Evento</th>
                <th>Lugar</th>
                <th width="17%">Fecha</th>
                <th width="11%">Hora</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach ($events as $event) {
                    $date = $this->Time->format('D-F-j-Y-h:i A', $event['Event']['event_date']);
                    list($dia_sem, $mes, $dia, $ano) = explode('-', $date);
                    
                    echo "<tr>";
                    echo "<td><a href='/pages/event?id=" . $event['Event']['id'] . "'>" . $event['Event']['name'] . "</a></td>";
                    echo "<td>" . $event['Event']['place'] . "</td>";
                    echo "<td>" . __($dia_sem) . " " . __($mes) . " " . __($dia) . ", " . __($ano) . "</td>";
                    echo "<td>" . $event['Event']['init_time'] . " <br/> a <br/>" . $event['Event']['end_time'] . "</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</div>
