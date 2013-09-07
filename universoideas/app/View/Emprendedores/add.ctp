<input id="page_code" type="hidden" value="emprendedor"/>
<div id="content_col_izq">
    <div class="notas"><h2>Publicar trabajo de emprendimiento</h2></div>
    <?php echo $this->Form->create('Emprendedore'); ?>
        <table width="570" cellspacing="0" cellpadding="5" class="fs12 mt20" style="border:#333 solid 1px;padding-left: 20px;padding-top: 10px;">
            <?php
                echo "<tr><td colspan='2'></td></tr>";
                echo "<tr><td class='tar vam'>Título:</td><td>" . $this->Form->input('Emprendedore.title', array('label' => FALSE, 'size' => 80, 'maxlength' => 100)) . "</td></tr>";
                echo "<tr><td class='tar vat'>Resumen:</td><td>" . $this->Form->input('Emprendedore.resume', array('label' => FALSE, 'type' => 'textarea', 'cols' => 58, 'rows' => 6, 'maxlength' => 600)) . "</td></tr>";
                echo "<tr><td class='tar vat'>Descripción:</td><td>" . $this->Form->input('Emprendedore.description', array('label' => FALSE, 'type' => 'textarea', 'cols' => 58, 'rows' => 12, 'maxlength' => 1500)) . "</td></tr>";
                echo "<tr><td class='tar vam' colspan='2'><input id='submit-button' type='submit' value='Publicar' style='margin-right: 25px;'/></td></tr>";
                echo "<tr><td colspan='2'>&nbsp;</td></tr>";
            ?>
        </table>
    <?php echo $this->Form->end(); ?>
</div>

<div id="content_col_der">
    <?php include ("includes/siguenos.htm") ?>
    <div id="publicidadventana5" class="p5 tac"><div class="publicidad tal">ESPACIO PUBLICITARIO</div><a href="#"><img src="/universoideas/img/publicidad/300x250.gif" width="300" height="250" alt="Publicidad" /></a></div>
</div>