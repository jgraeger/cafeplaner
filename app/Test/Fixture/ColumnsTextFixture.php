<?php
/**
 * ColumnsTextFixture
 *
 */
class ColumnsTextFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'columns_text';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'date' => array('type' => 'date', 'null' => false, 'default' => null, 'key' => 'primary'),
		'message' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'column_name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'key' => 'index', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'date', 'unique' => 1),
			'column_name' => array('column' => 'column_name', 'unique' => 0)
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
			'message' => 'Lorem ipsum dolor sit amet',
			'column_name' => 'Lorem ipsum dolor sit amet'
		),
	);

}
