<?php
App::uses('AppController', 'Controller');
/**
 * UsersArticles Controller
 *
 * @property UsersArticle $UsersArticle
 */
class UsersArticlesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->UsersArticle->recursive = 0;
		$this->set('usersArticles', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UsersArticle->exists($id)) {
			throw new NotFoundException(__('Invalid users article'));
		}
		$options = array('conditions' => array('UsersArticle.' . $this->UsersArticle->primaryKey => $id));
		$this->set('usersArticle', $this->UsersArticle->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UsersArticle->create();
			if ($this->UsersArticle->save($this->request->data)) {
				$this->Session->setFlash(__('The users article has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The users article could not be saved. Please, try again.'));
			}
		}
		$users = $this->UsersArticle->User->find('list');
		$articles = $this->UsersArticle->Article->find('list');
		$this->set(compact('users', 'articles'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->UsersArticle->exists($id)) {
			throw new NotFoundException(__('Invalid users article'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->UsersArticle->save($this->request->data)) {
				$this->Session->setFlash(__('The users article has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The users article could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UsersArticle.' . $this->UsersArticle->primaryKey => $id));
			$this->request->data = $this->UsersArticle->find('first', $options);
		}
		$users = $this->UsersArticle->User->find('list');
		$articles = $this->UsersArticle->Article->find('list');
		$this->set(compact('users', 'articles'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->UsersArticle->id = $id;
		if (!$this->UsersArticle->exists()) {
			throw new NotFoundException(__('Invalid users article'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->UsersArticle->delete()) {
			$this->Session->setFlash(__('Users article deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Users article was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
