<?php
App::uses('ColumnsText', 'Model');

/**
 * ColumnsText Test Case
 *
 */
class ColumnsTextTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.columns_text'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ColumnsText = ClassRegistry::init('ColumnsText');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ColumnsText);

		parent::tearDown();
	}

}
