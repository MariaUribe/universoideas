<input id="page_code" type="hidden" value="foros"/>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-sm-10">
            <h1>Publicar nuevo tema en el foro</h1>
            <hr>
            
            <?php echo $this->Form->create('Forum', array('class' => 'form-horizontal')); ?>
            
            <div class="form-group required">
                <label for="title" class="col-md-3 control-label pt0">Asunto</label>
                <div class="col-md-9">
                    <?php 
                    echo $this->Form->input('Forum.title', array('label' => false, 'class' => 'form-control', 'type' => 'text', 'required' => 'required', 'maxlength' => 100))
                    ?>
                </div>
            </div>
            
            <div class="form-group required">
                <label for="description" class="col-md-3 control-label pt0">Contenido</label>
                <div class="col-md-9">
                    <?php 
                    echo $this->Form->input('Forum.content', array('label' => false, 'type' => 'textarea', 'class' => 'form-control', 'type' => 'textarea', 'rows' => '18','required' => 'required', 'class' => 'ckeditor', 'maxlength' => 1500));
                    ?>
                </div>
            </div>
            
            <?php 
                echo $this->Form->input('Forum.enabled', array('type' => 'hidden', 'vale' => 1));
            ?>
            
            <div class="form-group">
                <div class="col-md-offset-3 col-md-9"></div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-3 col-md-9">
                    <button id="btn-signup" type="submit" class="btn btn-primary"><i class="icon-hand-right"></i>Publicar</button>
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