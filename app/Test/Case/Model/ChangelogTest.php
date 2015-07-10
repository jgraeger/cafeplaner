<?php
App::uses('Changelog', 'Model');

/**
 * Changelog Test Case
 *
 */
class ChangelogTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.changelog'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Changelog = ClassRegistry::init('Changelog');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Changelog);

		parent::tearDown();
	}

}
