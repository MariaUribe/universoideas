<?php
App::uses('AppController', 'Controller', 'RelatedImagesController');
App::import('Controller', 'RelatedImagesController');
App::import('Model', 'RelatedImage', 'RelatedVideo');
//App::import('Time');
//App::uses('CakeTime', 'Utility');

include("Component/resize-class.php");

/**
 * Articles Controller
 *
 * @property Article $Article
 */
class ArticlesController extends AppController {
    
//    public $helpers = array('Form', 'Html', 'Js', 'Time');

//    public $paginate = array(
//        'order' => array(
//            'Article.modified' => 'desc'
//        )
//    );
    
    public function beforeFilter() {
        parent::beforeFilter();
        $user = $this->Auth->user();
        
        if(!empty($user)) {
            if($user['role_id'] === '1') {
                $this->Auth->allow(array('index', 'view', 'add', 'edit', 'delete'));
            } else {
                $this->Auth->deny(array('index', 'view', 'add', 'edit', 'delete'));
            }
        } else {
            $this->Auth->deny(array('index', 'view', 'add', 'edit', 'delete'));
        }
    }
    
    public function isAuthorized($user) {
        
        if($user['role_id'] === '1') {
            if ($this->action === 'add' || $this->action === 'edit' ||
                $this->action === 'view' || $this->action === 'index' || $this->action === 'delete') {
                return true;
            } else {
                return false;
            }
        }
        
        return parent::isAuthorized($user);
    }
    
    /**
    * index method
    *
    * @return void
    */
    public function index() {
        $user_id = $this->Auth->user('id');
        
        $this->Article->recursive = 0;
        $articles = $this->Article->find('all');
        
        $this->set('articles', $articles);
        $this->set('user_id', $user_id);
    }
//    public function index() {
//        $user_id = $this->Auth->user('id');
//        $this->Article->recursive = 0;
//        $this->set('articles', $this->paginate());
//        $this->set('user_id', $user_id);
//    }

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

                $selectedMedia = $this->request->data['Article']['media'];
                
                if($selectedMedia == 'imagen') {
                    $this->request->data['RelatedImage']['article_id'] = $article_id;
                    
                    if(!empty($this->request->data['RelatedImage']['upload'])) {
                        $this->manageImage($article_id);
                    }

                    if($this->RelatedImage->save($this->request->data)){
                        $this->Session->setFlash('El artículo fue guardado exitosamente.', 'flash_success');
                        $this->publishAll();
                        $this->publishArticle($article_id);
                        $this->redirect(array('action' => 'index'));
                    } else {
                        $this->Session->setFlash('La imagen no pudo ser guardada.', 'flash_error');
                        $this->redirect(array('action' => 'index'));
                    }
                    
                } else if($selectedMedia == 'video') {
                    $this->request->data['RelatedVideo']['article_id'] = $article_id;
                    $this->request->data['RelatedVideo']['name'] = 'video';
                    
                    if($this->RelatedVideo->save($this->request->data)) {
                        $this->Session->setFlash('El artículo fue guardado exitosamente.', 'flash_success');
                        $this->publishAll();
                        $this->publishArticle($article_id);
                        $this->redirect(array('action' => 'index'));
                    } else {
                        $this->Session->setFlash('El video no pudo ser guardado.', 'flash_error');
                        $this->redirect(array('action' => 'index'));
                    }
                } else { 
                    $this->Session->setFlash('El artículo fue guardado exitosamente.', 'flash_success');
                    $this->publishAll();
                    $this->publishArticle($article_id);
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash(__('El artículo no pudo ser guardado. Intente de nuevo.'));
            }
        }
        
        $users = $this->Article->User->find('list');
        $channels = array("principal" => "Principal", 
                          "encuentrame" => "Encuéntrame", 
                          "rumba" => "Rumba", 
                          "arte" => "Arte y Cultura", 
                          "ciencia" => "Ciencia y Tecnología", 
                          "sexualidad" => "Sexualidad al día", 
                          "moda" => "Moda"
                         );
        
        $this->set(compact('users', 'channels'));
    }
    
    /**
    * edit method
    *
    * @throws NotFoundException
    * @param string $id
    * @return void
    */
    public function edit($id = null) {
        $this->loadModel('RelatedImage');
        $this->loadModel('RelatedVideo');
        
        if (!$this->Article->exists($id)) {
            throw new NotFoundException(__('Invalid article'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Article->save($this->request->data)) {
                
                $selectedMedia = $this->request->data['Article']['media'];
                $image_id = $this->request->data['RelatedImage']['id'];
                $video_id = $this->request->data['RelatedVideo']['id'];
                
                if($selectedMedia == 'imagen') {
                    $this->request->data['RelatedImage']['article_id'] = $id;
                    
                    if(!empty($this->request->data['RelatedImage']['upload'])) {
                        $this->manageImage($id);
                    }
                    
                    if($image_id != null)
                        $result_img = $this->editRelatedImage($image_id);
                    else {
                        if($this->RelatedImage->save($this->request->data)){
                            $this->Session->setFlash('El artículo fue guardado exitosamente.', 'flash_success');
                            $this->publishArticle($id);
                            $this->publishAll();
                            $this->redirect(array('action' => 'index'));
                        } else {
                            $this->Session->setFlash('La imagen no pudo ser guardada.', 'flash_error');
                            $this->redirect(array('action' => 'index'));
                        }
                    }
                    
                    if($video_id != null && $video_id > 0)
                        $this->deleteRelatedVideo($video_id);
                    
                    if($result_img == 1) {
                        $this->Session->setFlash('El artículo fue guardado exitosamente.', 'flash_success');
                        $this->publishArticle($id);
                        $this->publishAll();
                        $this->redirect(array('action' => 'index'));
                    } else {
                        $this->Session->setFlash('La imagen no pudo ser guardada.', 'flash_error');
                        $this->redirect(array('action' => 'index'));
                    }
                    
                } else if($selectedMedia == 'video') {
                    $this->request->data['RelatedVideo']['article_id'] = $id;
                    $this->request->data['RelatedVideo']['name'] = 'video';
                    $result_vid = 0;
                    
                    if($video_id != null)
                        $result_vid = $this->editRelatedVideo($video_id);
                    else {
                        if($this->RelatedVideo->save($this->request->data)) {
                            $this->Session->setFlash('El artículo fue guardado exitosamente.', 'flash_success');
                            $this->publishArticle($id);
                            $this->publishAll();
                            $this->redirect(array('action' => 'index'));
                        } else {
                            $this->Session->setFlash('El video no pudo ser guardado.', 'flash_error');
                            $this->redirect(array('action' => 'index'));
                        }
                    }
                    
                    if($image_id != null && $image_id > 0)
                        $this->deleteRelatedImage($image_id);
                        
                    if($result_vid == 1) {
                        $this->Session->setFlash('El artículo fue guardado exitosamente.', 'flash_success');
                        $this->publishArticle($id);
                        $this->publishAll();
                        $this->redirect(array('action' => 'index'));
                    } else {
                        $this->Session->setFlash('El video no pudo ser guardado.', 'flash_error');
                        $this->redirect(array('action' => 'index'));
                    }
                } else {
                    if($image_id != null && $image_id > 0)
                        $this->deleteRelatedImage($image_id);
                    
                    if($video_id != null && $video_id > 0)
                        $this->deleteRelatedVideo($video_id);
                    
                    $this->Session->setFlash('El artículo fue guardado exitosamente.', 'flash_success');
                    $this->publishArticle($id);
                    $this->publishAll();
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash('El artículo no pudo ser guardado. Intente de nuevo.', 'flash_error');
            }
        } else {
            $options = array('conditions' => array('Article.' . $this->Article->primaryKey => $id));
            $this->request->data = $this->Article->find('first', $options);
        }
        
        $relatedImage = $this->RelatedImage->find('first', array('conditions' => array('RelatedImage.article_id' => $id)));
        $relatedVideo = $this->RelatedVideo->find('first', array('conditions' => array('RelatedVideo.article_id' => $id)));
        $channels = array("principal" => "Principal", 
                          "encuentrame" => "Encuéntrame", 
                          "rumba" => "Rumba", 
                          "arte" => "Arte y Cultura", 
                          "ciencia" => "Ciencia y Tecnología", 
                          "sexualidad" => "Sexualidad al día", 
                          "moda" => "Moda"
                         );
        $this->set(compact('relatedImage', 'relatedVideo', 'channels'));
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
            $this->Session->setFlash('El artículo fue eliminado.', 'flash_success');
            $this->publishAll();
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('El artículo no pudo ser eliminado. Intente de nuevo.', 'flash_error');
        
        $this->redirect(array('action' => 'index'));
    }
    
    /**
    * editRelatedImage method
    *
    * @throws NotFoundException
    * @param string $id
    * @return int
    */
    public function editRelatedImage($id = null) {
        $result = 0;
        if (!$this->RelatedImage->exists($id)) {
            throw new NotFoundException(__('Imagen relacionada inválida'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->RelatedImage->save($this->request->data)) {
                $result = 1;
            } else {
                $result = 0;
            }
        } else {
            $options = array('conditions' => array('RelatedImage.' . $this->RelatedImage->primaryKey => $id));
            $this->request->data = $this->RelatedImage->find('first', $options);
        }
        return $result;
    }
    
    /**
    * deleteRelatedImage method
    *
    * @throws NotFoundException
    * @param string $id
    * @return int
    */
    public function deleteRelatedImage($id = null) {
        $result = 0;
        $this->RelatedImage->id = $id;
        if (!$this->RelatedImage->exists()) {
            throw new NotFoundException(__('Imagen relacionada inválida'));
        }
        if ($this->RelatedImage->delete()) {
            $result = 1;
        }
        return $result;
    }
    
    /**
    * editRelatedVideo method
    *
    * @throws NotFoundException
    * @param string $id
    * @return int
    */
    public function editRelatedVideo($id = null) {
        $result = 0;
        if (!$this->RelatedVideo->exists($id)) {
            throw new NotFoundException(__('Video relacionado inválido'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->RelatedVideo->save($this->request->data)) {
                $result = 1;
            } else {
                $result = 0;
            }
        } else {
            $options = array('conditions' => array('RelatedVideo.' . $this->RelatedVideo->primaryKey => $id));
            $this->request->data = $this->RelatedVideo->find('first', $options);
        }
        return $result;
    }
    
    /**
    * deleteRelatedVideo method
    *
    * @throws NotFoundException
    * @param string $id
    * @return void
    */
    public function deleteRelatedVideo($id = null) {
        $result = 0;
        $this->RelatedVideo->id = $id;
        if (!$this->RelatedVideo->exists()) {
            throw new NotFoundException(__('Video relacionado inválido'));
        }
        if ($this->RelatedVideo->delete()) {
            $result = 1;
        }
        return $result;
    }
    
    /**
    * manageImage method
    *
    * @return void
    */
    public function manageImage($article_id) {
        $file = $this->request->data['RelatedImage']['upload']; //put the data into a var for easy use

        $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
        $title = strstr($file['name'], '.', true);  //get the name alone


        $arr_ext = array('jpg', 'jpeg', 'gif', 'png'); //set allowed extensions
        $width_thumb = 200;

        //only process if the extension is valid
        if(in_array($ext, $arr_ext)) {
            $img_path = WWW_ROOT . 'img/uploads/' . $title . '_' . $article_id . '.' . $ext;
            move_uploaded_file($file["tmp_name"], $img_path);

            list($width, $height) = getimagesize($img_path);

            // *** 1) Initialise / load image
            $resizeObj = new resize($img_path);
            $height_thumb = $resizeObj -> getSizeByFixedWidth($width_thumb);

            // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
            $resizeObj -> resizeImage($width_thumb, $height_thumb, 'crop');
            $thumb = WWW_ROOT . 'img/uploads/' . $title . '_' . $article_id . '_thumb.' . $ext;
            $uri_thumb = '/app/webroot/img/uploads/' . $title . '_' . $article_id .'_thumb.' . $ext;
            $uri_img = '/app/webroot/img/uploads/' . $title . '_' . $article_id . '.' . $ext;

            // *** 3) Save image
            $resizeObj -> saveImage($thumb, 100);

            //prepare the filename for database entry
            $this->request->data['RelatedImage']['uri'] = $uri_img;
            $this->request->data['RelatedImage']['name'] = $title . '_' . $article_id . '.' . $ext;
            $this->request->data['RelatedImage']['title'] = $title . '_' . $article_id;
            $this->request->data['RelatedImage']['width'] = $width;
            $this->request->data['RelatedImage']['height'] = $height;
            $this->request->data['RelatedImage']['uri_thumb'] = $uri_thumb;
            $this->request->data['RelatedImage']['width_thumb'] = $width_thumb;
            $this->request->data['RelatedImage']['height_thumb'] = $height_thumb;
        }
    }
    
    public function getArticles($limit, $channel) {
        $join = "";
        
        if($channel != "" && $channel != null) {
            $join = "AND art.channel = '" . $channel . "'";
        }
        
        $sql = "SELECT art.id, art.channel, art.title, art.summary, art.enabled, art.created, art.modified, 
                       img.id as image_id, img.uri, img.uri_thumb, img.title, img.article_id as img_article_id, 
                       vid.id as video_id, vid.name as video_name, vid.source, vid.article_id as vid_article_id 
                FROM articles art 
                LEFT JOIN related_images img on art.id = img.article_id 
                LEFT JOIN related_videos vid on art.id = vid.article_id 
                WHERE art.enabled = 1 
                AND art.highlight = 0 " 
                . $join .
               "ORDER BY art.modified desc, art.id asc 
                LIMIT " . $limit . ""; 
        
        $articles = $this->Article->query($sql);
        
        return $articles;
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
    
    public function publishAll() {
        /* PUBLICAR RIOS */
        $this->publishView("rio", "rios/rio");
        $this->publishView("rio/encuentrame", "rios/rio-encuentrame");
        $this->publishView("rio/arte", "rios/rio-arte");
        $this->publishView("rio/ciencia", "rios/rio-ciencia");
        $this->publishView("rio/moda", "rios/rio-moda");
        $this->publishView("rio/rumba", "rios/rio-rumba");
        $this->publishView("rio/sexualidad", "rios/rio-sexualidad");
        
        /* PUBLICAR GALERIAS */
        $this->publishView("galeria", "galleries/galeria");
        $this->publishView("galeria/encuentrame", "galleries/galeria-encuentrame");
        $this->publishView("galeria/arte", "galleries/galeria-arte");
        $this->publishView("galeria/ciencia", "galleries/galeria-ciencia");
        $this->publishView("galeria/moda", "galleries/galeria-moda");
        $this->publishView("galeria/rumba", "galleries/galeria-rumba");
        $this->publishView("galeria/sexualidad", "galleries/galeria-sexualidad");
        
        /* PUBLICAR MODULO DE NOTICIAS DESTACADAS */
        $this->publishView("noticias_destacadas", "noticias_destacadas");
    }
    
    public function publishArticle($id) {
        $this->publishView("article_detail?id=" . $id, "articles/article-" . $id);
    }
}
