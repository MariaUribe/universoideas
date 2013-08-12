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
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('display', 'home', 'contacto', 'cronograma', 'home_pasantias', 'encuentrame', 'forums'));
//        $this->Auth->allow('vida_universitaria', 'forums');
    }

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
        
        $user = $this->Auth->user();
        $articles_gallery = $this->getArticlesGallery(5, null);
        $articles_rio = $this->getArticles(15, null);
        $articles_dest = $this->getArticles(10, null);
        $events = $this->Event->find('all', array('conditions' => array('Event.enabled' => 1), 'order' => array('modified' => 'desc'), 'limit' => 4));
        $cursos = $this->Curso->find('all', array('conditions' => array('Curso.enabled' => 1), 'order' => array('modified' => 'desc'), 'limit' => 4));
        
        $this->set(compact('page', 'subpage', 'page', 'articles_rio', 'articles_dest', 'events', 'cursos', 'articles_gallery', 'user'));
        $this->render(implode('/', $path));
    }
    
    public function cronograma() {
        $this->loadModel('Event');
        
        $this->layout = 'page';
        
        $user = $this->Auth->user();
        $articles_dest = $this->getArticles(10, null);
        $events = $this->Event->find('all', array('conditions' => array('Event.enabled' => 1), 'order' => array('event_date' => 'desc'), 'limit' => 10));
        
        $this->set(compact('articles_dest', 'events', 'user'));
    }
    
    public function rio() {
        $this->loadModel('Article');
        
        $this->layout = 'page';
        
        $articles_rio = $this->getArticles(5, null);
        
        $this->set(compact('articles_rio'));
    }
    
    public function home_pasantias() {
        $this->loadModel('Article');
        $this->loadModel('Enterprise');
        $this->loadModel('Event');
        $this->loadModel('Curso');
        
        $this->layout = 'page';
        
        $user = $this->Auth->user();
        $articles_dest = $this->getArticles(10, null);
        $enterprises = $this->Enterprise->find('all', array('conditions' => array('Enterprise.enabled' => 1), 'order' => array('modified' => 'desc'), 'limit' => 15));
        $events = $this->Event->find('all', array('conditions' => array('Event.enabled' => 1), 'order' => array('modified' => 'desc'), 'limit' => 4));
        $cursos = $this->Curso->find('all', array('conditions' => array('Curso.enabled' => 1), 'order' => array('modified' => 'desc'), 'limit' => 4));
        
        $this->set(compact('articles_dest', 'events', 'cursos', 'enterprises', 'user'));
    }
    
    public function forums() {
        $this->loadModel('Article');
        $this->loadModel('Forum');
        $this->loadModel('Comment');
        
        $this->layout = 'page';
        
        $user = $this->Auth->user();
        $articles_dest = $this->getArticles(10, null);
        
        $forums = $this->Forum->find('all', array('conditions' => array('Forum.enabled' => 1), 
                                                  'fields' => array('Forum.count', 'Forum.max_comment', 'Forum.id', 'Forum.title', 'Forum.content', 'Forum.enabled', 'Forum.user_id', 'Forum.created', 'Forum.modified',
                                                                    'User.id', 'User.username', 'User.name', 'User.lastname', 'User.mail', 'User.role_id'),
                                                  'group' => array('Forum.id'),
                                                  'joins' => array(
                                                            array(
                                                                'table' => 'comments',
                                                                'alias' => 'Comment',
                                                                'type' => 'LEFT',
                                                                'conditions' => array(
                                                                    'Comment.forum_id = Forum.id'
                                                                )
                                                            )
                                                        ),
                                                  'order' => array('Forum.modified' => 'desc'), 
                                                  'limit' => 100));
        
        $this->set(compact('articles_dest', 'user', 'forums'));
    }
    
    public function encuentrame() {
        $channel = 'encuentrame';
        $this->loadModel('Article');
        $this->loadModel('Event');
        $this->loadModel('Curso');
        
        $this->layout = 'page';
        
        $user = $this->Auth->user();
        $articles_gallery = $this->getArticlesGallery(5, $channel);
        $articles_rio = $this->getArticles(10, $channel);
        $articles_dest = $this->getArticles(10, null);
        $events = $this->Event->find('all', array('conditions' => array('Event.enabled' => 1), 'order' => array('modified' => 'desc'), 'limit' => 4));
        $cursos = $this->Curso->find('all', array('conditions' => array('Curso.enabled' => 1), 'order' => array('modified' => 'desc'), 'limit' => 4));
        
        $this->set(compact('articles_gallery', 'articles_rio', 'articles_dest', 'events', 'cursos', 'user'));
    }
    
    public function contacto() {
        $this->loadModel('Article');
        
        $this->layout = 'page';
        
        $user = $this->Auth->user();
        $articles_dest = $this->getArticles(10, null);
        $this->set(compact('articles_dest', 'user'));
    }
    
    public function noticias_destacadas() {
        $this->layout = 'page';
        
        $articles_dest = $this->getArticles(10, null);
        
        $this->set(compact('articles_dest'));
    }
    
    public function admin() {
        $this->layout = 'default';
        
        $articles_dest = $this->getArticles(10, null);
        
        $this->set(compact('articles_dest'));
    }
    
    public function getArticles($limit, $channel) {
        $this->loadModel('Article');
        $join = "";
        
        if($channel != "" && $channel != null) {
            $join = "AND art.channel = '" . $channel . "'";
        }
        
        $sql = "SELECT art.id, art.channel, art.title, art.summary, art.enabled, art.created, art.modified, 
                       img.id as image_id, img.uri, img.uri_thumb, img.title, img.article_id as img_article_id, 
                       vid.id as video_id, vid.name as video_name, vid.source, vid.article_id as vid_article_id 
                FROM articles art 
                LEFT JOIN related_images img on art.id = img.article_id 
                LEFT JOIN related_videos vid on art.id = vid.article_id 
                WHERE art.enabled = 1 
                AND art.highlight = 0 " 
                . $join .
               "ORDER BY art.modified desc, art.id asc 
                LIMIT " . $limit . ""; 
        
        $articles = $this->Article->query($sql);
        
        return $articles;
    }
    
    public function getArticlesGallery($limit, $channel) {
        $this->loadModel('Article');
        $join = "";
        
        if($channel != "" && $channel != null) {
            $join = "AND art.channel = '" . $channel . "'";
        }
        
        $sql = "SELECT art.id, art.channel, art.title, art.summary, art.enabled, art.created, art.modified, 
                       img.id as image_id, img.uri, img.uri_thumb, img.title, img.article_id as img_article_id, 
                       vid.id as video_id, vid.name as video_name, vid.source, vid.article_id as vid_article_id 
                FROM articles art 
                LEFT JOIN related_images img on art.id = img.article_id 
                LEFT JOIN related_videos vid on art.id = vid.article_id 
                WHERE art.enabled = 1 
                AND art.highlight = 1 "
                . $join .
               "ORDER BY art.modified desc, art.id asc 
                LIMIT " . $limit . ""; 
        
        $articles = $this->Article->query($sql);
        
        return $articles;
    }
    
}
