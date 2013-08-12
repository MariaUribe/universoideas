<input id="page_code" type="hidden" value="foros"/>
<div id="content_col_izq">
    <div class="notas"><h2>Publicar comentario</h2></div>
    <?php echo $this->Form->create('Comment'); ?>
        <table width="570" cellspacing="0" cellpadding="5" class="fs12 mt15 p10" style="border:#333 solid 1px">
            <?php
                echo "<tr><td colspan='2'></td></tr>";
                echo "<tr><td>Comentario:</td><td>" . $this->Form->input('Comment.description', array('label' => FALSE, 'type' => 'textarea', 'cols' => 58, 'rows' => 12, 'maxlength' => 1500)) . "</td></tr>";
                echo "<tr><td>&nbsp;</td><td><input id='submit-button' type='submit' value='Guardar'/></td></tr>";
                echo "<tr><td colspan='2'>&nbsp;</td></tr>";
            ?>
        </table>
    <?php echo $this->Form->end(); ?>
</div>

<div id="content_col_der">
    <?php include ("includes/siguenos.htm") ?>
    <div id="publicidadventana5" class="p5 tac"><div class="publicidad tal">ESPACIO PUBLICITARIO</div><a href="#"><img src="/universoideas/img/publicidad/300x250.gif" width="300" height="250" alt="Publicidad" /></a></div>
</div>