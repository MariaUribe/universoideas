<input id="page_code" type="hidden" value="emprendedor"/>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-sm-10">
            <h1>Modificar trabajo de emprendimiento</h1>
            <hr>
            
            <?php echo $this->Form->create('Emprendedore', array('class' => 'form-horizontal')); ?>
            <?php 
                echo $this->Form->input('Emprendedore.id');
                echo $this->Form->input('Emprendedore.user_id', array('type' => 'hidden'));
                echo $this->Form->input('Emprendedore.status', array('type' => 'hidden')); 
            ?>
            
            <div class="form-group required">
                <label for="title" class="col-md-3 control-label pt0">Título</label>
                <div class="col-md-9">
                    <?php 
                    echo $this->Form->input('Emprendedore.title', array('label' => false, 'class' => 'form-control', 'type' => 'text', 'required' => 'required'));
                    ?>
                </div>
            </div>
            
            <div class="form-group required">
                <label for="resume" class="col-md-3 control-label pt0">Resumen</label>
                <div class="col-md-9">
                    <?php 
                    echo $this->Form->input('Emprendedore.resume', array('label' => false, 'class' => 'form-control', 'type' => 'textarea', 'rows' => '4', 'required' => 'required'));
                    ?>
                </div>
            </div>
            
            <div class="form-group required">
                <label for="description" class="col-md-3 control-label pt0">Descripción</label>
                <div class="col-md-9">
                    <?php 
                    echo $this->Form->input('Emprendedore.description', array('label' => false, 'class' => 'form-control', 'type' => 'textarea', 'rows' => '14','required' => 'required', 'class' => 'ckeditor'));
                    ?>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-offset-3 col-md-9"></div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-3 col-md-9">
                    <button id="btn-signup" type="submit" class="btn btn-primary"><i class="icon-hand-right"></i>Guardar</button>
                    <button type="button" class="btn btn-danger"><i class="icon-hand-right"></i>Cancelar</button>
                </div>
            </div>
            
            <?php echo $this->Form->end(); ?>
        </div>
        <div class="col-md-4 col-sm-2">
            <?php include ("includes/siguenos.htm") ?>
            <div id="publicidadventana5" class="p5 tac"><div class="publicidad tal">ESPACIO PUBLICITARIO</div><a href="#"><img src="/img/publicidad/300x250.gif" width="300" height="250" alt="Publicidad" /></a></div>
        </div>
    </div>
</div>

<!--div id="content_col_izq">
    <div class="notas"><h2>Editar trabajo de emprendimiento</h2></div>
    <php echo $this->Form->create('Emprendedore'); ?>
        <table width="570" cellspacing="0" cellpadding="5" class="fs12 mt20" style="border:#333 solid 1px;padding-left: 20px;padding-top: 10px;">
            <php
                echo $this->Form->input('Emprendedore.id');
                echo $this->Form->input('Emprendedore.user_id', array('type' => 'hidden'));
                echo $this->Form->input('Emprendedore.status', array('type' => 'hidden'));
                echo "<tr><td colspan='2'></td></tr>";
                echo "<tr><td class='tar vam'>Título:</td><td>" . $this->Form->input('Emprendedore.title', array('label' => FALSE, 'size' => 80, 'maxlength' => 150)) . "</td></tr>";
                echo "<tr><td class='tar vat'>Resumen:</td><td>" . $this->Form->input('Emprendedore.resume', array('label' => FALSE, 'type' => 'textarea', 'cols' => 58, 'rows' => 6, 'maxlength' => 600)) . "</td></tr>";
                echo "<tr><td class='tar vat'>Descripción:</td><td>" . $this->Form->input('Emprendedore.description', array('label' => FALSE, 'type' => 'textarea', 'cols' => 58, 'rows' => 12, 'maxlength' => 1500)) . "</td></tr>";
                echo "<tr><td class='tar vam' colspan='2'><input id='submit-button' type='submit' value='Publicar' style='margin-right: 25px;'/></td></tr>";
                echo "<tr><td colspan='2'>&nbsp;</td></tr>";
            ?>
        </table>
    <php echo $this->Form->end(); ?>
</div>

<div id="content_col_der">
    <php include ("includes/siguenos.htm") ?>
    <div id="publicidadventana5" class="p5 tac"><div class="publicidad tal">ESPACIO PUBLICITARIO</div><a href="#"><img src="/img/publicidad/300x250.gif" width="300" height="250" alt="Publicidad" /></a></div>
</div-->