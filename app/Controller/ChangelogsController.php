<?php
App::uses('AppController', 'Controller');
/**
 * Changelogs Controller
 *
 * @property Changelog $Changelog
 * @property PaginatorComponent $Paginator
 */
class ChangelogsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	
	public $paginate = array(
			'fields' => array('Changelog.for_date','Changelog.change_date','Changelog.value_before','Changelog.value_after','Changelog.column_name','Changelog.user_did'),
			'limit' => 25,
			'order' => array(
					'Changelog.id' => 'desc'
			),
	);

/**
 * Der View werden die letzten $count Einträge aus der Datenbank zur Verfügung gestellt 
 * Default: 50 Einträge
 *	
 * @author jgraeger
 * @return void
 */
	public function index($count=50) {
		if ($count <= 0) $count = 50;
		$this->Changelog->recursive = 0;
		$this->paginate['limit'] = $count;
		$this->Paginator->settings = $this->paginate;				
		$this->set('changelogs', $this->Paginator->paginate());
		
		$actions =  array();
		
		if ($count >= 51){
			$actions['less'] = array('text' => 'Weniger anzeigen','params' => array('controller'  => 'changelogs', 'action' => 'index', $count - 50));
		}
		
		//Mit jedem Klick auf "Mehr anzeigen" werden 200 Einträge mehr angezeigt
		$actions['more'] = array('text' => 'Mehr anzeigen','params' => array('controller'  => 'changelogs', 'action' => 'index', $count + 200));
		
		$this->set('actions', $actions);
	}
}
