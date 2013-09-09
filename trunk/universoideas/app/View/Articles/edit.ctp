<div class="articles border">
    <?php echo $this->Form->create('Article', array('enctype' => 'multipart/form-data')); ?>
        <fieldset>
            <legend><?php echo __('Editar Artículo'); ?></legend>
            <?php
                echo $this->Form->input('Article.id');
                echo $this->Form->input('Article.channel', array('label' => 'Canal'));
                echo $this->Form->input('Article.title', array('label' => 'Título'));
                echo $this->Form->input('Article.summary', array('label' => 'Sumario', 'type' => 'textarea'));
                echo $this->Form->input('Article.body', array('label' => 'Cuerpo', 'type' => 'textarea', 'rows' => '10'));
                echo $this->Form->input('Article.enabled', array('label' => 'Habilitado'));
                echo $this->Form->input('Article.highlight', array('label' => 'Destacada'));
            ?>
            
            <br>

            <h3><?php echo __('Relacionar Multimedia'); ?></h3>
            
            <div>
                <input type="radio" name="tipo_media" value="img" id="radio_img" onchange="selectMedia(this.value)">
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
            
            <?php 
                $img = ""; $img_name = ""; $uri_thumb = ""; 
                $vid = ""; $vid_name = ""; $vid_src = ""; 
                
                if(!empty($relatedImage)) {
                    $img = $relatedImage['RelatedImage']['id'];
                    $img_name = $relatedImage['RelatedImage']['name'];
                    $uri_thumb = $relatedImage['RelatedImage']['uri_thumb'];
                }
                
                if(!empty($relatedVideo)) {
                    $vid = $relatedVideo['RelatedVideo']['id'];
                    $vid_name = $relatedVideo['RelatedVideo']['name'];
                    $vid_src = $relatedVideo['RelatedVideo']['source'];
                }
                
                echo $this->Form->input('RelatedImage.id', array('label' => 'Image ID', 'type' => 'hidden', 'value' => $img)); 
                echo $this->Form->input('RelatedVideo.id', array('label' => 'Video ID', 'type' => 'hidden', 'value' => $vid)); 
            ?>

            <?php echo $this->Form->input('Article.media', array('type' => 'hidden', 'value' => 'imagen')); ?>
            
            <div id="related_img">
                <h3><?php echo __('Imagen'); ?></h3>
                <?php 
                    echo $this->Form->input('RelatedImage.upload', array('type' => 'file', 'required' => 'true', 'label' => 'Seleccione Imagen', 'class' => 'related_img', 'div' => 'input file required', 'onchange' => 'validateInputFile(this)'));
                    
                    if($uri_thumb != "")
                        echo $this->Html->image($uri_thumb);
                ?>
            </div>

            <div id="related_vid" style="display: none">
                <h3><?php echo __('Seleccionar Video'); ?></h3>
                <?php 
                    echo $this->Form->input('RelatedVideo.source', array('label' => 'Source', 'required' => 'false', 'class' => 'related_vid', 'value' => $vid_src));
                ?>
            </div>
            
        </fieldset>
    <?php echo $this->Form->end(__('Guardar')); ?>
</div>

<script type="text/javascript">
    loadMultimedia();
</script>
