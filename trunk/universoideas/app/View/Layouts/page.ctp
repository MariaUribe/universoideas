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
    <title>
        <?php echo $title_for_layout ?>
    </title>
    <?php
        echo $this->Html->meta('icon');
        echo $this->Html->css('estilos');

        echo $this->Html->script('http://code.jquery.com/jquery-1.9.1.js');
        echo $this->Html->script('generic');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
    ?>
</head>
<body>
    <?php echo $this->Session->flash(); ?>
    <div id="conten_ppal">
        <div id="content_head" class="pt5">
            <?php $dir =  dirname(__DIR__); ?>
            <?php include $dir . "/Pages/head.ctp"; ?>
        </div>
        <div id="content_dos_col">
            <?php echo $this->fetch('content'); ?>
        </div>
    </div>
    <?php include ("includes/foot.htm") ?>
</body>
</html>
