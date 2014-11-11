<?php
App::uses('AppController', 'Controller');

include("Component/resize-class.php");

/**
 * Cursos Controller
 *
 * @property Curso $Curso
 */
class CursosController extends AppController {
 
    public $paginate = array(
        'order' => array(
            'Curso.modified' => 'desc'
        )
    );
    
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
        $this->Curso->recursive = 0;
        $this->set('cursos', $this->paginate());
    }

    /**
    * view method
    *
    * @throws NotFoundException
    * @param string $id
    * @return void
    */
    public function view($id = null) {
        if (!$this->Curso->exists($id)) {
            throw new NotFoundException(__('Invalid curso'));
        }
        $options = array('conditions' => array('Curso.' . $this->Curso->primaryKey => $id));
        $this->set('curso', $this->Curso->find('first', $options));
    }

    /**
    * add method
    *
    * @return void
    */
    public function add() {
        if ($this->request->is('post')) {
            $this->Curso->create();
            
            if(!empty($this->request->data['Curso']['upload'])) {
                $this->manageImage();
            } 
            
            if ($this->Curso->save($this->request->data)) {
                $curso_id = $this->Curso->getLastInsertId();
                $this->Session->setFlash('El curso fue guardado exitosamente.', 'flash_success');
                $this->publishCurso($curso_id);
                $this->publishModuloCursos();
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('El curso no pudo ser guardado.', 'flash_error');
            }
        } 
        $categories = array("principal" => "Principal", 
                          "encuentrame" => "Encuéntrame", 
                          "rumba" => "Rumba", 
                          "arte" => "Arte y Cultura", 
                          "ciencia" => "Ciencia y Tecnología", 
                          "sexualidad" => "Sexualidad al día", 
                          "moda" => "Moda"
                         );
        $this->set(compact('categories'));
    }

    /**
    * edit method
    *
    * @throws NotFoundException
    * @param string $id
    * @return void
    */
    public function edit($id = null) {
        if (!$this->Curso->exists($id)) {
            throw new NotFoundException(__('Invalid curso'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            
            if(!empty($this->request->data['Curso']['upload'])) {
                $this->manageImage();
            }
            
            if ($this->Curso->save($this->request->data)) {
                $this->Session->setFlash('El curso fue guardado exitosamente.', 'flash_success');
                $this->publishCurso($id);
                $this->publishModuloCursos();
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('El curso no pudo ser guardado.', 'flash_error');
            }
        } else {
            $options = array('conditions' => array('Curso.' . $this->Curso->primaryKey => $id));
            $this->request->data = $this->Curso->find('first', $options);
        }
        $categories = array("principal" => "Principal", 
                          "encuentrame" => "Encuéntrame", 
                          "rumba" => "Rumba", 
                          "arte" => "Arte y Cultura", 
                          "ciencia" => "Ciencia y Tecnología", 
                          "sexualidad" => "Sexualidad al día", 
                          "moda" => "Moda"
                         );
        $this->set(compact('categories'));
    }

    /**
    * delete method
    *
    * @throws NotFoundException
    * @param string $id
    * @return void
    */
    public function delete($id = null) {
        $this->Curso->id = $id;
        if (!$this->Curso->exists()) {
            throw new NotFoundException(__('Invalid curso'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Curso->delete()) {
            $this->Session->setFlash('El curso fue eliminado.', 'flash_success');
            $this->publishModuloCursos();
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('El curso no pudo ser eliminado.', 'flash_error');
        $this->redirect(array('action' => 'index'));
    }
        
    /**
    * manageImage method
    *
    * @return void
    */
    public function manageImage() {
        $file = $this->request->data['Curso']['upload']; //put the data into a var for easy use
        
        $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
        $title = strstr($file['name'], '.', true);  //get the name alone

        $arr_ext = array('jpg', 'jpeg', 'gif'); //set allowed extensions
        $height_thumb = 170;

        //only process if the extension is valid
        if(in_array($ext, $arr_ext)) {
            $img_path = WWW_ROOT . 'img/uploads/' . $file['name'];
            move_uploaded_file($file["tmp_name"], $img_path);

            list($width, $height) = getimagesize($img_path);

            // *** 1) Initialise / load image
            $resizeObj = new resize($img_path);
            $width_thumb = $resizeObj ->getSizeByFixedHeight($height_thumb);

            // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
            $resizeObj -> resizeImage($width_thumb, $height_thumb, 'crop');
            $thumb = WWW_ROOT . 'img/uploads/' . $title . '_thumb.' . $ext;
            $uri_thumb = '/app/webroot/img/uploads/' . $title . '_thumb.' . $ext;
            $uri_img = '/app/webroot/img/uploads/' . $title . '.' . $ext;

            // *** 3) Save image
            $resizeObj -> saveImage($thumb, 100);

            //prepare the filename for database entry
            $this->request->data['Curso']['image'] = $uri_img;
            $this->request->data['Curso']['image_thumb'] = $uri_thumb;
        }
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
    
    public function publishCurso($id) {
        $this->publishView("curso_detail?id=" . $id, "cursos/curso-" . $id);
    }
    
    public function publishModuloCursos() {
        /* PUBLICAR MODULO DE TALLERES Y CURSOS */
        $this->publishView("talleres_cursos", "talleres_cursos");
    }
}
