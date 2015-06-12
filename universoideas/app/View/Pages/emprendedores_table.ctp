<div class="table-responsive">
    <table id="table-forums" width="100%" class="table table-hover">
        <thead style="display: none">
            <tr class="bg00355a colorfff vam h30">
                <th>PUBLICACIONES</th>
            </tr>
        </thead>
        <tbody>
            <?php 

                foreach ($emprendedores as $emprendedor) {
                    $date = $this->Time->format('D-F-j-Y-h:i A', $emprendedor['Emprendedore']['modified']);
                    list($dia_sem, $mes, $dia, $ano, $hora) = explode('-', $date);
                    $twitter = "";
                    if($emprendedor['User']['twitter']) {
                        $twitter = " » Twitter: " . $emprendedor['User']['twitter'];
                    }
                    echo "<tr>";
                    echo "<td>";

                    echo "<h3><a href='/emprendedores/view/" . $emprendedor['Emprendedore']['id'] . "'>" . $emprendedor['Emprendedore']['title'] . "</a></h3>";
                    echo "<p><span class='glyphicon glyphicon-time'></span> Publicado el " . __($dia_sem) . ", " . __($dia) . " de " . __($mes) . " de " . __($ano) .  " " . $hora . "</p>";
                    echo "<p><span class='glyphicon glyphicon-user'></span> Creado por: " . $emprendedor['User']['username'] . $twitter . "</p>";

                    echo "<div>";
                    echo $emprendedor['Emprendedore']['resume'];
                    echo "<div><a href='/emprendedores/view/" . $emprendedor['Emprendedore']['id'] . "' class='sleyendo'>Seguir Leyendo &raquo;</a></div>";
                    echo "</div>";

                    echo "</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
        <tfoot style="display: none">
            <tr class="bg00355a colorfff vam h30">
                <th>PUBLICACIONES</th>
            </tr>
        </tfoot>
    </table>
</div>

<div class="box mt15" style="clear: both">&nbsp;</div>
