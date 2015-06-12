<input id="page_code" type="hidden" value="foros"/>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-sm-10">
            <h1><span class="glyphicon glyphicon-comment"></span> Publicar comentario</h1>
            <hr>
            
            <?php echo $this->Form->create('Comment', array('class' => 'form-horizontal')); ?>
            
            <div class="form-group required">
                <div class="col-md-12">
                    <?php 
                    echo $this->Form->input('Comment.description', array('label' => false, 'type' => 'textarea', 'class' => 'form-control', 'type' => 'textarea', 'rows' => '18','required' => 'required', 'class' => 'ckeditor', 'maxlength' => 1500));
                    ?>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-12"></div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
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
