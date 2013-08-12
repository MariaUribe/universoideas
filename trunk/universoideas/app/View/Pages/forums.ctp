<input id="page_code" type="hidden" value="foros"/>
<div id="content_col_izq">
    <div class="notas"><h2>Temas</h2></div>
    
    <div class="boton fs11 mt20">
        <a href="/universoideas/forums/add" class="mt20" style="cursor: pointer;">Nuevo Tema</a>
    </div>
    <table width="570" cellspacing="0" cellpadding="5" class="fs10 mt15" style="border:#333 solid 1px">
        <tr class="bg00355a colorfff">
            <td width="300">TEMAS</td>
            <td width="100" style='text-align: center'>RESPUESTAS</td>
            <td width="100">ÚLTIMO MENSAJE</td>
        </tr>
    
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

                echo "<td><a href='/universoideas/forums/view/" . $forum['Forum']['id']."' style='font-weight: bold'>" . $forum['Forum']['title'] . "</a> <br> Creado por: " . $forum['User']['username'] . " » " . __($dia_sem) . " " . __($mes) . " " . __($dia) . ", " . __($ano) .  " " . $hora  . "</td>";
                echo "<td class='tac'>" . $forum['Forum']['count'] . "</td>";
                
                if($date_comment !== "")
                    echo "<td>" . __($dia_sem_com) . " " . __($mes_com) . " " . __($dia_com) . ", " . __($ano_com) . " " . $hora_com  . "</td>";
                else
                    echo "<td>--</td>";
                echo "</tr>";
                $cont ++;
            }
        ?>
    </table>
    <div class="boton fs11 mt15">
        <a href="/universoideas/forums/add" class="mt20" style="cursor: pointer;">Nuevo Tema</a>
    </div>
    
    <div class="box mt15">&nbsp;</div>

    <div class="doble">
        
    </div>
</div>

<div id="content_col_der">
    <?php include ("includes/siguenos.htm") ?>
    <div id="publicidadventana5" class="p5 tac"><div class="publicidad tal">ESPACIO PUBLICITARIO</div><a href="#"><img src="/universoideas/img/publicidad/300x250.gif" width="300" height="250" alt="Publicidad" /></a></div>
    <?php include('noticias_destacadas.ctp'); ?>
    <?php include ("includes/twitter.htm") ?>
    <?php include ("includes/facebook.htm") ?>
</div>