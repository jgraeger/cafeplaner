<?php
/**
 * ChangelogFixture
 *
 */
class ChangelogFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'for_date' => array('type' => 'date', 'null' => false, 'default' => null),
		'change_date' => array('type' => 'timestamp', 'null' => false, 'default' => 'CURRENT_TIMESTAMP'),
		'name_before' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'name_after' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'shift' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'user_did' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'key' => 'index', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'user_did' => array('column' => 'user_did', 'unique' => 0)
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
			'id' => 1,
			'for_date' => '2014-01-27',
			'change_date' => 1390851288,
			'name_before' => 'Lorem ipsum dolor sit amet',
			'name_after' => 'Lorem ipsum dolor sit amet',
			'shift' => 'Lorem ipsum dolor sit amet',
			'user_did' => 'Lorem ipsum dolor sit amet'
		),
	);

}
