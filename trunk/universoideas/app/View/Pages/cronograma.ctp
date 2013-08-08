<div id="content_col_izq">
    <div class="rio">
        <div class="notas"><h2>Cronograma de Eventos</h2></div>
        <table width="620" cellspacing="0" cellpadding="5" class="fs10 mt15" style="border:#333 solid 1px">
            <tr class="bg00355a colorfff">
                <td width="300">Evento</td>
                <td width="150">Lugar</td>
                <td width="85">Fecha</td>
                <td width="85">Hora</td>
            </tr>
            
            <?php 
                $cont = 0;
                foreach ($events as $event) {
                    if (($cont % 2) == 0)
                        echo "<tr>";
                    if (($cont % 2) == 1)
                        echo "<tr class='bgbebe'>";
                    
                    echo "<td><a href='#'>" . $event['Event']['name'] . "</a></td>";
                    echo "<td>" . $event['Event']['place'] . "</td>";
                    echo "<td>" . $event['Event']['event_date'] . "</td>";
                    echo "<td>" . $event['Event']['init_time'] . " <br/> a <br/>" . $event['Event']['end_time'] . "</td>";
                    echo "</tr>";
                    $cont ++;
                }
            ?>
        </table>
    </div>
</div>

<div id="content_col_der">
    <?php include ("includes/siguenos.htm") ?>
    <?php include('noticias_destacadas.ctp'); ?>
<!--    <php include ("includes/twitter.htm") ?>
    <php include ("includes/facebook.htm") ?>-->
</div>