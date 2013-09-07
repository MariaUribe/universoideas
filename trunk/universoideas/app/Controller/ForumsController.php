<?php
App::uses('AppController', 'Controller');

/**
 * Forums Controller
 *
 * @property Forum $Forum
 */
class ForumsController extends AppController {
    
    public $paginate = array( 
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
            if($user['role_id'] === '1')
                $this->Auth->allow(array('index', 'view', 'add', 'edit', 'delete', 'forum_detail'));
            else {
                $this->Auth->allow(array('view', 'add', 'edit_forum', 'delete', 'forum_detail'));
                $this->Auth->deny(array('index', 'edit'));
            }
        } else {
            $this->Auth->allow(array('view'));
            $this->Auth->deny(array('index', 'add', 'edit', 'delete', 'edit_forum'));
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
    * view method
    *
    * @throws NotFoundException
    * @param string $id
    * @return void
    */
    public function view($id = null) {
        $this->layout = 'page';
                    
        $user = $this->Auth->user();
        
        if (!$this->Forum->exists($id)) {
            throw new NotFoundException(__('Invalid forum'));
        }
        
        $this->set(compact('id', 'user', 'result'));
    }
    
    public function forum_detail($id = null) {
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
                $forum_id = $this->Forum->getLastInsertId();
                $this->Session->setFlash('El foro fue guardado exitosamente.', 'flash_success');
                $this->publishForum($forum_id);
                $this->publishForums($user['id']);
                $this->redirect("/pages/forums"); 
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
        $options = array('conditions' => array('Forum.' . $this->Forum->primaryKey => $id),
                             'fields' => array('Forum.id', 'Forum.title', 'Forum.content', 'Forum.enabled', 'Forum.user_id', 'Forum.created', 'Forum.modified',
                                               'User.id', 'User.username', 'User.name', 'User.lastname', 'User.mail', 'User.role_id'),
                            );
        $forum = $this->Forum->find('first', $options);
        
        if (!$this->Forum->exists($id)) {
            throw new NotFoundException(__('Invalid forum'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Forum->save($this->request->data)) {
                $this->Session->setFlash('El foro fue guardado exitosamente.', 'flash_success');
                $this->publishForum($id);
                $this->publishForums($forum['Forum']['user_id']);
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
    * edit_forum method
    *
    * @throws NotFoundException
    * @param string $id
    * @return void
    */
    public function edit_forum($id = null) {
        $this->layout = 'page';
        
        $user = $this->Auth->user();
        $options = array('conditions' => array('Forum.' . $this->Forum->primaryKey => $id),
                         'fields' => array('Forum.id', 'Forum.title', 'Forum.content', 'Forum.enabled', 'Forum.user_id', 'Forum.created', 'Forum.modified',
                                           'User.id', 'User.username', 'User.name', 'User.lastname', 'User.mail', 'User.role_id'),
                        );
        $forum = $this->Forum->find('first', $options);
        $user_id = $forum['Forum']['user_id'];
        
        if (!$this->Forum->exists($id)) {
            throw new NotFoundException(__('Invalid forum'));
        }
        
        if($user_id !== $this->Auth->user('id')){
            $this->redirect(array('controller' => 'pages','action' => 'list_all'));
        } else {
            if ($this->request->is('post') || $this->request->is('put')) {
                if ($this->Forum->save($this->request->data)) {
                    $this->Session->setFlash('El foro fue guardado exitosamente.', 'flash_success');
                    $this->publishForum($id);
                    $this->publishForums($user_id);
                    $this->redirect(array('controller' => 'pages','action' => 'list_all'));
                } else {
                    $this->Session->setFlash('El foro no pudo ser guardado. Intente de nuevo.', 'flash_error');
                }
            } else {
                $this->request->data = $this->Forum->find('first', $options);
            }
            
        }
  
        $users = $this->Forum->User->find('list');
        $this->set(compact('users', 'user', 'forum'));
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
        $options = array('conditions' => array('Forum.' . $this->Forum->primaryKey => $id),
                         'fields' => array('Forum.id', 'Forum.title', 'Forum.content', 'Forum.enabled', 'Forum.user_id', 'Forum.created', 'Forum.modified',
                                           'User.id', 'User.username', 'User.name', 'User.lastname', 'User.mail', 'User.role_id'),
                        );
        $forum = $this->Forum->find('first', $options);
        $user_id = $forum['Forum']['user_id'];
        
        
        if (!$this->Forum->exists()) {
            throw new NotFoundException(__('Foro inválido'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Forum->delete()) {
            $this->Session->setFlash('El foro fue eliminado.', 'flash_success');
            $this->publishForums($user_id);
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('El foro no pudo ser eliminado. Intente de nuevo.', 'flash_error');
        $this->redirect(array('action' => 'index'));
        $this->set(compact('user'));
    }

    public function writeFile($data, $file_name) {
        $file = WWW_ROOT . 'includes/published/' . $file_name . '.htm';
        $handle = fopen($file, 'w') or die('Cannot open file:  '.$file);
        
        fwrite($handle, $data);
    }
    
    public function publishView($view, $file_name) {
        $result = $this->requestAction($view, array('return')); 
        
        $this->writeFile($result, $file_name);
    }
    
    public function publishForum($id) {
        $this->publishView("/forums/forum_detail/" . $id, "forums/detail/forum-" . $id);
    }
    
    public function publishForums($user_id) {
        /* PUBLICAR TEMAS DEL FORO */
        $this->publishView("/pages/forums_table", "forums_table");
        $this->publishView("/pages/list_all_table/" . $user_id, "forums/rios/list_all_table_" . $user_id);
    }
}
