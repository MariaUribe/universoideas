<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('AppController', 'Controller', 'ArticlesController');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

    /**
    * Controller name
    *
    * @var string
    */
    public $name = 'Pages';

    /**
    * This controller does not use a model
    *
    * @var array
    */
    public $uses = array();

    /**
    * Displays a view
    *
    * @param mixed What page to display
    * @return void
    */
    public function display() {
        $path = func_get_args();

        $count = count($path);
        if (!$count) {
                $this->redirect('/');
        }
        $page = $subpage = $title_for_layout = null;

        if (!empty($path[0])) {
                $page = $path[0];
        }
        if (!empty($path[1])) {
                $subpage = $path[1];
        }
        if (!empty($path[$count - 1])) {
                $title_for_layout = Inflector::humanize($path[$count - 1]);
        }
		$this->set(compact('page', 'subpage', 'title_for_layout'));
        $this->render(implode('/', $path));
    }
    
    public function home_cake() {
        $this->layout = 'default';
        $maya = "cake";
        $this->set(compact('maya'));
    }
    
    public function home() {
        $this->loadModel('Article');
        $this->loadModel('Event');
        $this->loadModel('Curso');
        
        $this->layout = 'page';
        
        $path = func_get_args();

        $count = count($path);
        if (!$count) {
                $this->redirect('/');
        }
        $page = $subpage = $title_for_layout = null;

        if (!empty($path[0])) {
                $page = $path[0];
        }
        if (!empty($path[1])) {
                $subpage = $path[1];
        }
        if (!empty($path[$count - 1])) {
                $title_for_layout = Inflector::humanize($path[$count - 1]);
        }
        
        $articles_rio = $this->getArticles(5);
        $articles_dest = $this->getArticles(10);
        $events = $this->Event->find('all', array('conditions' => array('Event.enabled' => 1), 'order' => array('event_date' => 'desc'), 'limit' => 4));
        $cursos = $this->Curso->find('all', array('conditions' => array('Curso.enabled' => 1), 'order' => array('date' => 'desc'), 'limit' => 4));
        
        $this->set(compact('page', 'subpage', 'page', 'articles_rio', 'articles_dest', 'events', 'cursos'));
        $this->render(implode('/', $path));
    }
    
    public function cronograma() {
        $this->loadModel('Event');
        
        $this->layout = 'page';
        
        $articles_dest = $this->getArticles(10);
        $events = $this->Event->find('all', array('conditions' => array('Event.enabled' => 1), 'order' => array('event_date' => 'desc'), 'limit' => 10));
        
        $this->set(compact('articles_dest', 'events'));
    }
    
    public function rio() {
        $this->loadModel('Article');
        
        $this->layout = 'page';
        
        $articles_rio = $this->getArticles(5);
        
        $this->set(compact('articles_rio'));
    }
    
    public function noticias_destacadas() {
        $this->layout = 'page';
        
        $articles_dest = $this->getArticles(10);
        
        $this->set(compact('articles_dest'));
    }
    
    public function admin() {
        $this->layout = 'default';
        
        $articles_dest = $this->getArticles(10);
        
        $this->set(compact('articles_dest'));
    }
    
    public function getArticles($limit) {
        $this->loadModel('Article');
        $sql = "SELECT art.id, art.title, art.summary, art.enabled, art.created, art.modified, 
                       img.id as image_id, img.uri, img.uri_thumb, img.title, img.article_id as img_article_id, 
                       vid.id as video_id, vid.name as video_name, vid.source, vid.article_id as vid_article_id 
                FROM articles art 
                LEFT JOIN related_images img on art.id = img.article_id 
                LEFT JOIN related_videos vid on art.id = vid.article_id 
                WHERE art.enabled = 1 
                ORDER BY art.modified desc, art.id asc 
                LIMIT " . $limit . ""; 
        
        $articles = $this->Article->query($sql);
        
        return $articles;
    }
}
