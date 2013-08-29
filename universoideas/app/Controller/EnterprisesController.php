<?php
App::uses('AppController', 'Controller');
/**
 * Enterprises Controller
 *
 * @property Enterprise $Enterprise
 */
class EnterprisesController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $user = $this->Auth->user();
        
        if(!empty($user)) {
            if($user['role_id'] === '1')
                $this->Auth->allow(array('index', 'view', 'add', 'edit', 'delete'));
            else
                $this->Auth->deny(array('index', 'view', 'add', 'edit', 'delete'));
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
        $this->Enterprise->recursive = 0;
        $this->set('enterprises', $this->paginate());
    }

    /**
    * view method
    *
    * @throws NotFoundException
    * @param string $id
    * @return void
    */
    public function view($id = null) {
        if (!$this->Enterprise->exists($id)) {
            throw new NotFoundException(__('Invalid enterprise'));
        }
        $options = array('conditions' => array('Enterprise.' . $this->Enterprise->primaryKey => $id));
        $this->set('enterprise', $this->Enterprise->find('first', $options));
    }

    /**
    * add method
    *
    * @return void
    */
    public function add() {
        if ($this->request->is('post')) {
            $this->Enterprise->create();
            if ($this->Enterprise->save($this->request->data)) {
                $this->Session->setFlash('La información de la empresa fue creada exitosamente.', 'flash_success');
                $this->publishPasantias();
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('La información de la empresa no pudo ser creada.', 'flash_error');
            }
        }
    }

    /**
    * edit method
    *
    * @throws NotFoundException
    * @param string $id
    * @return void
    */
    public function edit($id = null) {
        if (!$this->Enterprise->exists($id)) {
            throw new NotFoundException(__('Invalid enterprise'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Enterprise->save($this->request->data)) {
                $this->Session->setFlash('La información de la empresa fue modificada exitosamente.', 'flash_success');
                $this->publishPasantias();
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('La información de la empresa no pudo ser modificada. Intente de nuevo.', 'flash_error');
            }
        } else {
            $options = array('conditions' => array('Enterprise.' . $this->Enterprise->primaryKey => $id));
            $this->request->data = $this->Enterprise->find('first', $options);
        }
    }

    /**
    * delete method
    *
    * @throws NotFoundException
    * @param string $id
    * @return void
    */
    public function delete($id = null) {
        $this->Enterprise->id = $id;
        if (!$this->Enterprise->exists()) {
            throw new NotFoundException(__('Invalid enterprise'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Enterprise->delete()) {
            $this->Session->setFlash('La información de la empresa fue eliminada.', 'flash_success');
            $this->publishPasantias();
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('La información de la empresa no pudo ser eliminada.', 'flash_error');
        $this->redirect(array('action' => 'index'));
    }
    
    
    public function writeFile($data, $file_name) {
        $file = WWW_ROOT . 'includes/published/' . $file_name . '.htm';
        $handle = fopen($file, 'w') or die('Cannot open file:  '.$file);
        
        fwrite($handle, $data);
    }
    
    public function publishView($view, $file_name) {
        $result = $this->requestAction('/pages/' . $view, array('return')); 
        
        $this->writeFile($result, $file_name);
    }
    
    public function publishPasantias() {
        /* PUBLICAR MODULO DE EMPRESAS BUSCANDO PASANTES */
        $this->publishView("pasantias", "pasantias");
    }
}
