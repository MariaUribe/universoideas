<?php
App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {
    
    //var $components = array('Email');

    /**
    * beforeFilter method
    * Permite al usuario entrar a users/add 
    * sin estar logueado
    * @return void
    */

    public function beforeFilter() {
        parent::beforeFilter();
        $user = $this->Auth->user();
        
        if(!empty($user)) {
            $this->Auth->allow(array('index', 'view', 'add', 'edit', 'logout', 'exists_mail_user'));
        } else {
            $this->Auth->allow('add', 'forgot_password', 'exists', 'exists_mail', 'edit_password');
            $this->Auth->deny(array('index', 'view', 'edit', 'delete', 'exists_mail_user'));
        }
    }
    
    /**
    * login method
    *
    * @return void
    */
    public function login() {
        $this->layout = 'page';
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash('Nombre de usuario y/o contraseña inválidos. Intente de nuevo.', 'flash_error');
            }
        }
        $genders = array("" => "Seleccione", 
                         "F" => "Femenino",
                         "M" => "Masculino"
                        );
        
        $questions = $this->User->Question->find('list');
        
        $this->set(compact('genders', 'questions'));
    }

    /**
    * logout method
    *
    * @return void
    */
    public function logout() {
        $this->redirect($this->Auth->logout());
    }
    
    /**
    * index method
    *
    * @return void
    */
    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    /**
    * view method
    *
    * @throws NotFoundException
    * @param string $id
    * @return void
    */
    public function view($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $this->set('user', $this->User->find('first', $options));
    }
    
    public function exists($id = null) {
        $this->layout = 'page';
        $options = array('conditions' => array('User.username' => $id));
        unset($this->User->Forum->virtualFields['count']);
        unset($this->User->Forum->virtualFields['max_comment']);
        $this->set('user', $this->User->find('first', $options));
    }
    
    public function exists_mail($id = null) {
        $this->layout = 'page';
        $options = array('conditions' => array('User.mail' => $id));
        unset($this->User->Forum->virtualFields['count']);
        unset($this->User->Forum->virtualFields['max_comment']);
        $this->set('user', $this->User->find('first', $options));
    }
    
    public function exists_mail_user($mail = null) {
        $this->layout = 'page';
        $user = $this->Auth->user();
        
        $options = array('conditions' => array('User.mail' => $mail, 'User.id <>' => $user['id']));
        unset($this->User->Forum->virtualFields['count']);
        unset($this->User->Forum->virtualFields['max_comment']);
        $this->set('user', $this->User->find('first', $options));
    }

    /**
    * add method
    *
    * @return void
    */
    public function add() {
        $this->layout = 'page';
        if ($this->request->is('post')) {
            $this->User->create();
            if($this->request->data['User']['is_enterprise'] == true)
                $this->request->data['User']['role_id'] = 3;
            else
                $this->request->data['User']['role_id'] = 2;
            
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('El usuario fue registrado exitosamente.', 'flash_success');
                $this->redirect(array('controller' => 'users','action' => 'login'));
            } else {
                $this->Session->setFlash('El usuario no pudo ser creado. Intente de nuevo.', 'flash_error');
            }
        }
        $roles = $this->User->Role->find('list');
        $this->set(compact('roles'));
    }
    
    /**
    * edit method
    *
    * @throws NotFoundException
    * @param string $id
    * @return void
    */
    public function edit($id = null) {
        $this->loadModel('Comment');

        $this->layout = 'page';
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {
            if(empty($this->request->data['User']['password'])) {
                unset($this->request->data['User']['password']);
            }
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('El usuario fue guardado exitosamente.', 'flash_success');
                $this->redirect(array('controller' => 'users','action' => 'edit/' . $id));
            } else {
                $this->Session->setFlash('El usuario no pudo ser guardado. Intente de nuevo.', 'flash_error');
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id),
                                'fields' => array('User.id', 'User.username', 'User.password', 'User.name', 'User.lastname', 
                                                'User.mail', 'User.birthdate', 'User.gender', 'User.role_id', 'User.created', 
                                                'User.modified', 'User.twitter', 'User.question_id', 'User.securityAnswer', 
                                                'User.is_enterprise'),
                                );
            unset($this->User->Forum->virtualFields['count']);
            unset($this->User->Forum->virtualFields['max_comment']);
            $this->request->data = $this->User->find('first', $options);
        }
        
        $user = $this->Auth->user();
        $roles = $this->User->Role->find('list');
        $comments = $this->User->Comment->find('list');
        $genders = array("" => "Seleccione", 
                         "F" => "Femenino",
                         "M" => "Masculino"
                        );
        
        $questions = $this->User->Question->find('list');
        $this->set(compact('roles', 'user', 'genders', 'comments', 'questions'));
    }
    
    /**
    * edit method
    *
    * @throws NotFoundException
    * @param string $id
    * @return void
    */
    public function edit_password() {
        $id = $this->request->data['User']['id'];

        $this->layout = 'page';
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('La contraseña fue reestablecida exitosamente.', 'flash_success');
                $this->redirect(array('controller' => 'users','action' => 'login'));
            } else {
                $this->Session->setFlash('La contraseña no pudo ser reestablecida. Intente de nuevo.', 'flash_error');
            }
        } 
        
        $this->set(compact('id'));
    }

    /**
    * delete method
    *
    * @throws NotFoundException
    * @param string $id
    * @return void
    */
    public function delete($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
    
    public function forgot_password() {
        $this->layout = 'page';
        $user = $this->Auth->user();
        $user_found = "";
        $question_found = "";
        $id = "";
        $question_id = "";
        $questions = "";
        $question = "";
        $mail = $this->request->data['User']['mail'];
        
        if(!empty($this->request->data)) {
            $users = $this->findByMail($this->request->data['User']['mail']);
            if(sizeof($users) > 0) {
                $user_found = $users[0];
                $id = $user_found['user']['id'];
                $question_id = $user_found['user']['question_id'];
                $questions = $this->findQuestion($question_id);
                
                if(sizeof($questions) > 0) {
                    $question_found = $questions[0];
                    $question = $question_found['question']['question'];
                }
            }
            
            if($user_found) {
                $this->User->id = $id;
                //$this->redirect(array('controller' => 'pages','action' => 'home'));
                
            } else {
                $this->Session->setFlash('No existe ningún usuario asociado a la dirección de correo: ' . $mail, 'flash_error');
                $this->redirect(array('action' => 'login'));
            }
        }
        $this->set(compact('user', 'user_found', 'mail', 'id', 'question'));
    }
    
    function findByMail($mail) {

        $sql = "SELECT user.id, user.username, user.name, user.lastname, user.mail, user.role_id, user.question_id, user.securityAnswer, user.is_enterprise 
                FROM users user
                WHERE user.mail = '" . $mail . "'";
        
        $user = $this->User->query($sql);
        
        return $user;
    }
    
    function findQuestion($id) {
        $this->loadModel('Question');
        
        $sql = "SELECT question.id, question.question
                FROM questions question
                WHERE question.id = '" . $id . "'";
        
        $question = $this->Question->query($sql);
        
        return $question;
    }
    
/*    public function forgot() {
        $this->layout = 'page';
        $user = "";
        $mail = $this->request->data['User']['mail'];
        
        if(!empty($this->request->data)) {
            $users = $this->findByMail($this->request->data['User']['mail']);
            $user = $users[0];
            $id = $user['user']['id'];
            
            if($user) {
                $this->User->id = $id;
                $user['User']['tmp_password'] = $this->User->createTempPassword(7);
                $this->request->data['User']['password'] = $this->Auth->password($user['User']['tmp_password']);
                                
                if ($this->User->save($this->request->data)) {
                    $this->__sendPasswordEmail($user, $user['User']['tmp_password']);
                    $this->Session->setFlash('An email has been sent with your new password.');
                    $this->redirect(array('controller' => 'pages','action' => 'home'));
                } else {
                    $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
                }
                
//                if($this->User->save($user, false)) {
//                    $this->__sendPasswordEmail($user, $user['User']['tmp_password']);
//                    $this->Session->setFlash('An email has been sent with your new password.');
//                    $this->redirect($this->referer());
//                }
            } else {
                $this->Session->setFlash('No user was found with the submitted email address.');
            }
        }
        $this->set(compact('user', 'mail', 'id'));
    }
    
    function __sendPasswordEmail($user, $password) {
        if ($user === false) {
            debug(__METHOD__." failed to retrieve User data for user.id: {$user['user']['id']}");
            return false;
        }
        
        $this->set('user', $user['user']);
        $this->set('password', $password);
        $this->Email->to = 'mariale.uribe@gmail.com';
//        $this->Email->to = $user['user']['mail'];
//        $this->Email->bcc = array('Your-Domain Accounts <accounts@your-domain.com>');
        $this->Email->subject = 'Password Change Request';
        $this->Email->from = 'mariale.uribe@gmail.com';
        $this->Email->template = $this->action;
        $this->Email->sendAs = 'both'; // you probably want to use both
//        $this->Cookie->write('Referer', $this->referer(), true, '+2 weeks');
        $this->Session->setFlash('A new password has been sent to your supplied email address.');

        return $this->Email->send();
    }
    */
}
