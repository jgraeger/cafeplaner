<?php
App::uses('DatabaseManager', 'Model');
/**
 * Der BackupController bietet die Möglichkeit, den Datenbankzustand zu einem bestimmten Zeitpunkt zu sichern.
 * Des Weiteren wird die Möglichkeit geboten, einen gesicherten Zustand wiederherzustellen.
 * 
 * @author aloeser
 */
class BackupController extends AppController {
	
	public $uses = false;

	public $components = array('Session');
	
	/**
	 * Die Funktion index() hat überwiegend eine Darstellungsfunktion. Sie ermittelt webserverspezifische
	 * Konstanten wie upload_max_filesize und stellt diese der index.ctp zur Verfügung.
	 * Handelt es sich um einen POST-Request, so wird zusätzlich noch versucht, eine früheren Datenbankzustand wiederherzustellen.
	 * 
	 * @see DatabaseManager::import()
	 * @author aloeser
	 * @return void
	 */
	public function index() {
		$maxUploadSize = ini_get('upload_max_filesize');
		$maxUploadSizeString = $this->getMaxUploadSizeDisplayFormat($maxUploadSize);
		$this->set('maxUploadSizeString', $maxUploadSizeString);
		$maxUploadSizeBytes = $this->return_bytes($maxUploadSize);
		$this->set('maxUploadSizeBytes', $maxUploadSizeBytes);
		
		if ($this->request->is('post')) {
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
				$this->Session->setFlash('Wiederherstellung erfolgreich abgeschlossen.', 'alert-box', array('class' => 'alert-success'));
				return $this->redirect($this->Auth->logout());
			} else {
				$this->Session->setFlash($result, 'alert-box', array('class' => 'alert-error'));
			}
		}
		
		$actionArray = array(
				'import' => array('text' => 'Zustand wiederherstellen','htmlattributes' => array('onClick' => '$( "#ImportDumpForm" ).submit()')),
				'export' => array('text' => 'Sicherung durchführen','params' => array('controller' => 'backup', 'action' => 'export'))
		);
		$this->set('actions', $actionArray);
	}
	
	/**
	 * Dient zum Export der aktuellen Datenbank.
	 * Setzt den notwendigen Inhalt (den [verschlüsselten] Datenbankdump) für die export.ctp
	 * 
	 * @see DatabaseManager::export()
	 * @author aloeser
	 * @return void
	 */
	public function export() {
		$this->set('filename', 'Sicherung_Cafeteria_'.date('d_m_Y', time()).'.sql');
		$this->layout = 'download';
		$dump = DatabaseManager::export();
		$this->set('dump', $dump);
	}
	
	/**
	 * Ermittelt, ob der Benutzer eine bestimmte Aktion durchführen darf und gibt dementsprechend true oder false zurück.
	 * 
	 * @param user - der Benutzer
	 * @author aloeser
	 * @return boolean
	 */
	public function isAuthorized($user) {
		return parent::isAuthorized($user);
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
