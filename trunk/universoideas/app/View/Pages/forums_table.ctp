<div class="notas"><h2>Temas</h2></div>

<div class="boton fs13 mt20 mb20">
    <a href="/forums/add" class="mt20" style="cursor: pointer;">Nuevo Tema</a>
</div>
<table id="table-forums" width="570" cellspacing="0" cellpadding="5" class="display fs11 mt15 mb5" style="border:#333 solid 1px">
    <thead>
        <tr class="bg00355a colorfff vam h30">
            <th width="280">TEMAS</th>
            <th width="100" style='text-align: center'>RESPUESTAS</th>
            <th width="120">ÚLTIMO MENSAJE</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $cont = 0;

            foreach ($forums as $forum) {
                $date_comment = "";
                $date = $this->Time->format('D-F-j-Y-h:i A', $forum['Forum']['modified']);
                list($dia_sem, $mes, $dia, $ano, $hora) = explode('-', $date);
                if(!empty($forum['Forum']['max_comment'])) {
                    $date_comment = $this->Time->format('D-F-j-Y-h:i A', $forum['Forum']['max_comment']);
                    list($dia_sem_com, $mes_com, $dia_com, $ano_com, $hora_com) = explode('-', $date_comment);
                }

                if (($cont % 2) == 0)
                    echo "<tr>";
                if (($cont % 2) == 1)
                    echo "<tr class='bgbebe'>";

                echo "<td><a href='/forums/view/" . $forum['Forum']['id']."' style='font-weight: bold; font-size: 12px'>" . $forum['Forum']['title'] . "</a> <br> Creado por: " . $forum['User']['username'] . " » " . __($dia_sem) . " " . __($mes) . " " . __($dia) . ", " . __($ano) .  " " . $hora  . "</td>";
                echo "<td class='tac'>" . $forum['Forum']['count'] . "</td>";

                if($date_comment !== "")
                    echo "<td>" . __($dia_sem_com) . " " . __($mes_com) . " " . __($dia_com) . ", " . __($ano_com) . " " . $hora_com  . "</td>";
                else
                    echo "<td>--</td>";
                echo "</tr>";
                $cont ++;
            }
        ?>
    </tbody>
    <tfoot>
        <tr class="bg00355a colorfff vam h30">
            <th>TEMAS</th>
            <th style='text-align: center'>RESPUESTAS</th>
            <th>ÚLTIMO MENSAJE</th>
        </tr>
    </tfoot>
</table>
<div class="boton fs13 mt35">
    <a href="/forums/add" class="mt20" style="cursor: pointer;">Nuevo Tema</a>
</div>

<div class="box mt15">&nbsp;</div>

<div class="doble">

</div>