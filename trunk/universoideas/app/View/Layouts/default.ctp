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

$universoDescription = __d('universo', 'Universoideas: Administración');
$title_for_layout = 'Universoideas Admin';
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

        echo $this->Html->css('cake.generic');
        echo $this->Html->css('admin');

        echo $this->Html->script('jquery/jquery-1.9.1');
        echo $this->Html->script('jquery/jquery.validate');
        echo $this->Html->script('generic');
        echo $this->Html->script('../ckeditor/ckeditor');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
    ?>
</head>
<body>
    <?php echo $this->Session->flash(); ?>
    <div id="container">
        <div id="header">
            <h1><a target="_blank" href="/" class="ml15">Universoideas: Ir a la página</a></h1>
        </div>
        <?php include ("includes/admin_menu.html") ?>
        <div id="content">
            <?php echo $this->fetch('content'); ?>
        </div>
        <div id="footer">
            <?php echo $this->Html->link($universoDescription, '/articles'); ?>
        </div>
    </div>
    <?php echo $this->element('sql_dump'); ?>
</body>
</html>
