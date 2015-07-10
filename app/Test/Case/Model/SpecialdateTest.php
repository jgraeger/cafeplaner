<?php
App::uses('Specialdate', 'Model');

/**
 * Specialdate Test Case
 *
 */
class SpecialdateTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.specialdate'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Specialdate = ClassRegistry::init('Specialdate');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Specialdate);

		parent::tearDown();
	}

}
