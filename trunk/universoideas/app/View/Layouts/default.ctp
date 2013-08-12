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
		echo $this->Html->css('jMenu.jquery');
                
                echo $this->Html->script('jquery/jquery-1.9.1');
                echo $this->Html->script('generic');
                
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
    
        <?php echo $this->Session->flash(); ?>
	<div id="container">
		<div id="header">
			<h1><?php echo $this->Html->link($universoDescription, 'http://localhost/universoideas/'); ?></h1>
<!--                    <div class="logo"><a href="/universoideas/"><img src="img/logo.png" width="256" height="65" alt="Universo Ideas"></a></div>-->
		</div>
                <?php include ("includes/admin_menu.html") ?>
		<div id="content">
			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php echo $this->Html->link($universoDescription, 'http://localhost/universoideas/articles'); ?>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
        <?php echo $this->Html->script('jquery/jmenu'); ?>
    
        <script type="text/javascript">
            $(document).ready(function() {
                $("#jMenu").jMenu();
            });
        </script>
</body>
</html>
