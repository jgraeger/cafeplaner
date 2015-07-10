<?php
/**
 * ColumnsUserFixture
 *
 */
class ColumnsUserFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'date' => array('type' => 'date', 'null' => false, 'default' => null, 'key' => 'primary'),
		'half_shift' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4),
		'username' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'key' => 'index', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'shift_name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'key' => 'index', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'date', 'unique' => 1),
			'username' => array('column' => 'username', 'unique' => 0),
			'shift_name' => array('column' => 'shift_name', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'date' => '2014-01-27',
			'half_shift' => 1,
			'username' => 'Lorem ipsum dolor sit amet',
			'shift_name' => 'Lorem ipsum dolor sit amet'
		),
	);

}
