<?php
App::uses("User", "Model");
App::uses("DatabaseManager", "Model");
/**
 * Der InstallController stellt verschiedene Optionen zur Installation zur Verfügung.
 * Wurde eine Option gewählt, führt der InstallController die Installation durch.
 * @author aloeser
 */
class InstallController extends AppController {
	
	public $uses = array('User');
	public $components = array('Session');
	
	/**
	 * Ermittelt die maximale Dateigröße beim Upload und stellt sie der index.ctp bereit.
	 * Lädt eventuelle Validierungsfehler von InstallController::create(), um sie anzuzeigen.
	 * 
	 * @author aloeser
	 * @return void
	 */
	public function index() {
		$maxUploadSize = ini_get('upload_max_filesize');
		$this->set('maxUploadSizeString', $this->getMaxUploadSizeDisplayFormat($maxUploadSize));
		$this->set('maxUploadSizeBytes', $this->return_bytes($maxUploadSize));
		
		//Mögliche Validierungsfehler nach einem möglichen Redirect wieder laden, um sie anzuzeigen
		$this->User->validationErrors = $this->Session->read('InstallByCreateValidationErrors');
		//und schließlich zu löschen
		$this->Session->delete('InstallByCreateValidationErrors');
	}
	
	/**
	 * Installation erfolgt durch den Import eines Datenbankdumps
	 * Es wird geprüft, ob die Datei korrekt hochgeladen wurde.
	 * Gegebenfalls wird sie an DatabaseManager::import() weitergegeben.
	 * 
	 * @see DatabaseManager::import()
	 * @author aloeser
	 * @return void
	 */
	public function import() {		
		if ($this->request->is('post')) {
			$maxUploadSize = ini_get('upload_max_filesize');
			$maxUploadSizeString = $this->getMaxUploadSizeDisplayFormat($maxUploadSize);
			$this->set('maxUploadSizeString', $maxUploadSizeString);
			$maxUploadSizeBytes = $this->return_bytes($maxUploadSize);
			$this->set('maxUploadSizeBytes', $maxUploadSize);
			
			//Wurde wirklich eine Datei hochgeladen?
			if (!isset($this->request->data['User']['File']['tmp_name']) || !is_uploaded_file($this->request->data['User']['File']['tmp_name'])) {
				$this->Session->setFlash('Fehler beim Hochladen der Datei.<br/>Möglicherweise wurde die maximal erlaubte Dateigröße von '.$maxUploadSizeString.' überschritten.', 'alert-box', array('class' => 'alert-error'));
				return $this->redirect(array('action' => 'index'));
			}
			
			//Ist die hochgeladene Datei zu groß?
			if ($this->request->data['User']['File']['size'] > $maxUploadSizeBytes) {
				$this->Session->setFlash('Die Datei ist zu groß.', 'alert-box', array('class' => 'alert-error'));
				return $this->redirect(array('action' => 'index'));
			}
			
			$result = DatabaseManager::import($this->request->data['User']['File']['tmp_name']); 
			if ($result === true) {
				//Import erfolgreich
				$this->Session->setFlash('Installation erfolgreich abgeschlossen.', 'alert-box', array('class' => 'alert-success'));
				return $this->redirect(array('controller' => 'login', 'action' => 'index'));
			} else {
				$this->Session->setFlash($result, 'alert-box', array('class' => 'alert-error'));
			}
			
		}	

		return $this->redirect(array('controller' => 'install', 'action' => 'index'));
	}
	
	/**
	 * Installation erfolgt durch die Erstellung einer neuen, leeren Datenbank.
	 * Einziger Eintrag in dieser Datenbank ist der eine Benutzer, der in dem Formular angegeben wurde.
	 * 
	 * @author aloeser
	 * @return void
	 */
	public function create() {
		
		if ($this->request->is('post')) {
			$this->request->data['User']['lname'] = $this->request->data['User']['username'];
			$this->request->data['User']['admin'] = 1;
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$currentUser = $this->User->find('first', array('conditions' => array('username' => $this->request->data['User']['username'])));
				$this->Auth->login($currentUser['User']);
				$this->Session->setFlash('Installation erfolgreich abgeschlossen.', 'alert-box', array('class' => 'alert-success'));
				return $this->redirect($this->Auth->redirectUrl());
			} else {
				$this->Session->setFlash('Benutzer konnte nicht angelegt werden.', 'alert-box', array('class' => 'alert-error'));
				
				//Fehlerinformationen vor Redirect sichern
				$this->Session->write('InstallByCreateValidationErrors', $this->User->validationErrors);
			}
			
		}
		
		return $this->redirect(array('action' => 'index'));
	}
	
	/**
	 * Wenn bereits Benutzer in der Datenbank eingetragen sind, dürfen nicht einmal mehr Administratoren die Installation aufrufen.
	 */
	public function beforeFilter() {
		$this->loadModel("User");
		if ($this->User->find('count') > 0) {
			return;
		} else {
			$this->Auth->allow();
		}
	}
	
	public function isAuthorized($user) {
		//Nach der Installation darf diese Seite nicht mehr aufgerufen werden
		return false; 
	}
	
	/**
	 * Ermittelt die absolute Byteanzahl, die eine hochgeladene Datei haben darf, und gibt diese zurück
	 * 
	 * Folgender Code stammt direkt von http://www.php.net/manual/en/function.ini-get.php
	 * und kann hier ohne weitere Anpassungen direkt verwendet werden
	 * 
	 * @param val - eine Dateigrößenangabe im Format von ini_get('upload_max_filesize')
	 * @return int
	 */
	private function return_bytes($val) {
		$val = trim($val);
		$last = strtolower($val[strlen($val)-1]);
		switch($last) {
			// The 'G' modifier is available since PHP 5.1.0
			case 'g':
				$val *= 1024;
			case 'm':
				$val *= 1024;
			case 'k':
				$val *= 1024;
		}
	
		return $val;
	}
	
	/**
	 * Ermittelt einen String, der die absolute Byteanzahl, die eine hochgeladene Datei haben darf,
	 * repräsentiert und gibt diesen zurück
	 *
	 * @param origVal - eine Dateigrößenangabe im Format von ini_get('upload_max_filesize')
	 * @return string
	 */
	private function getMaxUploadSizeDisplayFormat($origValue) {
		$val = trim($origValue);
		$last = strtolower($val[strlen($val)-1]);
		switch($last) {
			case 'g':
			case 'm':
			case 'k':
				$val .= "iB";
		}
		return $val;
	}
}
?>