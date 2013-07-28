<?php
App::uses('AppController', 'Controller');
/**
 * RelatedVideos Controller
 *
 * @property RelatedVideo $RelatedVideo
 */
class RelatedVideosController extends AppController {

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
		$this->RelatedVideo->recursive = 0;
		$this->set('relatedVideos', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->RelatedVideo->exists($id)) {
			throw new NotFoundException(__('Invalid related video'));
		}
		$options = array('conditions' => array('RelatedVideo.' . $this->RelatedVideo->primaryKey => $id));
		$this->set('relatedVideo', $this->RelatedVideo->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->RelatedVideo->create();
			if ($this->RelatedVideo->save($this->request->data)) {
				$this->Session->setFlash(__('The related video has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The related video could not be saved. Please, try again.'));
			}
		}
		$articles = $this->RelatedVideo->Article->find('list');
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
		if (!$this->RelatedVideo->exists($id)) {
			throw new NotFoundException(__('Invalid related video'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->RelatedVideo->save($this->request->data)) {
				$this->Session->setFlash(__('The related video has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The related video could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('RelatedVideo.' . $this->RelatedVideo->primaryKey => $id));
			$this->request->data = $this->RelatedVideo->find('first', $options);
		}
		$articles = $this->RelatedVideo->Article->find('list');
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
		$this->RelatedVideo->id = $id;
		if (!$this->RelatedVideo->exists()) {
			throw new NotFoundException(__('Invalid related video'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->RelatedVideo->delete()) {
			$this->Session->setFlash(__('Related video deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Related video was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
