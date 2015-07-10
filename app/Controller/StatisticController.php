<?php
class StatisticController extends AppController {
	public $uses = array('User', 'ColumnsUser', 'Specialdate');
	public $helpers = array('Form');

	/**
	 * Ermittelt die Daten für $month im Jahr $year.
	 * Standardmäßig und bei ungültigen Werten von $month oder $year wird der vergangene Monat angezeigt.
	 * 
	 * @param year - das Jahr für die Statistik (vierstellig)
	 * @param month - der Monat (zweistellig)
	 * @see StatisticController::analyseAndSetData()
	 * @author aloeser
	 * @return void
	 */
	public function index($year=-1, $month=-1) {
		if (!is_numeric($month) || !is_numeric($year) || strlen($month) != 2 || strlen($year) != 4) {
			//Falsches Format => wie keine Daten
			$month = -1;
			$year = -1;
		}
		
		if (($month != -1 && $month < 1) || $month > 12 || $year < 2000) {
			//Sachlich falsche Daten => wie keine Daten
			$month = -1;
			$year = -1;
		}
		
		if ($month == -1 && $year == -1) {
			//Kein Datum vorgegeben -> aktueller Monat, da dieser bereits abgeschlossen ist
			$tmpDatetime = new DateTime('now');
			$tmpDatetime->modify("-1 month");
			$month = $tmpDatetime->format('m');
			$year = $tmpDatetime->format('Y');
		}

		if ($year != -1 && $month == -1) {
			//Jahresstatistik
			//(Zur Zeit noch nicht verwendet)
			$month = '__';
			$this->set('pageTitle', "Statistik für ".$year);
			$nextYear = $year;
			$nextMonth = "01";
			$previousYear = $year-1;
			$previousMonth = "12";
		} else 	if ($year != -1 && $month != -1) {
			$this->set('pageTitle', "Statistik für ".$month."/".$year);
			
			$datetime = new DateTime($year."-".$month."-15");
			$datetime->modify("+1 month");
			$nextYear =  $datetime->format('Y');
			$nextMonth  = $datetime->format('m');
			$datetime->modify("-2 months");
			$previousYear =  $datetime->format('Y');
			$previousMonth  = $datetime->format('m');
		}

		$date = $year."-".$month."-__";
		
		$data = $this->ColumnsUser->find("all", array('recursive' => -1, 'conditions' => array('ColumnsUser.date LIKE ' => $date)));
		
		$this->analyseAndSetData($data);
		
		$actions = array(
				'actions' => array(
						'print' => array('text' => 'Druckversion anzeigen', 'params' => array('controller' => 'statistic','action' => 'printversion', $this->params['action'], $year, ($month == '__' ? -1 :$month))),
						'previousMonth' => array('text' => 'Vorheriger Monat', 'params' => array('controller' => 'statistic', 'action' => 'index', $previousYear, $previousMonth)),
						'currentMonth' => array('text' => 'Aktueller Monat', 'params' => array('controller' => 'statistic', 'action' => 'index', date('Y'), date('m'))),
						'nextMonth' => array('text' => 'Nächster Monat', 'params' => array('controller' => 'statistic', 'action' => 'index', $nextYear, $nextMonth)),
						'lastYear' => array('text' => 'Statistik für das letzte Jahr', 'params' => array('controller' => 'statistic', 'action' => 'index', date('Y')-1)),
						'interval' => array('text' => 'Statistik für Zeitraum', 'htmlattributes' => array('onClick' => '$("#StatisticIntervalFormDiv").dialog({title: "Zeitraum festlegen",modal: true});'))
		));
		$this->set('actions', $actions);
	}

	/**
	 * Ermittelt die Daten von $from bis $to.
	 *
	 * @param from - das Startdatum (inklusive)
	 * @param to - das Enddatum (inklusive)
	 * @see StatisticController::analyseAndSetData()
	 * @author aloeser
	 * @return void
	 */
	public function interval($from=-1, $to=-1) {
		//Direkt übergebene Werte haben Vorrang vor POST-Parametern
		if ($from != -1) $this->request->data['Date']['dateFrom'] = $from;
		if ($to != -1) $this->request->data['Date']['dateTo'] = $to;
		
		//Inputvalidierung
		if (!isset($this->request->data['Date']['dateFrom']) || !isset($this->request->data['Date']['dateTo'])) {
			return $this->redirect(array('controller' => 'statistic', 'action' => 'index'));
		}
			
		$this->request->data['Date']['dateFrom'] = str_replace(" ", "", $this->request->data['Date']['dateFrom']);
		$this->request->data['Date']['dateTo'] = str_replace(" ", "", $this->request->data['Date']['dateTo']);
		
		$token = explode(".", $this->request->data['Date']['dateFrom']);
		if (count($token) != 3 || !checkdate($token[1], $token[0], $token[2])) {
			//Ungültiges Datum
			//-> nur aktuellen Monat anzeigen
			return $this->redirect(array('action' => 'index'));
		} else {
			$dateBegin = $token[2]."-".$token[1]."-".$token[0];
		}

		$token = explode(".", $this->request->data['Date']['dateTo']);
		if (count($token) != 3 || !checkdate($token[1], $token[0], $token[2])) {
			//Ungültiges Datum
			//-> nur aktuellen Monat anzeigen
			return $this->redirect(array('action' => 'index'));
		} else {
			$dateEnd = $token[2]."-".$token[1]."-".$token[0];
		}
		
		
		if (strtotime($dateBegin) > strtotime($dateEnd)) {
			//Variablen tauschen
			$tmp = $dateBegin;
			$dateBegin = $dateEnd;
			$dateEnd = $tmp;
		}
		
		$datetime = new DateTime(date('Y-m-d'));
			$datetime->modify("+1 month");
			$nextYear =  $datetime->format('Y');
			$nextMonth  = $datetime->format('m');
			$datetime->modify("-2 months");
			$previousYear =  $datetime->format('Y');
			$previousMonth  = $datetime->format('m');

		$data = $this->ColumnsUser->find('all', array('recursive' => -1, 'conditions' => array('ColumnsUser.date <= ' => $dateEnd, 'ColumnsUser.date >=' => $dateBegin)));

		$this->set('pageTitle', "Statistik für den Zeitraum vom ".date('d. m. Y', strtotime($dateBegin))." bis zum ".date('d. m. Y', strtotime($dateEnd)));
		$this->analyseAndSetData($data);
		
		$this->set('param1', date('d.m.Y', strtotime($dateBegin)));
		$this->set('param2', date('d.m.Y', strtotime($dateEnd)));
		
		$actions = array(
				'actions' => array(
						'print' => array('text' => 'Druckversion anzeigen', 'params' => array('controller' => 'statistic','action' => 'printversion', $this->params['action'], $this->request->data['Date']['dateFrom'], $this->request->data['Date']['dateTo'])),
						'previousMonth' => array('text' => 'Vorheriger Monat', 'params' => array('controller' => 'statistic', 'action' => 'index', $previousYear, $previousMonth)),
						'currentMonth' => array('text' => 'Aktueller Monat', 'params' => array('controller' => 'statistic', 'action' => 'index', date('Y'), date('m'))),
						'nextMonth' => array('text' => 'Nächster Monat', 'params' => array('controller' => 'statistic', 'action' => 'index', $nextYear, $nextMonth)),
						'lastYear' => array('text' => 'Statistik für das letzte Jahr', 'params' => array('controller' => 'statistic', 'action' => 'index', date('Y')-1)),
						'interval' => array('text' => 'Statistik für Zeitraum', 'htmlattributes' => array('onClick' => '$("#StatisticIntervalFormDiv").dialog({title: "Zeitraum festlegen",modal: true});'))
				));
		$this->set('actions', $actions);
	}

	/**
	 * Ermittelt anhand der Planbelegung ($dataArray) eine Statistik und stellt sie dem View zur Verfügung.
	 * 
	 * @param dataArray
	 * @author aloeser
	 * @return void
	 */
	private function analyseAndSetData($dataArray) {

		$userList = array();
		$users = $this->User->find('all', array('recursive' => -1, 'conditions' => array('User.leave_date' => null, 'User.admin != ' => 2)));
		//Alle aktiven Benutzer müssen in der Statistik drinstehen
		foreach ($users as $user) {
			$userList[$user['User']['id']] = array('username' => $user['User']['username']);
			$userList[$user['User']['id']]['H']  = 0;
			$userList[$user['User']['id']]['G']  = 0;
			$userList[$user['User']['id']]['ges']  = 0;
			$userList[$user['User']['id']]['active'] = true;
		}

		foreach ($dataArray as $data) {
			if ($this->Specialdate->exists($data['ColumnsUser']['date']))
				continue;
			
			if (!array_key_exists($data['ColumnsUser']['user_id'], $userList)) {
				$userdata = $this->User->find('first', array('recursive' => -1, 'conditions' => array('User.id' => $data['ColumnsUser']['user_id'])));
				$userList[$data['ColumnsUser']['user_id']] = array('username' => $userdata['User']['username']);
				$userList[$data['ColumnsUser']['user_id']]['H']  = 0;
				$userList[$data['ColumnsUser']['user_id']]['G']  = 0;
				$userList[$data['ColumnsUser']['user_id']]['ges']  = 0;
				$userList[$data['ColumnsUser']['user_id']]['active']  = $userdata['User']['leave_date'] == null && $userdata['User']['admin'] != 2;
			}

			$halfshift = $data['ColumnsUser']['half_shift'];
			if ($halfshift <= 2)
				$halfshift = 'H';
			else
				$halfshift = 'G';

			$userList[$data['ColumnsUser']['user_id']][$halfshift]++;
			$userList[$data['ColumnsUser']['user_id']]['ges'] +=  ($halfshift == 'G') ? 1 : 0.5;
		}

		$this->set('data', $userList);
	}
	
	/**
	 * Zeigt die Druckversion der Statistik an.
	 * 
	 * @param action - gibt an, ob die Intervalstatistik oder die Monatsstatistik gewählt wurde
	 * @param param1 - der erste Parameter
	 * @param param2 - der zweite Parameter
	 */
	public function printversion($action=-1, $param1=-1, $param2=-1) {
		$this->layout = "print";
		
		if ($action == "index") {
			$this->index($param1, $param2);
		} else if ($action == "interval") {
			$this->interval(date('d.m.Y', strtotime($param1)), $param2);
		} else {
			return $this->redirect(array('controller' => 'statistic', 'action' => 'index'));
		}
	}
}
