<?php
class UsersController extends AppController {
    var $name = 'Users';
	var $components = array('Flash');
	
    function login() {
	// implemented by AuthComponent
    }
	
    function logout() {
	$this->redirect($this->Auth->logout());
    }
	
	function view() {
		
		if(!empty($this->request->data('User.username')) && !empty($this->request->data('User.password')) && $this->User->find('all', array('conditions' => array('User.username' => $this->request->data('User.username'))))){
			if($this->User->UserGroup->find('all', array('conditions' => array('User.username' => $this->request->data('User.username')),'fields' => array('UserGroup.groupId')))[0]['UserGroup']['groupId'] == "1"){
				$this->set('username', $this->User->find('all', array('conditions' => array('User.username' => $this->request->data('User.username')),'fields' => array('username')))[0]['User']['username']);
				$this->Flash->set($this->User->find('all', array('conditions' => array('User.username' => $this->request->data('User.username')),'fields' => array('username')))[0]['User']['username']." successfully logged in!");
			} else {
				
				$this->Flash->set("User does not have permissions. Please contact administrator.");
				$this->redirect($this->Auth->logout());
			}
			
		} else {
			$this->Flash->set("User not found...Try again!");
			$this->redirect($this->Auth->logout());
		}
	}	
}
?>