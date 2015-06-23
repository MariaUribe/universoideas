<?php echo $this->Form->input('Forum.id', array('type' => 'hidden', 'value' => $forum['Forum']['id'])); ?>

<?php 
    $date = $this->Time->format('D-F-j-Y-h:i A', $forum['Forum']['modified']);
    list($dia_sem, $mes, $dia, $ano, $hora) = explode('-', $date);
?>
<h1><?php echo $forum['Forum']['title']; ?></h1>

<hr>

<div class="nav-container2">
    <ul class="social-media-list">
        <li>
            <div class="fb-share-button" data-href="http://www.universoideas.com/forums/view/<?php echo $forum['Forum']['id'] ?>" data-layout="button_count"></div>
        </li>
        <li>
            <a class="twitter-share-button" href="https://twitter.com/intent/tweet?text=<?php echo $forum['Forum']['title']; ?> via @universoideasc - http://www.universoideas.com/pages/article?id=<?php echo $forum['Forum']['id'] ?>">Tweet</a>
        </li>
        <li> 
            <div class="g-plus" data-action="share" data-annotation="bubble" data-href="http://www.universoideas.com/forums/view/<?php echo $forum['Forum']['id'] ?>"></div>
        </li>
    </ul>
</div>

<p><span class="glyphicon glyphicon-time"></span> Publicado el <?php echo __($dia_sem) . ", " . __($dia) . " de " . __($mes) . " de " . __($ano) .  " " . $hora ?></p>
<p><span class="glyphicon glyphicon-user"></span> Creado por: <?php echo $forum['User']['username'] ?></p>

<hr>

<!-- Post Content -->
<?php echo $forum['Forum']['content']?>

<hr>

<h4><span class="glyphicon glyphicon-comment"></span> Comentarios</h4>

<div class="row">
    <?php if (!empty($forum['Comment'])): ?>
    <?php
        foreach ($comments as $comment) {
            $comment_date = $this->Time->format('D-F-j-Y-h:i A', $comment['Comment']['modified']);
            list($dia_sem_com, $mes_com, $dia_com, $ano_com, $hora_com) = explode('-', $comment_date);
    ?>
        <div class="col-md-2 col-sm-2">
            <div class="thumbnail">
                <img class="img-responsive user-photo" src="/img/avatar_2x.png">
            </div><!-- /thumbnail -->
        </div>

        <div class="col-md-10 col-sm-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong><?php echo $comment['usr']['username'] ?></strong>
                    <span class="text-muted">Comentado el <?php echo __($dia_sem_com) . " " . __($mes_com) . " " . __($dia_com) . ", " . __($ano_com) .  " " . $hora_com ?></span>
                </div>
                <div class="panel-body">
                    <?php echo $comment['Comment']['description']; ?>
                </div><!-- /panel-body -->
            </div><!-- /panel panel-default -->
        </div>
    <?php } ?>
    <?php else: ?>
        <div class="col-md-10 col-sm-10">
            <p>Aún no existen comentarios para este tema.</p>
        </div>
    <?php endif; ?>
</div>

<hr>

<div class="row">
    <div class="col-md-2 col-md-offset-5">
        <?php echo $this->Html->link('Responder', array('controller' => 'comments', 'action' => 'add?forum_id='.$forum['Forum']['id']), array('class' => 'btn btn-primary')); ?>
    </div>
</div>
<hr>

<div style="color: #00355a; margin-top: 20px; font-weight: bold;">
    <?php 
        echo "<a href='/pages/list_all'>Ir a Mis Temas en el Foro</a>";
    ?>
</div>
