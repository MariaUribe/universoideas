<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$universoDescription = __d('universo', 'Universoideas');
$title_for_layout = 'Universoideas';
?>
<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>
        <?php echo $title_for_layout ?>
    </title>
    <?php
        echo $this->Html->meta('icon');
        /*echo $this->Html->css('estilos');*/
        echo $this->Html->css('jquery-ui-1.11.2.custom/jquery-ui.min');
        echo $this->Html->css('jquery-ui-1.11.2.custom/jquery-ui.structure.min');
        echo $this->Html->css('jquery-ui-1.11.2.custom/jquery-ui.theme.min');
        echo $this->Html->css('jquery.mCustomScrollbar');
        
        /* Responsive design */
        echo $this->Html->css('bootstrap');
        echo $this->Html->css('font-awesome');
        echo $this->Html->css('style');
        
        /*echo $this->Html->script('http://code.jquery.com/jquery-1.9.1.js');*/
        /*echo $this->Html->script('jquery-ui.min');*/
        
        echo $this->Html->script('jquery-1.11.1');
        echo $this->Html->script('jssor.slider.mini');
        echo $this->Html->script('generic');
        echo $this->Html->script('../ckeditor_basic/ckeditor');
    
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
    ?>
</head>
<body id="index">
    <div id="conten_ppal">
        <!--div id="publicidadtop1" class="p5 tac"><div class="publicidad tal">ESPACIO PUBLICITARIO</div><a href="#"><img src="/img/publicidad/728x90.gif" width="728" height="90" alt="Publicidad" /></a></div-->
        <div id="content_head" class="pt5">
            <?php $dir =  dirname(__DIR__); ?>
            <?php include $dir . "/Pages/head.ctp"; ?>
        </div>
        <?php echo $this->Session->flash(); ?>

        <div id="js_msg"></div>
        <div class="content-wrapper">
            <div id="js_container" class="container">
                <?php echo $this->fetch('content'); ?>
            </div>
        </div>
    </div>
    <?php include ("includes/foot.htm") ?>
    <!--php echo $this->Html->script('jquery/jquery.validate'); ?-->
    <?php echo $this->Html->script('jquery.mCustomScrollbar.concat.min'); ?>
    
    <script type="text/javascript">setMenuSelected()</script>

    <!-- BOOTSTRAP SCRIPTS  -->
    <?php echo $this->Html->script('bootstrap'); ?>
</body>
</html>
