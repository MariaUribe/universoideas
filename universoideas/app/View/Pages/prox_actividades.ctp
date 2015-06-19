<div class="row">
    <h2 class="page-header">Calendario de Eventos</h2>
    <div class="[ col-xs-12 col-sm-offset-2 col-sm-8 ]">
        <ul class="event-list">
            <?php 
                foreach ($events as $event) {
                    $date = $this->Time->format('D-M-j-Y-h:i A', $event['Event']['event_date']);
                    list($dia_sem, $mes, $dia, $ano, $hora) = explode('-', $date); 
                    $img = $event['Event']['image_thumb']; 
                    $no_tags_desc = strip_tags($event['Event']['description']);
                    $desc = (strlen($no_tags_desc) > 78) ? substr($no_tags_desc,0,75).'...' : $no_tags_desc;?>
                    
                    <li>
                        <time datetime="<?php echo $event['Event']['event_date']?>">
                            <span class="day"><?php echo $dia ?></span>
                            <span class="month"><?php echo $mes ?></span>
                            <span class="year"><?php echo $ano ?></span>
                            <span class="time"><?php echo $hora ?></span>
                        </time>
                        <?php 
                            if($img != null) {
                                echo $this->Html->image($event['Event']['image_thumb'], array('alt' => $event['Event']['name'], 'border' => '0', 'class' => 'img-responsive'));
                            }
                        ?>
                        <div class="info">
                            <h2 class="title"><a class="black" href="/pages/event?id=<?php echo $event['Event']['id']?>"><?php echo $event['Event']['name'] ?></a></h2>
                            <p class="desc"><?php echo $desc ?></p>
                            <ul>
                                <li style="width:50%;">
                                    <a href="/pages/event?id=<?php echo $event['Event']['id']?>"><span class="fa fa-globe"></span> Leer Más</a>
                                </li>
                                <li style="width:50%;"><span class="fa fa-clock-o"></span> <?php echo $event['Event']['init_time'] ?></li>
                            </ul>
                        </div>
                        <div class="social">
                            <ul>
                                <li class="facebook" style="width:33%;">
                                    <a class="icon-facebook" rel="nofollow"
                                        href="http://www.universoideas.com/pages/event?id=<?php echo $event['Event']['id']?>"
                                        onclick="popUp=window.open(
                                            'http://www.facebook.com/sharer.php?u=http://www.universoideas.com/pages/event?id=<?php echo $event['Event']['id']?>',
                                            'popupwindow',
                                            'scrollbars=yes,width=800,height=400');
                                        popUp.focus();
                                        return false">
                                        <span class="fa fa-facebook"></span>
                                    </a>
                                </li>
                                <li class="twitter" style="width:34%;">
                                    <a class="icon-twitter" rel="nofollow"
                                        href="http://www.universoideas.com/pages/event?id=<?php echo $event['Event']['id']?>"
                                        onclick="popUp=window.open(
                                            'http://twitter.com/intent/tweet?text=\'<?php echo $event['Event']['name'] ?>\' via @universoideasc - http://www.universoideas.com/pages/event?id=<?php echo $event['Event']['id']?>',
                                            'popupwindow',
                                            'scrollbars=yes,width=800,height=400');
                                        popUp.focus();
                                        return false">
                                        <span class="fa fa-twitter"></span>
                                    </a>
                                </li>
                                <li class="google-plus" style="width:33%;">
                                    <a class="icon-gplus" rel="nofollow"
                                        href="http://www.universoideas.com/pages/event?id=<?php echo $event['Event']['id']?>"
                                        onclick="popUp=window.open(
                                            'https://plus.google.com/share?url=http://www.universoideas.com/pages/event?id=<?php echo $event['Event']['id']?>',
                                            'popupwindow',
                                            'scrollbars=yes,width=800,height=400');
                                        popUp.focus();
                                        return false">
                                        <span class="fa fa-google-plus"></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
            <?php } ?>
        </ul>
    </div>
</div>