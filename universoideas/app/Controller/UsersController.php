<?php
App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

    /**
    * beforeFilter method
    * Permite al usuario entrar a users/add 
    * sin estar logueado
    * @return void
    */

    public function beforeFilter() {
        parent::beforeFilter();
        $user = $this->Auth->user();
        
        if(!empty($user)) {
            $this->Auth->allow(array('index', 'view', 'add', 'edit', 'logout'));
        } else {
            $this->Auth->allow('add');
            $this->Auth->deny(array('index', 'view', 'edit', 'delete'));
        }
    }
    
    /**
    * login method
    *
    * @return void
    */
    public function login() {
        $this->layout = 'page';
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash('Nombre de usuario y/o contraseña inválidos. Intente de nuevo.', 'flash_error');
            }
        }
        $genders = array("F" => "Femenino", 
                         "M" => "Masculino"
                        );
        $this->set(compact('genders'));
    }

    /**
    * logout method
    *
    * @return void
    */
    public function logout() {
        $this->redirect($this->Auth->logout());
    }
    
    /**
    * index method
    *
    * @return void
    */
    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    /**
    * view method
    *
    * @throws NotFoundException
    * @param string $id
    * @return void
    */
    public function view($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $this->set('user', $this->User->find('first', $options));
    }

    /**
    * add method
    *
    * @return void
    */
    public function add() {
        $this->layout = 'page';
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->redirect(array('controller' => 'pages','action' => 'home'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
        $roles = $this->User->Role->find('list');
        $this->set(compact('roles'));
    }

    /**
    * edit method
    *
    * @throws NotFoundException
    * @param string $id
    * @return void
    */
    public function edit($id = null) {
        $this->layout = 'page';
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->redirect(array('controller' => 'pages','action' => 'home'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
        }
        $user = $this->Auth->user();
        $roles = $this->User->Role->find('list');
        $genders = array("F" => "Femenino", 
                         "M" => "Masculino"
                        );
        $this->set(compact('roles', 'user', 'genders'));
    }

    /**
    * delete method
    *
    * @throws NotFoundException
    * @param string $id
    * @return void
    */
    public function delete($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
}
