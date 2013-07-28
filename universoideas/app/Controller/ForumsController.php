<?php
App::uses('AppController', 'Controller');

/**
 * Forums Controller
 *
 * @property Forum $Forum
 */
class ForumsController extends AppController {

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
            $this->Auth->deny(array('index', 'view', 'add', 'edit', 'delete'));
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
        
        $this->paginate = array(
            'conditions' => array('Forum.user_id' => $user_id),
            'order' => array('Forum.modified' => 'desc')
            );
        $forums = $this->paginate('Forum');
        $this->set(compact('forums'));
    }

    /**
    * view method
    *
    * @throws NotFoundException
    * @param string $id
    * @return void
    */
    public function view($id = null) {
        if (!$this->Forum->exists($id)) {
            throw new NotFoundException(__('Invalid forum'));
        }
        $options = array('conditions' => array('Forum.' . $this->Forum->primaryKey => $id));
        $this->set('forum', $this->Forum->find('first', $options));
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
                $this->Session->setFlash(__('El foro fue creado exitosamente.'));
                $this->redirect(array('controller' => 'forums','action' => 'index'));
            } else {
                $this->Session->setFlash(__('The forum could not be saved. Please, try again.'));
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
        if (!$this->Forum->exists($id)) {
            throw new NotFoundException(__('Invalid forum'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Forum->save($this->request->data)) {
                $this->Session->setFlash(__('The forum has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The forum could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Forum.' . $this->Forum->primaryKey => $id));
            $this->request->data = $this->Forum->find('first', $options);
        }
        $users = $this->Forum->User->find('list');
        $this->set(compact('users'));
    }

    /**
    * delete method
    *
    * @throws NotFoundException
    * @param string $id
    * @return void
    */
    public function delete($id = null) {
        $this->Forum->id = $id;
        if (!$this->Forum->exists()) {
            throw new NotFoundException(__('Invalid forum'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Forum->delete()) {
            $this->Session->setFlash(__('Forum deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Forum was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
}
