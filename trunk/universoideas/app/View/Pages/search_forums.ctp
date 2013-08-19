<link rel="stylesheet" type="text/css" href="/universoideas/css/jquery.dataTables.css">
<script type="text/javascript" src="/universoideas/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        $('#table-forums').dataTable({
            "sPaginationType": "full_numbers"
        });
    });
</script>
<style type="text/css">
    td {
        background-color: white!important;
    }
</style>

<input id="page_code" type="hidden" value="index"/>
<div id="content_col_izq">
    <div class="rio">
        <?php echo "<h2>Resultados de búsqueda para: \"" . $text . "\"</h2>"?>
        <div class="notas">
            <table id="table-forums" width="570" cellspacing="0" cellpadding="5" class="display fs10 mt15 mb5" style="border:#333 solid 1px">
                <thead>
                    <tr class="bg00355a colorfff vam h30">
                        <th width="280">Temas del foro</th>
                    </tr>
                </thead>
                <tbody>

                <?php 
                    foreach ($forums as $forum) { 
                        $date = $this->Time->format('D-F-j-Y-h:i A', $forum['forum']['modified']);
                        list($dia_sem, $mes, $dia, $ano, $hora) = explode('-', $date);
                        
                        echo "<tr>";
                        echo "<td>";
                        
                        echo "<div class='box oh'>";
                        echo "<input id='forum_id' type='hidden' value='" . $forum['forum']['id'] . "'/>";
                        echo "<a href='/universoideas/forums/view/" . $forum['forum']['id'] . "'><strong>" . $forum['forum']['title'] . "</strong></a>";
                        echo "<div class='fs11'> Creado por: " . $forum['user']['username'] . " » " . __($dia_sem) . " " . __($mes) . " " . __($dia) . ", " . __($ano) .  " " . $hora  . "</div>";
                        echo "<div class='mt10'>";
                        echo $forum['forum']['content'];
                        echo "<div><a href='/universoideas/forums/view/" . $forum['forum']['id'] . "' class='sleyendo'>Ir al detalle &raquo;</a></div>";
                        echo "</div>";
                        echo "</div>";
                        
                        echo "</td>";
                        echo "</tr>";
                    }
                ?>
                    </tbody>
                <tfoot>
                    <tr class="bg00355a colorfff vam h30">
                        <th>Temas del foro</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<div id="content_col_der">
    <?php include ("includes/siguenos.htm") ?>
    <div id="publicidadventana2" class="p5 tac"><div class="publicidad tal">ESPACIO PUBLICITARIO</div><a href="#"><img src="/universoideas/img/publicidad/300x250.gif" width="300" height="250" alt="Publicidad" /></a></div>
    <?php include('noticias_destacadas.ctp'); ?>
</div>
