<?php
App::uses('AppController', 'Controller');
/**
 * RelatedImages Controller
 *
 * @property RelatedImage $RelatedImage
 */
class RelatedImagesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->RelatedImage->recursive = 0;
		$this->set('relatedImages', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->RelatedImage->exists($id)) {
			throw new NotFoundException(__('Invalid related image'));
		}
		$options = array('conditions' => array('RelatedImage.' . $this->RelatedImage->primaryKey => $id));
		$this->set('relatedImage', $this->RelatedImage->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->RelatedImage->create();
			if ($this->RelatedImage->save($this->request->data)) {
				$this->Session->setFlash(__('The related image has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The related image could not be saved. Please, try again.'));
			}
		}
		$articles = $this->RelatedImage->Article->find('list');
		$this->set(compact('articles'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->RelatedImage->exists($id)) {
			throw new NotFoundException(__('Invalid related image'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->RelatedImage->save($this->request->data)) {
				$this->Session->setFlash(__('The related image has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The related image could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('RelatedImage.' . $this->RelatedImage->primaryKey => $id));
			$this->request->data = $this->RelatedImage->find('first', $options);
		}
		$articles = $this->RelatedImage->Article->find('list');
		$this->set(compact('articles'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->RelatedImage->id = $id;
		if (!$this->RelatedImage->exists()) {
			throw new NotFoundException(__('Invalid related image'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->RelatedImage->delete()) {
			$this->Session->setFlash(__('Related image deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Related image was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
