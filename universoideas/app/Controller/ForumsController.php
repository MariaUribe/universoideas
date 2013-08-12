<?php
App::uses('AppController', 'Controller');

/**
 * Forums Controller
 *
 * @property Forum $Forum
 */
class ForumsController extends AppController {
    
    public $paginate = array(
        'conditions' => array('Forum.enabled' => 1), 
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
        'order' => array('Forum.modified' => 'desc')
);

    public function beforeFilter() {
        parent::beforeFilter();
        $user = $this->Auth->user();
        
        if(!empty($user)) {
            if($user['id'] === '1')
                $this->Auth->allow(array('index', 'view', 'add', 'edit', 'delete'));
            else {
                $this->Auth->allow(array('list_all', 'view', 'add', 'edit', 'delete'));
                $this->Auth->deny(array('index'));
            }
        } else {
            $this->Auth->allow(array('view'));
            $this->Auth->deny(array('index', 'add', 'edit', 'delete'));
        }
    }
    
    /**
    * index method
    *
    * @return void
    */
    public function index() {
        $this->Forum->recursive = 0;
        $this->set('forums', $this->paginate());
    }
    
    /**
    * list_all method
    *
    * @return void
    */
    public function list_all() {
//        $this->layout = 'page';
        $user_id = $this->Auth->user('id');
        $user = $this->Auth->user();
        
        $this->paginate = array(
            'conditions' => array('Forum.user_id' => $user_id),
            'order' => array('Forum.modified' => 'desc')
            );
        $forums = $this->paginate('Forum');
        $this->set(compact('forums', 'user'));
    }

    /**
    * view method
    *
    * @throws NotFoundException
    * @param string $id
    * @return void
    */
    public function view($id = null) {
        $this->loadModel('Comment');
        $this->loadModel('User');
        
        $this->layout = 'page';
        
        if (!$this->Forum->exists($id)) {
            throw new NotFoundException(__('Invalid forum'));
        }
        $users = $this->Forum->User->find('list');
        $user = $this->Auth->user();
        $options = array('conditions' => array('Forum.' . $this->Forum->primaryKey => $id),
                         'fields' => array('Forum.id', 'Forum.title', 'Forum.content', 'Forum.enabled', 'Forum.user_id', 'Forum.created', 'Forum.modified',
                                           'User.id', 'User.username', 'User.name', 'User.lastname', 'User.mail', 'User.role_id'),
                        );
        $forum = $this->Forum->find('first', $options);
        
        $sql = "SELECT Comment.id, Comment.description, Comment.forum_id, Comment.user_id, Comment.created, Comment.modified,  
                       usr.id as userid, usr.username, usr.name, usr.lastname, usr.mail, usr.role_id 
                FROM comments Comment 
                LEFT JOIN users usr on Comment.user_id = usr.id 
                WHERE Comment.forum_id = " . $id . " " .
               "ORDER BY Comment.modified desc"; 
        
        $comments = $this->Forum->query($sql);
        
        $this->set(compact('user', 'users', 'forum', 'comments'));
    }

    /**
    * add method
    *
    * @return void
    */
    public function add() {
        $this->layout = 'page';
        $user = $this->Auth->user();
        if ($this->request->is('post')) {
            $this->Forum->create();
            $this->request->data['Forum']['user_id'] = $user['id'];
            $this->request->data['Forum']['enabled'] = 1;
            if ($this->Forum->save($this->request->data)) {
                $this->Session->setFlash('El foro fue guardado exitosamente.', 'flash_success');
                $this->redirect(array('controller' => 'pages','action' => 'forums'));
            } else {
                $this->Session->setFlash('El foro no pudo ser guardado. Intente de nuevo.', 'flash_error');
            }
        }
        $users = $this->Forum->User->find('list');
        $this->set(compact('users', 'user'));
    }

    /**
    * edit method
    *
    * @throws NotFoundException
    * @param string $id
    * @return void
    */
    public function edit($id = null) {
        $user = $this->Auth->user();
        if (!$this->Forum->exists($id)) {
            throw new NotFoundException(__('Invalid forum'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Forum->save($this->request->data)) {
                        $this->Session->setFlash('El foro fue guardado exitosamente.', 'flash_success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('El foro no pudo ser guardado. Intente de nuevo.', 'flash_error');
            }
        } else {
            $options = array('conditions' => array('Forum.' . $this->Forum->primaryKey => $id),
                         'fields' => array('Forum.id', 'Forum.title', 'Forum.content', 'Forum.enabled', 'Forum.user_id', 'Forum.created', 'Forum.modified',
                                           'User.id', 'User.username', 'User.name', 'User.lastname', 'User.mail', 'User.role_id'),
                        );
            $this->request->data = $this->Forum->find('first', $options);
        }
        $users = $this->Forum->User->find('list');
        $this->set(compact('users', 'user'));
    }

    /**
    * delete method
    *
    * @throws NotFoundException
    * @param string $id
    * @return void
    */
    public function delete($id = null) {
        $user = $this->Auth->user();
        $this->Forum->id = $id;
        if (!$this->Forum->exists()) {
            throw new NotFoundException(__('Foro inválido'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Forum->delete()) {
            $this->Session->setFlash('El foro fue eliminado.', 'flash_success');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('El foro no pudo ser eliminado. Intente de nuevo.', 'flash_error');
        $this->redirect(array('action' => 'index'));
        $this->set(compact('user'));
    }
}
