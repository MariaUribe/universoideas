<script type="text/javascript">
    $(document).ready(function(){
        loadMultimedia();
    });
</script>

<div class="articles form">
    <?php echo $this->Form->create('Article', array('enctype' => 'multipart/form-data')); ?>
        <fieldset>
            <legend><?php echo __('Editar Artículo'); ?></legend>
            <?php
                echo $this->Form->input('Article.id');
                echo $this->Form->input('Article.title', array('label' => 'Título'));
                echo $this->Form->input('Article.summary', array('label' => 'Sumario'));
                echo $this->Form->input('Article.body', array('label' => 'Cuerpo', 'type' => 'textarea'));
                echo $this->Form->input('Article.enabled', array('label' => 'Habilitado'));
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
                    echo $this->Form->input('RelatedVideo.name', array('label' => 'Nombre', 'required' => 'false', 'class' => 'related_vid', 'value' => $vid_name));
                    echo $this->Form->input('RelatedVideo.source', array('label' => 'Source', 'required' => 'false', 'class' => 'related_vid', 'value' => $vid_src));
                ?>
            </div>
            
        </fieldset>
    <?php echo $this->Form->end(__('Guardar')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Acciones'); ?></h3>
    <ul>
        <li><?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $this->Form->value('Article.id')), null, __('¿Está seguro que desea eliminar el artículo # %s?', $this->Form->value('Article.id'))); ?></li>
        <li><?php echo $this->Html->link(__('Nuevo Artículo'), array('action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('Listar Artículos'), array('action' => 'index')); ?></li>
    </ul>
</div>
