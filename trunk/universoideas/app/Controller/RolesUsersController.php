<?php
App::uses('AppController', 'Controller');
/**
 * RolesUsers Controller
 *
 * @property RolesUser $RolesUser
 */
class RolesUsersController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->RolesUser->recursive = 0;
		$this->set('rolesUsers', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->RolesUser->exists($id)) {
			throw new NotFoundException(__('Invalid roles user'));
		}
		$options = array('conditions' => array('RolesUser.' . $this->RolesUser->primaryKey => $id));
		$this->set('rolesUser', $this->RolesUser->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->RolesUser->create();
			if ($this->RolesUser->save($this->request->data)) {
				$this->Session->setFlash(__('The roles user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The roles user could not be saved. Please, try again.'));
			}
		}
		$roles = $this->RolesUser->Role->find('list');
		$users = $this->RolesUser->User->find('list');
		$this->set(compact('roles', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->RolesUser->exists($id)) {
			throw new NotFoundException(__('Invalid roles user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->RolesUser->save($this->request->data)) {
				$this->Session->setFlash(__('The roles user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The roles user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('RolesUser.' . $this->RolesUser->primaryKey => $id));
			$this->request->data = $this->RolesUser->find('first', $options);
		}
		$roles = $this->RolesUser->Role->find('list');
		$users = $this->RolesUser->User->find('list');
		$this->set(compact('roles', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->RolesUser->id = $id;
		if (!$this->RolesUser->exists()) {
			throw new NotFoundException(__('Invalid roles user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->RolesUser->delete()) {
			$this->Session->setFlash(__('Roles user deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Roles user was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
