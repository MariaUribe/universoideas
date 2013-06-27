<?php
App::uses('AppController', 'Controller');
/**
 * UsersRoles Controller
 *
 * @property UsersRole $UsersRole
 */
class UsersRolesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->UsersRole->recursive = 0;
		$this->set('usersRoles', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UsersRole->exists($id)) {
			throw new NotFoundException(__('Invalid users role'));
		}
		$options = array('conditions' => array('UsersRole.' . $this->UsersRole->primaryKey => $id));
		$this->set('usersRole', $this->UsersRole->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UsersRole->create();
			if ($this->UsersRole->save($this->request->data)) {
				$this->Session->setFlash(__('The users role has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The users role could not be saved. Please, try again.'));
			}
		}
		$users = $this->UsersRole->User->find('list');
		$roles = $this->UsersRole->Role->find('list');
		$this->set(compact('users', 'roles'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->UsersRole->exists($id)) {
			throw new NotFoundException(__('Invalid users role'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->UsersRole->save($this->request->data)) {
				$this->Session->setFlash(__('The users role has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The users role could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UsersRole.' . $this->UsersRole->primaryKey => $id));
			$this->request->data = $this->UsersRole->find('first', $options);
		}
		$users = $this->UsersRole->User->find('list');
		$roles = $this->UsersRole->Role->find('list');
		$this->set(compact('users', 'roles'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->UsersRole->id = $id;
		if (!$this->UsersRole->exists()) {
			throw new NotFoundException(__('Invalid users role'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->UsersRole->delete()) {
			$this->Session->setFlash(__('Users role deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Users role was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
