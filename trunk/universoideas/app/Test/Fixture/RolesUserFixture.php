<?php
/**
 * RolesUserFixture
 *
 */
class RolesUserFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'role_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'indexes' => array(
			'PRIMARY' => array('column' => array('role_id', 'user_id'), 'unique' => 1),
			'fk_roles_has_users_users1_idx' => array('column' => 'user_id', 'unique' => 0),
			'fk_roles_has_users_roles1_idx' => array('column' => 'role_id', 'unique' => 0)
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
			'role_id' => 1,
			'user_id' => 1
		),
	);

}
