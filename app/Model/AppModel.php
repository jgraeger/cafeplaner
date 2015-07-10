<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {

	/**
	*Returns the possible Values of an enum, used in MySQL
	*@author Johannes Graeger/arch0n
	*/
	function getEnumValues($columnName=null) {
		if ($columnName== null) {
			return array();
		}

		$tableName = Inflector::tableize($this->name);

		//Get the values for a specific column
		$result = $this->query("SHOW COLUMNS FROM {$tableName} LIKE '{$columnName}'");
		
		// Get the Values from the TypeColumn
		$type = null;
		if (isset($result[0]['COLUMNS']['Type'])) {$type = $result[0]['COLUMNS']['Type'];}
		else { return array(); }

		//AND NOW: GET THE VALUES :-)
		$values = explode("','", preg_replace("/(enum)\('(.+?)'\)/","\\2", $type) );

		//Convert the array from explode into an assoc array
		$assoc_values = array();
		foreach ($values as $value) {
			$assoc_values[$value] = Inflector::humanize($value);
		}
		return $assoc_values;
	}
}
