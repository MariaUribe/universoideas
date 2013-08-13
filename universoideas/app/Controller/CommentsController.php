<?php
App::uses('AppController', 'Controller');

/**
 * Comments Controller
 *
 * @property Comment $Comment
 */
class CommentsController extends AppController {
    
    public function beforeFilter() {
        parent::beforeFilter();
        $user = $this->Auth->user();
        
        if(!empty($user)) {
            if($user['id'] === '1')
                $this->Auth->allow(array('index', 'view', 'add', 'edit', 'delete'));
            else {
                $this->Auth->allow(array('view', 'add'));
                $this->Auth->deny(array('index'));
            }
        } else {
            $this->Auth->deny(array('index', 'add', 'edit', 'delete'));
        }
    }
    
    /**
    * index method
    *
    * @return void
    */
    public function index() {
        $this->loadModel('Forum');
        $user = $this->Auth->user();
        $forum_id = $this->params['url']['forum_id'];
        
        $this->paginate = array(
                        'fields' => array('Comment.id', 'Comment.description', 'Comment.forum_id', 'Comment.user_id', 'Comment.created', 'Comment.modified',
                                          'User.id', 'User.username', 'User.name', 'Forum.id','Forum.title'),
                        'conditions' => array('Comment.forum_id' => $forum_id),
                        'order' => array('Comment.modified' => 'desc')
                        );
        unset($this->Forum->virtualFields['count']);
        unset($this->Forum->virtualFields['max_comment']);
        $comments = $this->paginate('Comment');
        $options = array('conditions' => array('Forum.id' => $forum_id));
        $forum = $this->Forum->find('first', $options);
        $this->set(compact('comments', 'user', 'forum_id', 'forum'));
    } 

    /**
    * view method
    *
    * @throws NotFoundException
    * @param string $id
    * @return void
    */
    public function view($id = null) {
        $this->loadModel('User');
        if (!$this->Comment->exists($id)) {
            throw new NotFoundException(__('Invalid comment'));
        }
        $options = array('conditions' => array('Comment.' . $this->Comment->primaryKey => $id));
        $this->set('comment', $this->Comment->find('first', $options));
    }

    /**
    * add method
    *
    * @return void
    */
    public function add() {
        $this->layout = 'page';
        $this->set(compact('users', 'user'));
        $user = $this->Auth->user();
        if ($this->request->is('post')) {
            $this->Comment->create();
            $this->request->data['Comment']['user_id'] = $user['id'];
            $forum_id = $this->params['url']['forum_id'];
            $this->request->data['Comment']['forum_id'] = $forum_id;
            if ($this->Comment->save($this->request->data)) {
                $this->Session->setFlash(__('Tu comentario fue enviado con éxito.'));
                $this->redirect(array('controller' => 'forums', 'action' => 'view/' . $forum_id));
            } else {
                $this->Session->setFlash(__('El comentario no pudo ser enviado. Intenta nuevamente.'));
            }
        }
        $forums = $this->Comment->Forum->find('list');
        $users = $this->Comment->User->find('list');
        $this->set(compact('forums', 'users', 'user'));
    }

    /**
    * edit method
    *
    * @throws NotFoundException
    * @param string $id
    * @return void
    */
    public function edit($id = null) {
        if (!$this->Comment->exists($id)) {
            throw new NotFoundException(__('Invalid comment'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Comment->save($this->request->data)) {
                $this->Session->setFlash('El comentario fue guardado exitosamente.', 'flash_success');
                $this->redirect(array('action' => 'index?forum_id=' . $id));
            } else {
                $this->Session->setFlash('El comentario no pudo ser guardado. Intente de nuevo.', 'flash_error');
            }
        } else {
            $options = array('conditions' => array('Comment.' . $this->Comment->primaryKey => $id));
            $this->request->data = $this->Comment->find('first', $options);
            
        }
        $forums = $this->Comment->Forum->find('list');
        $users = $this->Comment->User->find('list');
        $comment = $this->Comment->find('first', $options);
        $this->set(compact('forums', 'users', 'comment'));
    }

    /**
    * delete method
    *
    * @throws NotFoundException
    * @param string $id
    * @return void
    */
    public function delete($id = null) {
        $this->Comment->id = $id;
        if (!$this->Comment->exists()) {
            throw new NotFoundException(__('Invalid comment'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Comment->delete()) {
            $this->Session->setFlash('El comentario fue eliminado.', 'flash_success');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('El comentario no pudo ser eliminado. Intente de nuevo.', 'flash_error');
        $this->redirect(array('action' => 'index'));
    }
}
