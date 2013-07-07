<?php
App::uses('AppController', 'Controller', 'RelatedImagesController');
App::import('Controller', 'RelatedImagesController');
App::import('Model', 'RelatedImage', 'RelatedVideo');

include("Component/resize-class.php");  

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
                    $this->loadModel('RelatedVideo');
                    
			$this->Article->create();
			if ($this->Article->save($this->request->data)) {
                            $article_id = $this->Article->getLastInsertId();
                            
                            $this->request->data['RelatedImage']['article_id'] = $article_id;
                            $this->request->data['RelatedVideo']['article_id'] = $article_id;
                            
                            if(!empty($this->request->data['RelatedImage']['upload'])) {
                                $file = $this->request->data['RelatedImage']['upload']; //put the data into a var for easy use

                                $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                                $title = strstr($file['name'], '.', true);  //get the name alone
                                
                                
                                $arr_ext = array('jpg', 'jpeg', 'gif'); //set allowed extensions
                                $width_thumb = 440;
                                
                                //only process if the extension is valid
                                if(in_array($ext, $arr_ext)) {
                                    $img_path = WWW_ROOT . 'img/uploads/' . $file['name'];
                                    move_uploaded_file($file["tmp_name"], $img_path);
                                    
                                    list($width, $height) = getimagesize($img_path);
                                  
                                    // *** 1) Initialise / load image
                                    $resizeObj = new resize($img_path);

                                    // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
                                    $height_thumb = $resizeObj -> getSizeByFixedWidth($width_thumb);
                                    $resizeObj -> resizeImage($width_thumb, $height_thumb, 'crop');
                                    $thumb = WWW_ROOT . 'img/uploads/' . $title . '_thumb.' . $ext;
                                    $uri_thumb = '/app/webroot/img/uploads/' . $title . '_thumb.' . $ext;

                                    // *** 3) Save image
                                    $resizeObj -> saveImage($thumb, 100);
                                    
                                    //prepare the filename for database entry
                                    $this->request->data['RelatedImage']['uri'] = $img_path;
                                    $this->request->data['RelatedImage']['name'] = $file['name'];
                                    $this->request->data['RelatedImage']['title'] = $title;
                                    $this->request->data['RelatedImage']['width'] = $width;
                                    $this->request->data['RelatedImage']['height'] = $height;
                                    $this->request->data['RelatedImage']['uri_thumb'] = $uri_thumb;
                                    $this->request->data['RelatedImage']['width_thumb'] = $width_thumb;
                                    $this->request->data['RelatedImage']['height_thumb'] = $height_thumb;
                                    
                                }
                            }
                            
                            if(($this->RelatedImage->save($this->request->data)) || ($this->RelatedVideo->save($this->request->data))){
                                $this->Session->setFlash('El artículo fue guardado exitosamente.', 'flash_success');
                                $this->redirect(array('action' => 'index'));
                            } else {
                                $this->Session->setFlash('Error: El archivo multimedia asociado no pudo ser guardado.', 'flash_error');
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
