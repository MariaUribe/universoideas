<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');

/**
 * User Model
 *
 * @property Roles $Roles
 * @property Comment $Comment
 * @property Forum $Forum
 * @property Article $Article
 */
class User extends AppModel {

    /**
    * Display field
    *
    * @var string
    */
    public $displayField = 'name';
    
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Nombre de usuario es requerido'
            )
        ),
        'name' => array(
            'notempty' => array(
                    'rule' => array('notempty')
            )
        ),
        'mail' => array(
            'notempty' => array(
                    'rule' => array('notempty')
            )
        ),
        'securityAnswer' => array(
            'notempty' => array(
                    'rule' => array('notempty')
            )
        )
//        'role' => array(
//            'valid' => array(
//                'rule' => array('inList', array('admin', 'invitado')),
//                'message' => 'Please enter a valid role',
//                'allowEmpty' => false
//            )
//        )
    );
    
    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
    }
    
    function equalToField($array, $field) {
        return strcmp($this->data[$this->alias][key($array)], $this->data[$this->alias][$field]) == 0;
    } 

    /**
    * belongsTo associations
    *
    * @var array
    */
    public $belongsTo = array(
            'Role' => array(
                    'className' => 'Role',
                    'foreignKey' => 'role_id',
                    'conditions' => '',
                    'fields' => '',
                    'order' => ''
            ),
            'Question' => array(
                    'className' => 'Question',
                    'foreignKey' => 'question_id',
                    'conditions' => '',
                    'fields' => '',
                    'order' => ''
            )
    );

    /**
    * hasMany associations
    *
    * @var array
    */
    public $hasMany = array(
            'Comment' => array(
                    'className' => 'Comment',
                    'foreignKey' => 'user_id',
                    'dependent' => false,
                    'conditions' => '',
                    'fields' => '',
                    'order' => '',
                    'limit' => '',
                    'offset' => '',
                    'exclusive' => '',
                    'finderQuery' => '',
                    'counterQuery' => ''
            ),
            'Forum' => array(
                    'className' => 'Forum',
                    'foreignKey' => 'user_id',
                    'dependent' => false,
                    'conditions' => '',
                    'fields' => '',
                    'order' => '',
                    'limit' => '',
                    'offset' => '',
                    'exclusive' => '',
                    'finderQuery' => '',
                    'counterQuery' => ''
            )
    );


    /**
    * hasAndBelongsToMany associations
    *
    * @var array
    */
    public $hasAndBelongsToMany = array(
            'Article' => array(
                    'className' => 'Article',
                    'joinTable' => 'users_articles',
                    'foreignKey' => 'user_id',
                    'associationForeignKey' => 'article_id',
                    'unique' => 'keepExisting',
                    'conditions' => '',
                    'fields' => '',
                    'order' => '',
                    'limit' => '',
                    'offset' => '',
                    'finderQuery' => '',
                    'deleteQuery' => '',
                    'insertQuery' => ''
            )
    );
    
    /*function createTempPassword($len) {
        $pass = '';
        $lchar = 0;
        $char = 0;
        
        for($i = 0; $i < $len; $i++) {
            while($char == $lchar) {
                $char = rand(48, 109);
                if($char > 57) $char += 7;
                if($char > 90) $char += 6;
            }

            $pass .= chr($char);
            $lchar = $char;
        }

        return $pass;
    }*/
}
