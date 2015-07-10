<?php
App::uses('Column', 'Model');

/**
 * Column Test Case
 *
 */
class ColumnTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.column',
		'app.user',
		'app.columns_user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Column = ClassRegistry::init('Column');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Column);

		parent::tearDown();
	}

}
