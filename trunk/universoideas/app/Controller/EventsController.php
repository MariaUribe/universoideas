<?php
App::uses('AppController', 'Controller');

include("Component/resize-class.php");

/**
 * Events Controller
 *
 * @property Event $Event
 */
class EventsController extends AppController {
    
    public $paginate = array(
        'order' => array(
            'Event.modified' => 'desc'
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
        $this->Event->recursive = 0;
        $this->set('events', $this->paginate());
    }

    /**
    * view method
    *
    * @throws NotFoundException
    * @param string $id
    * @return void
    */
    public function view($id = null) {
        if (!$this->Event->exists($id)) {
            throw new NotFoundException(__('Invalid event'));
        }
        $options = array('conditions' => array('Event.' . $this->Event->primaryKey => $id));
        $this->set('event', $this->Event->find('first', $options));
    }

    /**
    * add method
    *
    * @return void
    */
    public function add() {
        if ($this->request->is('post')) {
            $this->Event->create();
            
            if(!empty($this->request->data['Event']['upload'])) {
                $this->manageImage();
            } 
            
            if ($this->Event->save($this->request->data)) {
                $event_id = $this->Event->getLastInsertId();
                $this->Session->setFlash('El evento fue guardado exitosamente.', 'flash_success');
                $this->publishEvent($event_id);
                $this->publishCalendar();
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('El evento no pudo ser guardado.', 'flash_error');
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
        if (!$this->Event->exists($id)) {
            throw new NotFoundException(__('Invalid event'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            
            if(!empty($this->request->data['Event']['upload'])) {
                $this->manageImage();
            }
            
            if ($this->Event->save($this->request->data)) {
                $this->Session->setFlash('El evento fue guardado exitosamente.', 'flash_success');
                $this->publishEvent($id);
                $this->publishCalendar();
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('El evento no pudo ser guardado.', 'flash_error');
            }
        } else {
            $options = array('conditions' => array('Event.' . $this->Event->primaryKey => $id));
            $this->request->data = $this->Event->find('first', $options);
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
        $this->Event->id = $id;
        if (!$this->Event->exists()) {
            throw new NotFoundException(__('Invalid event'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Event->delete()) {
            $this->Session->setFlash('El evento fue eliminado.', 'flash_success');
            $this->publishCalendar();
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('El evento no pudo ser eliminado.', 'flash_error');
        $this->redirect(array('action' => 'index'));
    }
    
    /**
    * manageImage method
    *
    * @return void
    */
    public function manageImage() {
        $file = $this->request->data['Event']['upload']; //put the data into a var for easy use
        
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
            $this->request->data['Event']['image'] = $uri_img;
            $this->request->data['Event']['image_thumb'] = $uri_thumb;
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
    
    public function publishEvent($id) {
        $this->publishView("event_detail?id=" . $id, "events/event-" . $id);
    }
    
    public function publishCalendar(){
        /* PUBLICAR CALENDARIO EVENTOS */
        $this->publishView("calendario_eventos", "calendario_eventos");
        
        /* PUBLICAR MODULO DE CALENDARIO */
        $this->publishView("prox_actividades", "prox_actividades");
    }
}
