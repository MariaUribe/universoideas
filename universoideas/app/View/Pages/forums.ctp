<input id="page_code" type="hidden" value="foros"/>
<div id="content_col_izq">
    <div class="notas"><h2>Temas</h2></div>
    
    <div class="boton fs11 mt20">
        <a href="/universoideas/forums/add" class="mt20" style="cursor: pointer;">Nuevo Tema</a>
    </div>
    <table width="570" cellspacing="0" cellpadding="5" class="fs10 mt15" style="border:#333 solid 1px">
        <tr class="bg00355a colorfff">
            <td width="300">Title</td>
            <td width="100">Content</td>
            <td width="100">Modified</td>
        </tr>
    
        <?php 
            $cont = 0;
            //  setlocale(LC_ALL, 'es_ES');
            //  setlocale(LC_MESSAGES, 'es_ES.utf8'); 
        
            foreach ($forums as $forum) {
                if (($cont % 2) == 0)
                    echo "<tr>";
                if (($cont % 2) == 1)
                    echo "<tr class='bgbebe'>";

                echo "<td><a href='#'>" . $forum['Forum']['title'] . "</a> <br> por: " . $forum['User']['username'] . " - " . $this->Time->format('D F jS, Y', $forum['Forum']['modified']) . "</td>";
                echo "<td>" . $forum['Forum']['content'] . "</td>";
                echo "<td>" . $this->Time->format('D F jS, Y', $forum['Forum']['modified']) . "</td>";
                echo "</tr>";
                $cont ++;
            }
        ?>
    </table>
    <div class="boton fs11 mt15">
        <a onclick="" class="mt20" style="cursor: pointer;">Nuevo Tema</a>
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