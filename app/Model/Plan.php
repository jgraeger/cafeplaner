<?php

App::uses('AppModel', 'Model');
App::uses('ColumnsUser', 'Model');
App::uses('Comment', 'Model');
App::uses('Column', 'Model');

/**
 * Der PlanModel hat die Aufgabe, sämtliche vorhandenen Daten aus der Datenbank bereitzustellen,
 * die zur Darstellung eines bestimmten Monats notwendig sind.
 */
class Plan extends AppModel {
	
	public $useTable = false; 
	
	/**
	 * Prüft, ob ein Datum komplett belegt ist.
	 * Dabei gilt die Regel: Anzahl gefundener Einträge für das Datum = erwartete Anzahl an Einträgen.
	 * 
	 * @see Plan::getExpectedEntryCountPerDay()
	 * @param date - das zu prüfende Datum
	 * @return boolean
	 * @author jgraeger
	 */
	public function isDateComplete($date=-1) {
		if ($date == -1) return false;
		$count = 0;
		
		$columns = new Column();
		$columns = $columns->find('all', array('recursive' => -1, 'conditions' => array('Column.obligated' => 1)));
		$obligatedColumns = array();
		foreach ($columns as $column) {
			array_push($obligatedColumns, $column['Column']['id']);
		}
		
		$columnsUsers = new ColumnsUser();
		$columnsUsers = $columnsUsers->find('all', array('recursive' => -1, 'conditions' => array('ColumnsUser.date' => $date)));
		foreach ($columnsUsers as $columnsUser) {
			if (in_array($columnsUser['ColumnsUser']['column_id'], $obligatedColumns))
				$count += ($columnsUser['ColumnsUser']['half_shift'] == 3) ? 2 : 1;
		}
		
		$comments = new Comment();
		$comments = $comments->find('all', array('recursive' => -1, 'conditions' => array('Comment.date' => $date)));
		foreach ($comments as $comment) {
			if (in_array($comment['Comment']['column_id'], $obligatedColumns))
				$count++;
		}
		
		return $count == $this->getExpectedEntryCountPerDay();
	}
	
	/**
	 * Stellt die rohen Daten aus der Datenbank bereit, die zur Darstellung des Monats im Plan benötigt werden
	 * 
	 * @param month - der anzuzeigende Monat
	 * @param year - das anzuzeigende Jahr
	 * @author aloeser + jgraeger
	 * @return array
	 */
	public function getPlanData($month=-1, $year=-1) {		
		if (!is_numeric($month) || !is_numeric($year) || strlen($month) != 2 || strlen($year) != 4) {
			//Falsches Format => wie keine Daten
			$month = -1;
			$year = -1;
		}
		
		if ($month < 1 || $month > 12 || $year < 2000) {
			//Sachlich falsche Daten => wie keine Daten
			$month = -1;
			$year = -1;
		}
		
		if ($month == -1 || $year == -1) {
			//Kein Datum vorgegeben -> aktueller Monat
			$month = date('m', time());
			$year = date('Y', time());
		}
		
		$conditionArray = array('date LIKE ' => $year.'-'.$month.'-%');			
		
		$plan = array();
		$daysInMonth = date('t', strtotime($year.'-'.$month.'-01'));
		$datetime = new DateTime($year.'-'.$month.'-01');
		
		//Zur Vollständigkeitsüberprüfung zu erwartende Anzahl an Einträgen ermitteln
		$expectedCount = $this->getExpectedEntryCountPerDay();
		$requiredColumns = new Column();
		$requiredColumns = $requiredColumns->find('all', array('required' => 1, 'conditions' => array('Column.obligated' => 1)));
		$obligatedColumns = array();
		foreach ($requiredColumns as $requiredColumn) {
			array_push($obligatedColumns, $requiredColumn['Column']['id']);
		}		
		
		for ($i = 1;$i <= $daysInMonth;$i++) {
			$currentDate = $datetime->format('Y-m-d');
			$data = array();
			$insertedData = array();
			
			$columnsUsers = new ColumnsUser();
			$columnsUsers = $columnsUsers->find('all', array('recursive'=>-1, 'conditions' => array('date' => $currentDate)));
			
			foreach ($columnsUsers as $columnUser) {
				//Benutzereinträge laden
				if ($columnUser['ColumnsUser']['half_shift'] == 3) {
					$data[$columnUser['ColumnsUser']['column_id']][1] = array('userid' => $columnUser['ColumnsUser']['user_id']);
					$data[$columnUser['ColumnsUser']['column_id']][2] = array('userid' => $columnUser['ColumnsUser']['user_id']);
					
					if (in_array($columnUser['ColumnsUser']['column_id'], $obligatedColumns) && !array_key_exists($columnUser['ColumnsUser']['column_id'].'_1', $insertedData) && !array_key_exists($columnUser['ColumnsUser']['column_id'].'_2', $insertedData)) {
						$insertedData[$columnUser['ColumnsUser']['column_id'].'_1'] = null;
						$insertedData[$columnUser['ColumnsUser']['column_id'].'_2'] = null;
					}
				} else {
					$data[$columnUser['ColumnsUser']['column_id']][$columnUser['ColumnsUser']['half_shift']] = array('userid' => $columnUser['ColumnsUser']['user_id']);
					
					if (in_array($columnUser['ColumnsUser']['column_id'], $obligatedColumns) && !array_key_exists($columnUser['ColumnsUser']['column_id'].'_'.$columnUser['ColumnsUser']['half_shift'], $insertedData)) {
						$insertedData[$columnUser['ColumnsUser']['column_id'].'_'.$columnUser['ColumnsUser']['half_shift']] = null;
					}
					
				}
			}
			
			$comments = new Comment();
			$comments = $comments->find('all', array('recursive'=>-1, 'conditions' => array('date' => $currentDate)));
			
			foreach ($comments as $comment) {
				//Texteinträge laden
				$data[$comment['Comment']['column_id']] = $comment['Comment']['message'];
				
				if (in_array($comment['Comment']['column_id'], $obligatedColumns) && !array_key_exists($comment['Comment']['column_id'], $insertedData)) {
					$insertedData[$comment['Comment']['column_id']] = null;
				}
			}
			
			//Prüfen, ob der Tag vollständig ist
			$data['complete'] = $expectedCount == count($insertedData);
			
			//allgemeine Struktur:
			//für Textspalten
			//$plan[<Datum>][<Spaltenid>] = message
			//für Benutzerspalten
			//$plan[<Datum>][<Spaltenid>][<Schicht(1/2)>] = user_id
			
			$plan[$currentDate] = $data;
			$datetime->modify('+1 day');
		}
		
		return $plan;
	}
	
	/**
	 * Ermittelt die Anzahl der Einträge im Plan, die bei einem vollständig belegten Tag zu erwarten sind.
	 * Formel zur Berechnung: Anzahl an obligated-Textspalten + 2*Anzahl an obligated-Benutzerspalten
	 * 
	 * @return int
	 * @author aloeser
	 */
	private function getExpectedEntryCountPerDay() {
		$count = 0;
		
		$columns = new Column();
		//Nur obligated-Spalten müssen belegt werden
		$columns = $columns->find('all', array('recursive' => -1, 'conditions' => array('Column.obligated' => 1)));

		foreach ($columns as $column) {
			if ($column['Column']['type'] == 1) {
				//Textspalte -> 1 Eintrag
				$count++;
			} else if ($column['Column']['type'] == 2) {
				//Benutzerspalte -> 2 Einträge (für 1. und 2. Schicht)
				$count += 2;
			}
		}
		
		return $count;
	}
	
	/**
	 * Ermittelt die fehlenden Schichten am $date
	 * 
	 * @param date - das Datum, für das die fehlenden Schichten ermittelt werden sollen
	 * @author aloeser
	 * @return array
	 */
	public function getMissingShifts($date) {
		$columns = new Column();
		$columns = $columns->find('all', array('recursive' => -1, 'conditions' => array('Column.obligated' => 1)));
		
		$shifts = array();
		
		foreach ($columns as $column) {
			if ($column['Column']['type'] == 1) {
				//Textspalte
				$shifts[$column['Column']['id']] = null;
			} else if ($column['Column']['type'] == 2) {
				//Benutzerspalte
				$shifts[$column['Column']['id']] = array(1 => null, 2 => null);
			}
		}
		
		$columnsUsers = new ColumnsUser();
		$columnsUsers = $columnsUsers->find('all', array('recursive' => -1, 'conditions' => array('ColumnsUser.date' => $date)));
		
		foreach ($columnsUsers as $columnUser) {
			if ($columnUser['ColumnsUser']['half_shift'] == 3) {
				unset($shifts[$columnUser['ColumnsUser']['column_id']]);
			} else {
				if (isset($shifts[$columnUser['ColumnsUser']['column_id']]) &&  array_key_exists(3-$columnUser['ColumnsUser']['half_shift'], $shifts[$columnUser['ColumnsUser']['column_id']])) {
					unset($shifts[$columnUser['ColumnsUser']['column_id']][$columnUser['ColumnsUser']['half_shift']]);
				} else {
					unset($shifts[$columnUser['ColumnsUser']['column_id']]);
				}
			}
		}
		
		$comments = new Comment();
		$comments = $comments->find('all', array('recursive' => -1, 'conditions' => array('Comment.date' => $date)));
		
		foreach ($comments as $comment) {
			unset($shifts[$comment['Comment']['column_id']]);
		}
		
		return $shifts;
	}
}
?>
