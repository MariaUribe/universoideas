<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'pages', 'action' => 'home', 'home'));
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
//	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
        Router::connect('/pages/home_cake', array('controller' => 'pages', 'action' => 'home_cake'));
        Router::connect('/pages/article', array('controller' => 'pages', 'action' => 'article'));
        Router::connect('/pages/event', array('controller' => 'pages', 'action' => 'event'));
        Router::connect('/pages/curso', array('controller' => 'pages', 'action' => 'curso'));
	Router::connect('/pages/cronograma', array('controller' => 'pages', 'action' => 'cronograma'));
	Router::connect('/pages/contacto', array('controller' => 'pages', 'action' => 'contacto'));
	Router::connect('/pages/home_pasantias', array('controller' => 'pages', 'action' => 'home_pasantias'));
	Router::connect('/pages/forums', array('controller' => 'pages', 'action' => 'forums'));
	Router::connect('/pages/list_all', array('controller' => 'pages', 'action' => 'list_all'));
	Router::connect('/pages/mis_emprendimientos', array('controller' => 'pages', 'action' => 'mis_emprendimientos'));
	Router::connect('/pages/encuentrame', array('controller' => 'pages', 'action' => 'encuentrame'));
	Router::connect('/pages/arte', array('controller' => 'pages', 'action' => 'arte'));
	Router::connect('/pages/ciencia', array('controller' => 'pages', 'action' => 'ciencia'));
	Router::connect('/pages/moda', array('controller' => 'pages', 'action' => 'moda'));
	Router::connect('/pages/rumba', array('controller' => 'pages', 'action' => 'rumba'));
	Router::connect('/pages/sexualidad', array('controller' => 'pages', 'action' => 'sexualidad'));
	Router::connect('/pages/rio', array('controller' => 'pages', 'action' => 'rio'));
	Router::connect('/pages/noticias_destacadas', array('controller' => 'pages', 'action' => 'noticias_destacadas'));
	Router::connect('/pages/prox_actividades', array('controller' => 'pages', 'action' => 'prox_actividades'));
	Router::connect('/pages/talleres_cursos', array('controller' => 'pages', 'action' => 'talleres_cursos'));
	Router::connect('/pages/search_all', array('controller' => 'pages', 'action' => 'search_all'));
	Router::connect('/pages/search_articles', array('controller' => 'pages', 'action' => 'search_articles'));
	Router::connect('/pages/search_events', array('controller' => 'pages', 'action' => 'search_events'));
	Router::connect('/pages/search_cursos', array('controller' => 'pages', 'action' => 'search_cursos'));
	Router::connect('/pages/search_forums', array('controller' => 'pages', 'action' => 'search_forums'));
	Router::connect('/pages/galeria', array('controller' => 'pages', 'action' => 'galeria'));
        Router::connect('/pages/terminos', array('controller' => 'pages', 'action' => 'terminos'));
        
/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
