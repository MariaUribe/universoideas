<div class="articles border">
<?php echo $this->Form->create('Article', array('enctype' => 'multipart/form-data')); ?>
    <fieldset>
        <legend><?php echo __('Crear Artículo'); ?></legend>
        <?php
            echo $this->Form->input('Article.title', array('label' => 'Título'));
            echo $this->Form->input('Article.summary', array('label' => 'Sumario'));
            echo $this->Form->input('Article.body', array('label' => 'Cuerpo', 'type' => 'textarea'));
            echo $this->Form->input('Article.enabled', array('label' => 'Habilitado'));
            echo $this->Form->input('Article.highlight', array('label' => 'Destacada'));
        ?>
        <br>

        <h3><?php echo __('Relacionar Multimedia'); ?></h3>

        <div>
            <input type="radio" name="tipo_media" value="img" id="radio_img" onchange="selectMedia(this.value)" checked>
            <label for="radio_img" class="ml22 mt5">Imagen</label>
        </div>
        <div>
            <input type="radio" name="tipo_media" value="vid" id="radio_vid" onchange="selectMedia(this.value)">
            <label for="radio_vid" class="ml22 mt5">Video</label>
        </div>
        <div>
            <input type="radio" name="tipo_media" value="" id="radio_ninguno" onchange="selectMedia(this.value)">
            <label for="radio_ninguno" class="ml22 mt5">Ninguno</label>
        </div>
        
        <?php echo $this->Form->input('Article.media', array('type' => 'hidden', 'value' => 'imagen')); ?>

        <div id="related_img">
            <h3><?php echo __('Imagen'); ?></h3>
            <?php 
                echo $this->Form->input('RelatedImage.upload', array('type' => 'file', 'required' => 'true', 'label' => 'Seleccione Imagen', 'class' => 'related_img', 'div' => 'input file required', 'onchange' => 'validateInputFile(this)'));
            ?>
        </div>
        
        <div id="related_vid" style="display: none">
            <h3><?php echo __('Seleccionar Video'); ?></h3>
            <?php 
                echo $this->Form->input('RelatedVideo.name', array('label' => 'Nombre', 'required' => 'false', 'class' => 'related_vid'));
                echo $this->Form->input('RelatedVideo.source', array('label' => 'Source', 'required' => 'false', 'class' => 'related_vid'));
            ?>
        </div>
    </fieldset>
<?php echo $this->Form->end(__('Guardar')); ?>
</div>
