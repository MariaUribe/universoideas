<?php
App::uses('AppController', 'Controller');
/**
 * RelatedImages Controller
 *
 * @property RelatedImage $RelatedImage
 */
class RelatedImagesController extends AppController {

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

            if(!empty($this->request->data['RelatedImage']['upload'])) {
                $file = $this->request->data['RelatedImage']['upload']; //put the data into a var for easy use
                
                $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                $arr_ext = array('jpg', 'jpeg', 'gif'); //set allowed extensions
       
                //only process if the extension is valid
                if(in_array($ext, $arr_ext)) {
                    //do the actual uploading of the file. First arg is the tmp name, second arg is 
                    //where we are putting it
                    move_uploaded_file($file["tmp_name"], '/Users/maya/NetBeansProjects/universoideas/app/webroot/img/uploads/' . $file['name']);

                    //prepare the filename for database entry
                    $this->request->data['RelatedImage']['uri'] = $file['name'];
                }
            }

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
