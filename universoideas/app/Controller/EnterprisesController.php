<?php
App::uses('AppController', 'Controller');
/**
 * Enterprises Controller
 *
 * @property Enterprise $Enterprise
 */
class EnterprisesController extends AppController {

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
				$this->Session->setFlash(__('The enterprise has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The enterprise could not be saved. Please, try again.'));
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
				$this->Session->setFlash(__('The enterprise has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The enterprise could not be saved. Please, try again.'));
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
			$this->Session->setFlash(__('Enterprise deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Enterprise was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
