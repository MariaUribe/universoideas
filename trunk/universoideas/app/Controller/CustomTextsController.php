<?php
App::uses('AppController', 'Controller');
/**
 * CustomTexts Controller
 *
 * @property CustomText $CustomText
 */
class CustomTextsController extends AppController {

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
        $this->CustomText->recursive = 0;
        $this->set('customTexts', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->CustomText->exists($id)) {
            throw new NotFoundException(__('Invalid custom text'));
        }
        $options = array('conditions' => array('CustomText.' . $this->CustomText->primaryKey => $id));
        $this->set('customText', $this->CustomText->find('first', $options));
    }
    
    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->CustomText->create();
            
            $upperCustomText = strtoupper($this->data['CustomText']['section']);
            $this->request->data['CustomText']['section'] = $upperCustomText;
            
            if ($this->CustomText->save($this->request->data)) {
                $this->Session->setFlash('El texto fue guardado exitosamente.', 'flash_success');
                $this->publishCustomText();
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('El texto no pudo ser guardado.', 'flash_error');
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
        if (!$this->CustomText->exists($id)) {
            throw new NotFoundException(__('Invalid custom text'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->CustomText->save($this->request->data)) {
                $this->Session->setFlash('El texto fue guardado exitosamente.', 'flash_success');
                $this->publishCustomText();
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('El texto no pudo ser guardado.', 'flash_error');
            }
        } else {
            $options = array('conditions' => array('CustomText.' . $this->CustomText->primaryKey => $id));
            $this->request->data = $this->CustomText->find('first', $options);
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
        $this->CustomText->id = $id;
        if (!$this->CustomText->exists()) {
            throw new NotFoundException(__('Invalid custom text'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->CustomText->delete()) {
            $this->Session->setFlash('El texto ha sido eliminado.', 'flash_success');
            $this->publishCustomText();
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('El texto no pudo ser eliminado.', 'flash_error');
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
    
    public function publishCustomText() {
        $this->publishView("terminos_detail", "terminos_legales");
        $this->publishView("contacto_detail", "contacto");
        $this->publishView("join", "join");
        $this->publishView("terminos_uso", "terminos_uso");
    }
    
    
}
