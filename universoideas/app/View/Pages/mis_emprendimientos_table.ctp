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

<div class="notas"><h2>Mis publicaciones de emprendimiento</h2></div>

<div class="boton fs11 mt20 mb20">
    <a href="/emprendedores/add" class="mt20" style="cursor: pointer;">Nuevo Emprendimiento</a>
</div>
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
                if($emprendedor['User']['twitter'])
                    $twitter = " » " . "@" . $emprendedor['User']['twitter'];
                
                $status = "";
                
                if ($emprendedor['Emprendedore']['status'] === "PA")
                    $status = "Por Aprobar";
                else if ($emprendedor['Emprendedore']['status'] === "AP")
                    $status = "Aprobado";
                else
                    $status = "Rechazado";
                
                echo "<tr>";
                echo "<td>";
                
                echo "<div class='notas box' style='padding: 0px;'>";
                echo "<div style='font-size: 12px!important;color: #666;'><label>Estatus de publicación: <strong>" . $status . "</strong></label></div>";
                echo "<br><a href='/emprendedores/edit_emprendimiento/" . $emprendedor['Emprendedore']['id']."' style='font-weight: bold; text-decoration: underline;'>Editar</a>";
                echo "<h2 style='background-color: white;'><a style='color: #00355a;' href='/emprendedores/view/" . $emprendedor['Emprendedore']['id'] . "'>" . $emprendedor['Emprendedore']['title'] . "</a></h2>";
                echo "<div class='dia'>" . __($dia_sem) . " " . __($mes) . " " . __($dia) . ", " . __($ano) . " " . __($hora) ."</div>";
                echo "<div syle='font-size: 10px!important; margin-bottom: 3px; margin-top: 3px;'>Creado por: " . $emprendedor['User']['username'] . $twitter . "</div>";
                
                echo "<div>";
                echo $emprendedor['Emprendedore']['resume'];
                echo "<div><a href='/emprendedores/view/" . $emprendedor['Emprendedore']['id'] . "' class='sleyendo'>Seguir Leyendo &raquo;</a></div>";
                echo "</div>";
                
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
<div class="boton fs11 mt35">
    <a href="/emprendedores/add" class="mt20" style="cursor: pointer;">Nuevo Emprendimiento</a>
</div>

<div class="box mt15">&nbsp;</div>

<div class="doble">

</div>