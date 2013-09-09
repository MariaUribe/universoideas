<div class="rio">
    <div class="notas"><h2>Empresas buscando pasantes</h2></div>
    <table width="100%" cellspacing="0" cellpadding="5" class="fs10 mt15" style="border:#333 solid 1px">
        <tr class="bg00355a colorfff">
            <td width="150">Empresa</td>
            <td width="200">Cargo-Funciones</td>
            <td width="120">Duración</td>
        </tr>
        
        <?php 
            $cont = 0;
            foreach ($enterprises as $enterprise) {
                if (($cont % 2) == 0)
                    echo "<tr>";
                if (($cont % 2) == 1)
                    echo "<tr class='bgbebe'>";
                    
                echo "<input id='article_id' type='hidden' value='" . $enterprise['Enterprise']['id'] . "'/>";
                echo "<td>" . $enterprise['Enterprise']['enterprise'] . "<br/>";
                echo "<a href=''>" . $enterprise['Enterprise']['email'] . "</a>";
                echo "</td>";
                echo "<td>" . $enterprise['Enterprise']['description'] . "</td>";
                echo "<td>" . $enterprise['Enterprise']['duration'] . "</td>";
                echo "</tr>";
                $cont ++;
            }
        ?>
    </table>
</div>