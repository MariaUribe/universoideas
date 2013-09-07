<?php
App::uses('AppController', 'Controller');
/**
 * Emprendedores Controller
 *
 * @property Emprendedore $Emprendedore
 */
class EmprendedoresController extends AppController {

    
    public $paginate = array(
        'order' => array(
            'Emprendedore.modified' => 'desc'
        )
    );
    
    public function beforeFilter() {
        parent::beforeFilter();
        $user = $this->Auth->user();
        
        if(!empty($user)) {
            if($user['role_id'] === '1')
                $this->Auth->allow(array('index', 'view', 'add', 'edit', 'delete', 'emprendedor_detail'));
            else {
                $this->Auth->allow(array('view', 'add', 'edit_emprendimiento', 'delete', 'emprendedor_detail'));
                $this->Auth->deny(array('index', 'edit'));
            }
        } else {
            $this->Auth->deny(array('view', 'index', 'add', 'edit', 'delete', 'edit_emprendedor'));
        }
    }
    
    /**
    * index method
    *
    * @return void
    */
    public function index() {
        $this->Emprendedore->recursive = 0;
        $this->set('emprendedores', $this->paginate());
    }
    
    public function emprendedor_detail($id = null) {
        $this->layout = 'page';
        $this->loadModel('User');
        
        $user = $this->Auth->user();
        
        if (!$this->Emprendedore->exists($id)) {
            throw new NotFoundException(__('Invalid emprendedore'));
        }
        
        $options = array('conditions' => array('Emprendedore.' . $this->Emprendedore->primaryKey => $id),
                         'fields' => array('Emprendedore.id', 'Emprendedore.title', 'Emprendedore.resume', 'Emprendedore.description', 'Emprendedore.status', 'Emprendedore.created', 'Emprendedore.modified', 'Emprendedore.user_id',
                                           'User.id', 'User.username', 'User.name', 'User.lastname', 'User.mail', 'User.role_id'));
        $emprendedores = $this->Emprendedore->find('first', $options);
        
        $this->set(compact('emprendedores', 'user'));
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
        
        if (!$this->Emprendedore->exists($id)) {
            throw new NotFoundException(__('Invalid emprendedore'));
        }
        $user = $this->Auth->user();
        $options = array('conditions' => array('Emprendedore.' . $this->Emprendedore->primaryKey => $id));
        $emprends = $this->Emprendedore->find('first', $options);
        
        if($emprends['Emprendedore']['user_id'] !== $this->Auth->user('id')){
            $this->redirect("/pages/mis_emprendimientos");
        } else {
            $options = array('conditions' => array('Emprendedore.' . $this->Emprendedore->primaryKey => $id));
            $this->set('emprendedore', $this->Emprendedore->find('first', $options));
        }
        
        $this->set(compact('id', 'user'));
    }

    /**
    * add method
    *
    * @return void
    */
    public function add() {
        $this->layout = 'page';
        $user = $this->Auth->user();
        $user_id = $user['id'];
        
        if ($this->request->is('post')) {
            $this->Emprendedore->create();
            $this->request->data['Emprendedore']['user_id'] = $user_id;
            $this->request->data['Emprendedore']['status'] = 'PA'; // Por aprobar 
            
            if ($this->Emprendedore->save($this->request->data)) {
                $emp_id = $this->Emprendedore->getLastInsertId();
                $this->Session->setFlash('Su información ha sido guardada exitosamente.', 'flash_success');
                $this->publishEmprendedor($emp_id);
                $this->publishEmprendedores($user_id);
                $this->redirect("/pages/emprendedores"); 
            } else {
                $this->Session->setFlash('Su información no pudo ser procesada. Intente de nuevo.', 'flash_error');
            }
        }
        $users = $this->Emprendedore->User->find('list');
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
        $this->loadModel('User');
        $user = $this->Auth->user();
        
        $options = array('conditions' => array('Emprendedore.' . $this->Emprendedore->primaryKey => $id));
        $emprends = $this->Emprendedore->find('first', $options);
        
        unset($this->User->Forum->virtualFields['count']);
        unset($this->User->Forum->virtualFields['max_comment']);
        $options2 = array('conditions' => array('User.id' => $emprends['Emprendedore']['user_id']));
        $user_emp = $this->User->find('first', $options2);
        
        if (!$this->Emprendedore->exists($id)) {
            throw new NotFoundException(__('Invalid emprendedore'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Emprendedore->save($this->request->data)) {
                $this->Session->setFlash('Su información ha sido guardada exitosamente.', 'flash_success');
                $this->publishEmprendedor($id);
                $this->publishEmprendedores($emprends['Emprendedore']['user_id']);
                $this->redirect("/emprendedores");
            } else {
                $$this->Session->setFlash('Su información no pudo ser procesada. Intente de nuevo.', 'flash_error');
            }
        } else {
            $options = array('conditions' => array('Emprendedore.' . $this->Emprendedore->primaryKey => $id));
            $this->request->data = $this->Emprendedore->find('first', $options);
        }
        
        $status = array("PA" => "Por Aprobar", 
                         "AP" => "Aprobado",
                         "RE" => "Rechazado"
                        );
        
        $users = $this->Emprendedore->User->find('list');
        $this->set(compact('users', 'status', 'user_emp'));
    }
        
    /**
    * edit method
    *
    * @throws NotFoundException
    * @param string $id
    * @return void
    */
    public function edit_emprendimiento($id = null) {
        $this->layout = 'page';
        $user = $this->Auth->user();
        $user_id = $user['id'];
        
        $options = array('conditions' => array('Emprendedore.' . $this->Emprendedore->primaryKey => $id));
        $emprends = $this->Emprendedore->find('first', $options);
        
        if (!$this->Emprendedore->exists($id)) {
            throw new NotFoundException(__('Invalid emprendedore'));
        }
        
        if($emprends['Emprendedore']['user_id'] !== $this->Auth->user('id')){
            $this->redirect("/pages/mis_emprendimientos");
        } else {
            if ($this->request->is('post') || $this->request->is('put')) {
                if ($this->Emprendedore->save($this->request->data)) {
                    $this->Session->setFlash('Su información ha sido guardada exitosamente.', 'flash_success');
                    $this->publishEmprendedor($id);
                    $this->publishEmprendedores($emprends['Emprendedore']['user_id']);
                    $this->redirect("/pages/mis_emprendimientos"); 
                } else {
                    $this->Session->setFlash('Su información no pudo ser procesada. Intente de nuevo.', 'flash_error');
                }
            } else {
                $options = array('conditions' => array('Emprendedore.' . $this->Emprendedore->primaryKey => $id));
                $this->request->data = $this->Emprendedore->find('first', $options);
            }
        }
        $users = $this->Emprendedore->User->find('list');
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
        $options = array('conditions' => array('Emprendedore.' . $this->Emprendedore->primaryKey => $id));
        $emprends = $this->Emprendedore->find('first', $options);
        
        $this->Emprendedore->id = $id;
        if (!$this->Emprendedore->exists()) {
                throw new NotFoundException(__('Invalid emprendedore'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Emprendedore->delete()) {
            $this->Session->setFlash('Su información ha sido eliminada.', 'flash_success');
            $this->publishEmprendedores($emprends['Emprendedore']['user_id']);
            $this->redirect("/emprendedores");
        }
        $this->Session->setFlash('Su información no pudo ser eliminada. Intente de nuevo.', 'flash_error');
        $this->redirect(array('action' => 'index'));
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
    
    public function publishEmprendedor($id) {
        $this->publishView("/emprendedores/emprendedor_detail/" . $id, "emprendedores/detail/emprendedor-" . $id);
    }
    
    public function publishEmprendedores($user_id) {
        $this->publishView("/pages/emprendedores_table", "emprendedores_table");
        $this->publishView("/pages/mis_emprendimientos_table/" . $user_id, "emprendedores/rios/mis_emprendimientos_table_" . $user_id);
    }
}
