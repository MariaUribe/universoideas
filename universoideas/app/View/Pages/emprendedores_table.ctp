<style type="text/css">
    table.dataTable td {
        padding: 0px;
    }
    
    table.dataTable tr.even {
        background-color: white;
    }
    
    table.dataTable tr.even td.sorting_1 {
        background-color: white;
    }
</style>

<div class="notas" style="margin-bottom: 20px;"><h2>Publicaciones de emprendimiento</h2></div>

<!--<div class="boton fs11 mt20 mb20">
    <a href="/emprendedores/add" class="mt20" style="cursor: pointer;">Nuevo Emprendimiento</a>
</div>-->
<table id="table-forums" width="570" cellspacing="0" cellpadding="5" class="display fs11 mt15 mb5" style="padding-top: 10px; padding-bottom: 10px;">
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
                    $twitter = " » " . "@" . $emprendedor['User']['twitter'];
                }
                echo "<tr>";
                echo "<td>";
                
                echo "<div class='notas box' style='padding: 0px;'>";
                echo "<h2 style='background-color: white;'><a style='color: #00355a;' href='/emprendedores/view/" . $emprendedor['Emprendedore']['id'] . "'>" . $emprendedor['Emprendedore']['title'] . "</a></h2>";
                echo "<div class='dia'>" . __($dia_sem) . " " . __($mes) . " " . __($dia) . ", " . __($ano) . " " . __($hora) . "</div>";
                echo "Creado por: " . $emprendedor['User']['username'] . $twitter;
                
                echo "<div>";
                echo $emprendedor['Emprendedore']['resume'];
                echo "<div><a href='/emprendedores/view/" . $emprendedor['Emprendedore']['id'] . "' class='sleyendo'>Seguir Leyendo &raquo;</a></div>";
                echo "</div>";
                
                echo "</div>";
                echo "</td>";
//                echo "<td><a href='/emprendedores/view/" . $emprendedor['Emprendedore']['id']."' style='font-weight: bold; font-size: 12px'>" . $emprendedor['Emprendedore']['title'] . "</a> <br> Creado por: " . $emprendedor['User']['username'] . " » " . __($dia_sem) . " " . __($mes) . " " . __($dia) . ", " . __($ano) .  " " . $hora  . "</td>";
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
<!--<div class="boton fs11 mt35">
    <a href="/emprendedores/add" class="mt20" style="cursor: pointer;">Nuevo Emprendimiento</a>
</div>-->

<div class="box mt15" style="clear: both">&nbsp;</div>

<div class="doble">
</div>