<div class="rio">
    <div class="notas"><h2>Calendario de Eventos</h2></div>
    <table width="570" cellspacing="0" cellpadding="5" class="fs13 mt15" style="border:#333 solid 1px">
        <tr class="bg00355a colorfff">
            <td width="300">Evento</td>
            <td width="100">Lugar</td>
            <td width="85">Fecha</td>
            <td width="85">Hora</td>
        </tr>

        <?php 
            $cont = 0;
            foreach ($events as $event) {
                $date = $this->Time->format('D-F-j-Y-h:i A', $event['Event']['event_date']);
                list($dia_sem, $mes, $dia, $ano) = explode('-', $date);
                if (($cont % 2) == 0)
                    echo "<tr>";
                if (($cont % 2) == 1)
                    echo "<tr class='bgbebe'>";

                echo "<td><a href='/pages/event?id=" . $event['Event']['id'] . "'>" . $event['Event']['name'] . "</a></td>";
                echo "<td>" . $event['Event']['place'] . "</td>";
                echo "<td>" . __($dia_sem) . " " . __($mes) . " " . __($dia) . ", " . __($ano) . "</td>";
                echo "<td>" . $event['Event']['init_time'] . " <br/> a <br/>" . $event['Event']['end_time'] . "</td>";
                echo "</tr>";
                $cont ++;
            }
        ?>
    </table>
</div>