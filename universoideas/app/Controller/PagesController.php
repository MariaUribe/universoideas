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
        $this->Auth->allow(array('article', 'display', 'home', 'contacto', 'cronograma', 'home_pasantias', 
                                 'encuentrame', 'forums', 'arte', 'ciencia', 'moda', 'rumba', 'sexualidad', 
                                 'event', 'curso', 'search_all', 'search_articles', 'search_events', 'search_cursos', 
                                 'search_forums', 'terminos'));
        
        $user = $this->Auth->user();

        if(!empty($user)) {
            if(($user['role_id'] === '1') || ($user['role_id'] === '3')) // administrador o empresa 
                $this->Auth->allow(array('list_all', 'list_all_table', 'forums_table', 'mis_emprendimientos','emprendedores_table', 'mis_emprendimientos_table', 'emprendedores'));
            else {
                $this->Auth->allow(array('list_all', 'list_all_table', 'forums_table', 'mis_emprendimientos','emprendedores_table', 'mis_emprendimientos_table'));
                $this->Auth->deny(array('emprendedores'));
            }   
        } else {
            $this->Auth->deny(array('list_all', 'list_all_table','forums_table', 'mis_emprendimientos','emprendedores_table', 'mis_emprendimientos_table', 'emprendedores'));
        }
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
        
        $this->set(compact('page', 'subpage', 'page', 'user'));
        $this->render(implode('/', $path));
    }
    
    public function article() {
        $this->loadModel('Article');
        
        $this->layout = 'page';
        
        $user = $this->Auth->user();
        $id = $this->params['url']['id'];
        
        $this->set(compact('user', 'id'));
    }
    
    public function article_detail() {
        $this->loadModel('Article');
        
        $this->layout = 'page';
        
        $id = $this->params['url']['id'];
        $article = $this->getArticleById($id);
        
        $this->set(compact('article'));
    }
    
    public function event() {
        $this->loadModel('Event');
        
        $this->layout = 'page';
        
        $user = $this->Auth->user();
        $id = $this->params['url']['id'];
        
        $this->set(compact('user', 'id'));
    }
    
    public function event_detail() {
        $this->loadModel('Event');
        
        $this->layout = 'page';
        
        $id = $this->params['url']['id'];
        
        $options = array('conditions' => array('Event.' . $this->Event->primaryKey => $id));
        $event = $this->Event->find('first', $options);
        
        $this->set(compact('event'));
    }
    
    public function curso() {
        $this->loadModel('Curso');
        
        $this->layout = 'page';
        
        $user = $this->Auth->user();
        $id = $this->params['url']['id'];
        
        $this->set(compact('user', 'id'));
    }
    
    public function curso_detail() {
        $this->loadModel('Curso');
        
        $this->layout = 'page';
        
        $id = $this->params['url']['id'];
        
        $options = array('conditions' => array('Curso.' . $this->Curso->primaryKey => $id));
        $curso = $this->Curso->find('first', $options);
        
        $this->set(compact('curso'));
    }
    
     public function rio($channel = null) {
        $this->loadModel('Article');
        
        $this->layout = 'page';
        
        $articles_rio = $this->getArticles(15, $channel);
        
        $this->set(compact('articles_rio'));
    }
    
     public function galeria($channel = null) {
        $this->loadModel('Article');
        
        $this->layout = 'page';
        
        $articles_gallery = $this->getArticlesGallery(5, $channel);
        
        $this->set(compact('articles_gallery'));
    }
    
    public function cronograma() {
        $this->loadModel('Event');
        
        $this->layout = 'page';
        
        $user = $this->Auth->user();
        
        $this->set(compact('user'));
    }
   
    public function home_pasantias() {
        $this->layout = 'page';
        
        $user = $this->Auth->user();
        
        $this->set(compact('user'));
    }
   
    public function pasantias() {
        $this->loadModel('Article');
        $this->loadModel('Enterprise');
        
        $this->layout = 'page';
        
        $enterprises = $this->Enterprise->find('all', array('conditions' => array('Enterprise.enabled' => 1), 'order' => array('modified' => 'desc'), 'limit' => 15));
        
        $this->set(compact('enterprises'));
    }
    
    public function forums() {
        $this->layout = 'page';
        
        $user = $this->Auth->user();
        
        $this->set(compact('user'));
    }
    
    public function forums_table() {
        $this->loadModel('Forum');
        $this->loadModel('Comment');
        
        $this->layout = 'page';
        
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
                                                  'limit' => 70));
            
        $this->set(compact('forums'));
    }
    
    public function emprendedores() {
        $this->layout = 'page';
        
        $user = $this->Auth->user();
        
        $this->set(compact('user'));
    }
    
    public function emprendedores_table() {
        $this->loadModel('Emprendedore');
        
        $this->layout = 'page';
        $emprendedores = $this->Emprendedore->find('all', array('conditions' => array('Emprendedore.status' => 'AP'), 'limit' => 80));

        $this->set(compact('emprendedores'));
    }
    
    public function mis_emprendimientos($id = null) {
        $this->loadModel('Emprendedore');
        $this->layout = 'page';
        
        $has_emp = false;
        $user = $this->Auth->user();
        $emprendedores = $this->Emprendedore->find('all', array('conditions' => array('Emprendedore.user_id' => $user['id']), 'limit' => 80));
        
        if(sizeof($emprendedores) > 0)
            $has_emp = true;
        else
            $has_emp = false;
        
        $this->set(compact('user', 'has_emp'));
    }
    
    public function mis_emprendimientos_table($user_id = null) {
        $this->loadModel('Emprendedore');
        
        $this->layout = 'page';
//        $user_id = $this->Auth->user('id');
        $user = $this->Auth->user();
        
        $emprendedores = $this->Emprendedore->find('all', array('conditions' => array('Emprendedore.user_id' => $user_id), 'limit' => 80));

        $this->set(compact('emprendedores', 'user'));
    }
    
    public function list_all() {
        $this->loadModel('Forum');
        $this->layout = 'page';
        
        $has_forum = false;
        $user_id = $this->Auth->user('id');
        $user = $this->Auth->user();
        unset($this->Forum->virtualFields['count']);
        unset($this->Forum->virtualFields['max_comment']);
        $forums = $this->Forum->find('all', array('conditions' => array('Forum.user_id' => $user['id']), 'limit' => 80));
        
        if(sizeof($forums) > 0)
            $has_forum = true;
        else
            $has_forum = false;
             
        $this->set(compact('user', 'has_forum'));
    }
    
    public function list_all_table($user_id = null) {
        $this->loadModel('Forum');
        $this->loadModel('Comment');
        
        $this->layout = 'page';
        
//        $user_id = $this->Auth->user('id');
        $user = $this->Auth->user();
        
        $forums = $this->Forum->find('all', array('conditions' => array('Forum.user_id' => $user_id), 
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
        
        $this->set(compact('forums'));
    }
    
    public function encuentrame() {
        $channel = 'encuentrame';
        
        $this->layout = 'page';
        
        $user = $this->Auth->user();
        
        $this->set(compact('user'));
    }
    
    public function arte() {
        $channel = 'arte';
        
        $this->layout = 'page';
        
        $user = $this->Auth->user();
        $articles_count = $this->getArticlesCount(15, $channel);
        
        $this->set(compact('user', 'articles_count'));
    }
    
    public function ciencia() {
        $channel = 'ciencia';
        
        $this->layout = 'page';
        
        $user = $this->Auth->user();
        
        $articles_count = $this->getArticlesCount(15, $channel);
        
        $this->set(compact('user', 'articles_count'));
    }
    
    public function moda() {
        $channel = 'moda';
        
        $this->layout = 'page';
        
        $user = $this->Auth->user();
        
        $articles_count = $this->getArticlesCount(15, $channel);
        
        $this->set(compact('user', 'articles_count'));
    }
    
    public function rumba() {
        $channel = 'rumba';
        
        $this->layout = 'page';
        
        $user = $this->Auth->user();
        
        $articles_count = $this->getArticlesCount(15, $channel);
        
        $this->set(compact('user', 'articles_count'));
    }
    
    public function sexualidad() {
        $channel = 'sexualidad';
        
        $this->layout = 'page';
        
        $user = $this->Auth->user();
        
        $articles_count = $this->getArticlesCount(15, $channel);
        
        $this->set(compact('user', 'articles_count'));
    }
    
    public function contacto() {
        $this->loadModel('Article');
        
        $this->layout = 'page';
        
        $user = $this->Auth->user();
        $this->set(compact('user'));
    }
    
    public function terminos() {
        $this->loadModel('Article');
        
        $this->layout = 'page';
        
        $user = $this->Auth->user();
        $this->set(compact('user'));
    }
        
    public function terminos_detail() {
        $this->loadModel('CustomText');
        
        $this->layout = 'page';
        
        $terminos = $this->CustomText->find('first', array('conditions' => array('CustomText.section' => 'TERMINOS')));

        $this->set(compact('terminos'));
    }
        
    public function join() {
        $this->loadModel('CustomText');
        
        $this->layout = 'page';
        
        $join = $this->CustomText->find('first', array('conditions' => array('CustomText.section' => 'PARTICIPA')));

        $this->set(compact('join'));
    }
      
    public function contacto_detail() {
        $this->loadModel('CustomText');
        
        $this->layout = 'page';
        
        $contacto = $this->CustomText->find('first', array('conditions' => array('CustomText.section' => 'CONOCENOS')));

        $this->set(compact('contacto'));
    }
    
    public function terminos_uso() {
        $this->loadModel('CustomText');
        
        $this->layout = 'page';
        
        $terminos_uso = $this->CustomText->find('first', array('conditions' => array('CustomText.section' => 'TERMINOS_USO')));

        $this->set(compact('terminos_uso'));
    }
    
    public function search_all() {
        $this->loadModel('Article');
        $user = $this->Auth->user();
        
        $this->layout = 'page';
        
        $text = $this->params['url']['q'];
        $articles = $this->searchArticles($text, 5);
        $events = $this->searchEvents($text, 5);
        $cursos = $this->searchCursos($text, 5);
        $forums = $this->searchForums($text, 5);
        
        $this->set(compact('articles', 'events', 'cursos', 'forums', 'text', 'user'));
    }
    
    public function search_articles() {
        $this->loadModel('Article');
        $user = $this->Auth->user();
        
        $this->layout = 'page';
        
        $text = $this->params['url']['q'];
        $articles = $this->searchArticles($text, 50);
        
        $this->set(compact('articles', 'text', 'user'));
    }
    
    public function search_events() {
        $this->loadModel('Event');
        $user = $this->Auth->user();
        
        $this->layout = 'page';
        
        $text = $this->params['url']['q'];
        $events = $this->searchEvents($text, 50);
        
        $this->set(compact('events', 'text', 'user'));
    }
    
    public function search_cursos() {
        $this->loadModel('Curso');
        $user = $this->Auth->user();
        
        $this->layout = 'page';
        
        $text = $this->params['url']['q'];
        $cursos = $this->searchCursos($text, 50);
        
        $this->set(compact('cursos', 'text', 'user'));
    }
    
    public function search_forums() {
        $this->loadModel('Forum');
        $user = $this->Auth->user();
        
        $this->layout = 'page';
        
        $text = $this->params['url']['q'];
        $forums = $this->searchForums($text, 50);
        
        $this->set(compact('forums', 'text', 'user'));
    }
    
    public function noticias_destacadas() {
        $this->layout = 'page';
        
        $articles_dest = $this->getArticles(10, null);
        
        $this->set(compact('articles_dest'));
    }
    
    public function prox_actividades() {
        $this->loadModel('Event');
        $this->layout = 'page';
        
        $events = $this->Event->find('all', array('conditions' => array('Event.enabled' => 1), 'order' => array('modified' => 'desc'), 'limit' => 6));
        
        $cal_events = array();
        
        foreach ($events as $event) {
            $e = array();
            $e['id'] = $event['Event']['id'];
            $e['title'] = $event['Event']['name'];
            $e['start'] = $event['Event']['event_date'];
            $e['url'] = '/pages/event?id=' . $event['Event']['id'];
                    
            if($event['Event']['event_end_date'] != null) {
                $e['end'] = $event['Event']['event_end_date'];
            } else {
                $e['end'] = $event['Event']['event_date'];
            }

            // Merge the event array into the return array
            array_push($cal_events, $e);
        }

        // Output json for our calendar
        $json_events = json_encode($cal_events);
        
        $this->set(compact('events', 'json_events'));
    }
    
    public function talleres_cursos() {
        $this->loadModel('Curso');
        $this->layout = 'page';
        
        $cursos = $this->Curso->find('all', array('conditions' => array('Curso.enabled' => 1), 'order' => array('modified' => 'desc'), 'limit' => 5));
        
        $this->set(compact('cursos'));
    }
    
    public function calendario_eventos() {
        $this->loadModel('Event');
        $this->layout = 'page';
        
        $events = $this->Event->find('all', array('conditions' => array('Event.enabled' => 1), 'order' => array('event_date' => 'desc'), 'limit' => 10));
                
        $this->set(compact('events'));
    }
    
    public function admin() {
        $this->layout = 'default';
        
        $articles_dest = $this->getArticles(10, null);
        
        $this->set(compact('articles_dest'));
    }
    
    public function searchArticles($text, $limit) {
        $this->loadModel('Article');

        $sql = "SELECT article.id, article.title, article.summary, article.enabled, article.created, article.modified 
                FROM articles article 
                WHERE (article.title LIKE '%" . $text . "%'
                       OR article.summary LIKE '%" . $text . "%')
                AND article.enabled = 1
                LIMIT " . $limit . "";
        
        $articles = $this->Article->query($sql);
        
        return $articles;
    }
    
    public function searchEvents($text, $limit) {
        $this->loadModel('Event');

        $sql = "SELECT event.id, event.name, event.description, event.enabled, event.created, event.modified 
                FROM events event 
                WHERE (event.name LIKE '%" . $text . "%'
                       OR event.description LIKE '%" . $text . "%')
                AND event.enabled = 1
                LIMIT " . $limit . "";
        
        $events = $this->Event->query($sql);
        
        return $events;
    }
    
    public function searchCursos($text, $limit) {
        $this->loadModel('Curso');

        $sql = "SELECT curso.id, curso.name, curso.description, curso.enabled, curso.created, curso.modified 
                FROM cursos curso 
                WHERE (curso.name LIKE '%" . $text . "%'
                       OR curso.description LIKE '%" . $text . "%')
                AND curso.enabled = 1
                LIMIT " . $limit . "";

        $cursos = $this->Curso->query($sql);
        
        return $cursos;
    }
    
    public function searchForums($text, $limit) {
        $this->loadModel('Forum');

        $sql = "SELECT forum.id, forum.title, forum.content, forum.enabled, forum.created, forum.modified, user.username 
                FROM forums forum 
                LEFT JOIN users user ON user.id = forum.user_id
                WHERE (forum.title LIKE '%" . $text . "%'
                        OR forum.content LIKE '%" . $text . "%')
                AND forum.enabled = 1
                LIMIT " . $limit . "";

        $forums = $this->Forum->query($sql);
        
        return $forums;
    }
    
    public function getArticleById($id) {
        $this->loadModel('Article');

        $sql = "SELECT art.id, art.channel, art.title, art.body, art.summary, art.enabled, art.created, art.modified, 
                       img.id as image_id, img.uri, img.uri_thumb, img.title, img.article_id as img_article_id, 
                       vid.id as video_id, vid.name as video_name, vid.source, vid.article_id as vid_article_id 
                FROM articles art 
                LEFT JOIN related_images img on art.id = img.article_id 
                LEFT JOIN related_videos vid on art.id = vid.article_id 
                WHERE art.id = " . $id . "";
        
        $article = $this->Article->query($sql);
        
        return $article;
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
    
    public function getArticlesCount($limit, $channel) {
        $this->loadModel('Article');
        $join = "";
        
        if($channel != "" && $channel != null) {
            $join = "AND art.channel = '" . $channel . "'";
        }
        
        $sql = "SELECT art.id
                FROM articles art 
                LEFT JOIN related_images img on art.id = img.article_id 
                LEFT JOIN related_videos vid on art.id = vid.article_id 
                WHERE art.enabled = 1 
                AND art.highlight = 0 " 
                . $join .
               "LIMIT " . $limit . ""; 
        
        $articles = $this->Article->query($sql);
        $articles_count = sizeof($articles);
        
        return $articles_count;
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
