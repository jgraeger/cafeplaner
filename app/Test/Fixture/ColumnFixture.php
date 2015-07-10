<?php
/**
 * ColumnFixture
 *
 */
class ColumnFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'key' => 'primary', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'type' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4),
		'obligated' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4),
		'req_admin' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4),
		'order' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4),
		'indexes' => array(
			'PRIMARY' => array('column' => 'name', 'unique' => 1)
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
			'name' => 'Lorem ipsum dolor sit amet',
			'type' => 1,
			'obligated' => 1,
			'req_admin' => 1,
			'order' => 1
		),
	);

}
