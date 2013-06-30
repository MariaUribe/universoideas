<?php
App::uses('AppController', 'Controller', 'RelatedImagesController');
App::import('Controller', 'RelatedImagesController');
App::import('Model', 'RelatedImage');
/**
 * Articles Controller
 *
 * @property Article $Article
 */
class ArticlesController extends AppController {
    
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Article->recursive = 0;
		$this->set('articles', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Article->exists($id)) {
			throw new NotFoundException(__('Invalid article'));
		}
		$options = array('conditions' => array('Article.' . $this->Article->primaryKey => $id));
		$this->set('article', $this->Article->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
        public function add() {
		if ($this->request->is('post')) {
                    $this->loadModel('RelatedImage');
                    
			$this->Article->create();
			if ($this->Article->save($this->request->data)) {
                            $article_id = $this->Article->getLastInsertId();
                            
                            $this->request->data['RelatedImage']['article_id'] = $article_id;
                            if($this->RelatedImage->save($this->request->data)){
                                $this->Session->setFlash('El artículo fue guardado exitosamente.', 'flash_success');
                                $this->redirect(array('action' => 'index'));
                            } else {
                                $this->Session->setFlash('Error: La imagen asociada no pudo ser guardada.', 'flash_error');
                                $this->redirect(array('action' => 'index'));
                            }
                            
			} else {
				$this->Session->setFlash(__('El artículo no pudo ser guardado. Intente de nuevo.'));
			}
		}
		$users = $this->Article->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Article->exists($id)) {
			throw new NotFoundException(__('Invalid article'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Article->save($this->request->data)) {
				$this->Session->setFlash(__('The article has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The article could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Article.' . $this->Article->primaryKey => $id));
			$this->request->data = $this->Article->find('first', $options);
		}
		$users = $this->Article->User->find('list');
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
		$this->Article->id = $id;
		if (!$this->Article->exists()) {
			throw new NotFoundException(__('Invalid article'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Article->delete()) {
			$this->Session->setFlash(__('Article deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Article was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
