<div class="table-responsive">
    <table id="table-forums" width="100%" class="table table-striped table-hover dt-responsive dataTable">
        <thead>
            <tr>
                <th>Temas</th>
                <th>Respuestas</th>
                <th>Último Mensaje</th>
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
                    
                    echo "<tr>";
                    
                    echo "<td>";
                    echo "<h5><a href='/forums/view/" . $forum['Forum']['id']."' style='font-weight: bold;'>" . $forum['Forum']['title'] . "</a></h5>";
                    echo "<p><span class='glyphicon glyphicon-time'></span> Publicado el " . __($dia_sem) . ", " . __($dia) . " de " . __($mes) . " de " . __($ano) .  " " . $hora . "</p>";
                    echo "<p><span class='glyphicon glyphicon-user'></span> Creado por: " . $forum['User']['username'] . "</p>";
                    echo "</td>";
                    
                    echo "<td class='tac'>" . $forum['Forum']['count'] . "</td>";

                    if($date_comment !== "") {
                        echo "<td>" . __($dia_sem_com) . " " . __($mes_com) . " " . __($dia_com) . ", " . __($ano_com) . " " . $hora_com  . "</td>";
                    } else {
                        echo "<td>--</td>";
                    }
                    
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</div>

<hr>

<div class="boton fs13 mt20 mb20">
    <a href="/forums/add" class="mt20" style="cursor: pointer;"><img src="/img/notification_add.png" alt="Crear Tema"></a>
    <a href="/forums/add" class="mt20" style="cursor: pointer;">Nuevo Tema</a>
</div>

<div class="box mt15">&nbsp;</div>

