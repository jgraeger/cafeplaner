<?php
/**
 * Der MailController bietet die Funktion, eine Rundmail zu verschicken.
 * @author aloeser
 */
class MailController extends AppController {
	public $uses = array('User');
	public $components = array('Paginator','Session');
	
	/**
	 * Wenn es sich um einen POST-Request handelt, wird eine Rundmail mit den übergebenen Daten versendet.
	 * 
	 * @author aloeser
	 * @return void
	 */
	public function index(){
		if ($this->request->is('POST')) {
			$conditions = array('User.mail !=' => '', 'User.admin != ' => 2);
			if (!$this->request->data['Mail']['sendToAll']) $conditions['User.leave_date'] = null;
			$activeUsersWithEmail = $this->User->find('all', array(
					'conditions' => $conditions
			));
			
			$receivers = array();
			
			foreach ($activeUsersWithEmail as $user) {
				array_push($receivers, $user['User']['mail']);
			}
			
			$senderMail = 'humboldt-cafeteria@versanet.de';
			$senderName = 'Humboldt Cafeteria';
			
			$EMail = new CakeEmail();
			$EMail->from(array($senderMail => $senderName));
			$EMail->bcc($receivers);
			$EMail->subject($this->request->data['Mail']['subject']);
			$EMail->config('web');
			$EMail->template('default');
			$EMail->emailFormat('html');
			$EMail->viewVars(array(
					'senderName' => $senderName,
					'senderMail' => $senderMail,
					'content' => $this->request->data['Mail']['content'],
					'subject' => $this->request->data['Mail']['subject'],
					'allowReply' => $this->request->data['Mail']['allowReply']
			));

			if ($EMail->send()) {
				$this->Session->setFlash('Die Rundmail wurde erfolgreich abgeschickt.', 'alert-box', array('class' => 'alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Beim Senden ist ein Fehler aufgetreten.', 'alert-box', array('class' => 'alert-error'));
			}
		}
		
		$this->set('actions', array());
	}
	
	public function isAuthorized($user) {
		return parent::isAuthorized($user);
	}
}

?>
