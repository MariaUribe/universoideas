<?php
App::uses('UsersArticle', 'Model');

/**
 * UsersArticle Test Case
 *
 */
class UsersArticleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.users_article',
		'app.articles'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UsersArticle = ClassRegistry::init('UsersArticle');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UsersArticle);

		parent::tearDown();
	}

}
