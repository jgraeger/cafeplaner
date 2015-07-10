<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	
	public $components = array('DebugKit.Toolbar',
		'Auth' => array(
        'authenticate' => array(
            'Form' => array(
            	//Wie der Passworthash gebildet werden soll
                'passwordHasher' => array(
                    'className' => 'Simple',
                    'hashType' => 'sha1'
                )
            )
        ),
				
		//Wenn eine Anmeldung erforderlich, aber noch nicht erfolgt ist, wird auf diese Seite umgeleitet
		'loginAction' => array('controller' => 'login', 'action' => 'index'),
				
		//Automatische Umleitung nach dem Login, falls direkt auf die Loginseite zugegriffen wurde
		//Wurde zuvor auf eine Seite zugegriffen, die einen Login erfordert, so wird die folgende Zeile ignoriert
		//und stattdessen auf diese weitergeleitet 
		'loginRedirect' => array('controller' => 'plan', 'action' => 'index'),
				
		//Automatische Umleitung nach dem Logout
		'logoutRedirect' => array('controller' => 'login', 'action' => 'index'),

		//Die angezeigte Fehlermeldung, wenn man eine Seite ohne Login aufruft 
        'authError' => 'Für diese Funktion ist ein Login notwendig.',
        
		//Legt fest, wo grundlegende Autorisierung stattfindet -> im Controller
		'authorize' => array('Controller')
    ));
	
	public $helpers = array(
			'Session',
			'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
			'Form' => array('className' => 'BoostCake.BoostCakeForm'),
			'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
			);
	
	/**
	 * beforeFilter() legt fest, welche Aktionen (=URLs) aufgerufen werden dürfen,
	 * ohne dass der Benutzer angemeldet sein muss
	 * 
	 * Zusätzlich findet hier eine Überprüfung statt:
	 * 	Wurde mindestens ein Nutzer in die users-Tabelle eingetragen?
	 * 		Nein: Umleitung zur Installation (/install)
	 * 		Ja: weiter im Programm
	 * 
	 * @see Controller::beforeFilter()
	 * @author jgraeger
	 * @return void
	 */
   	public function beforeFilter() {
		parent::beforeFilter();
		//Wenn keine Benutzer eingetragen sind, alles umleiten auf /install
		$this->loadModel("User");
		if ($this->User->find('count') == 0) {
			//Falls die DB irgendwann durch Zufall einmal verschwindet, aktive Nutzer ausloggen
			$this->Auth->logout();
			return $this->redirect(array("controller" => "install", "action" => "index"));	
		}
	}
	
	/**
	 * isAuthorized($user) prüft, ob der $user berechtigt ist, eine bestimmte Methode
	 * aufzurufen. Diese Funktion ist für das gesamte Autorisierungssystem zuständig.
	 * 
	 * @author jgraeger
	 * @param user
	 * @return boolean
	 */
	public function isAuthorized($user) {
		//Administrator darf alles
		if ($this->isAdmin()) {
			return true;
		}
		
		return false;
	}
	
	/**
	 * Prüft, ob ein Benutzer über Administratorrechte verfügt.
	 * Gibt im Erfolgsfall true zurück, sonst false
	 * <p>
	 * Administratorrechte besitzen alle Benutzer, deren Attribut 'admin' > 0 ist.
	 * Dies beinhaltet 1 => Administrator und 2 => Programmierer
	 * </p>
	 * @author jgraeger
	 * @return boolean
	 */
	public function isAdmin() {
		return AuthComponent::user('id') && AuthComponent::user('admin') > 0;
	}
}
