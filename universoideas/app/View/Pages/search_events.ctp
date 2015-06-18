<input id="page_code" type="hidden" value="index"/>

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
        <div style="margin-bottom: 20px;">
            <?php echo "<h2>Resultados de búsqueda para: \"" . $text . "\"</h2>"?>
        </div>
        <hr>
        <div class="table-responsive">
            <table id="table-forums" width="100%" class="table table-hover">
                <thead style="display: none">
                    <tr>
                        <th>Eventos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach ($events as $event) {
                        $date = $this->Time->format('D-F-j-Y-h:i A', $event['event']['modified']);
                        list($dia_sem, $mes, $dia, $ano, $hora) = explode('-', $date);
                        echo "<tr>";
                        echo "<td>";
                        
                        echo "<input id='event_id' type='hidden' value='" . $event['event']['id'] . "'/>";
                        echo "<h3><a href='/pages/event?id=" . $event['event']['id'] . "'>" . $event['event']['name'] . "</a></h3>";
                        echo "<p><span class='glyphicon glyphicon-time'></span> Publicado el " . __($dia_sem) . ", " . __($dia) . " de " . __($mes) . " de " . __($ano) .  " " . $hora . "</p>";
                        
                        echo "<div>";
                        echo $event['event']['description'];
                        echo "<div><a href='/pages/event?id=" . $event['event']['id'] . "' class='sleyendo'>Ir al detalle &raquo;</a></div>";
                        echo "</div>";
                        
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-3 col-sm-3">
        <?php include ("includes/siguenos.htm") ?>
        <?php include ("includes/published/join.htm") ?>
        <?php include('includes/published/noticias_destacadas.htm'); ?>
        <?php include ("includes/twitter.htm") ?>
        <?php include ("includes/facebook.htm") ?>
    </div>
</div>
