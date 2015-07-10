<?php
App::uses('ColumnsUser', 'Model');

/**
 * ColumnsUser Test Case
 *
 */
class ColumnsUserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.columns_user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ColumnsUser = ClassRegistry::init('ColumnsUser');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ColumnsUser);

		parent::tearDown();
	}

}
