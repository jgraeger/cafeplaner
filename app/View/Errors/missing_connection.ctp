<?php

//Wenn dieser View aufgerufen wird, dann existiert die Datenbank noch nicht -> Erstellen
App::uses('DatabaseManager', 'Model');
SessionComponent::delete('Auth');

//Testen, ob Zugriff auf den Datenbankserver besteht
//wenn nicht -> Fehlermeldung
//TODO wie die von Cake automatisch generierte Fehlermeldung unterdrücken?
if (DatabaseManager::connect(false) !== true) {
	$this->extend(APP."View".DS."Layouts".DS."default.ctp");
	
	$content = 
		"<div class='alert alert-error'>
			Ein schwerwiegender Fehler ist aufgetreten:<br/>
			Es konnte keine Verbindung zur Datenbank hergestellt werden!<br/>
			<br/>
			Bitte wenden Sie sich umgehend an Ihren Administrator.
		</div>";
	$this->assign('content', $content);
	require APP."View".DS."Layouts".DS."default.ctp";
	die(1);
}

//Datenbank- und Tabellenstruktur anlegen
DatabaseManager::createDatabaseStructure();

//Installation einleiten
//header("Location: /Cafeteria/install");
$this->redirect(array('controller' => 'install', 'action' => 'index'));
?>