<input id="page_code" type="hidden" value="foros"/>
<div id="content_col_izq">
    <div class="notas"><h2>Editar Tema</h2></div>
    <?php echo $this->Form->create('Forum'); ?>
    <table width="570" cellspacing="0" cellpadding="5" class="fs12 mt20" style="border:#333 solid 1px;padding-left: 20px;padding-top: 10px;">
        <?php
            echo $this->Form->input('Forum.id');
            echo $this->Form->input('Forum.user_id', array('label' => 'Usuario', 'type' => 'hidden'));
            echo "<tr><td colspan='2'></td></tr>";
            echo "<tr><td class='tac' style='vertical-align: middle;'>Asunto:</td><td>" . $this->Form->input('Forum.title', array('label' => FALSE, 'size' => 50, 'maxlength' => 100)) . "</td></tr>";
            echo "<tr><td>&nbsp;</td><td>" . $this->Form->input('Forum.content', array('label' => FALSE, 'type' => 'textarea', 'cols' => 58, 'rows' => 12, 'maxlength' => 1500)) . "</td></tr>";
            echo "<tr><td>&nbsp;</td><td>" . $this->Form->input('Forum.enabled', array('label' => 'Habilitado')) . "</td></tr>";
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