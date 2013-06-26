<?php
/**
 * UsersArticleFixture
 *
 */
class UsersArticleFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'users_username' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'articles_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'indexes' => array(
			'PRIMARY' => array('column' => array('users_username', 'articles_id'), 'unique' => 1),
			'fk_USUARIO_has_ARTICULO_ARTICULO1_idx' => array('column' => 'articles_id', 'unique' => 0),
			'fk_USUARIO_has_ARTICULO_USUARIO1_idx' => array('column' => 'users_username', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'users_username' => 'Lorem ipsum dolor ',
			'articles_id' => 1
		),
	);

}
