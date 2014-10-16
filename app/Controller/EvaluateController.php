<?php
App::uses( 'AppController', 'Controller' );

class EvaluateController extends AppController {
  public $layout = 'default'; 

  public $uses = array( 'Department', 'DataDictionary', 'Evaluate' );
	
	public function beforeFilter() {
		parent::beforeFilter();
	}
	
	public function evaluation( $targetID, $token ) {
		$user = $this->Auth->user();
		
		if ( isset($targetID) and isset($token) ) {
			$task = $this->Evaluate->find ( 'first', array (
																									'conditions' => array (
																											'Evaluate.source_id' => $user['id'],
																											'Evaluate.target_id' => $targetID,
																											'Evaluate.token' => $token
																									),
																		 ) );
																		 
			if (empty($task)) $this->redirect( array( 'controller' => 'users', 'action' => 'dashboard' ) );
			
			//debug ($task);
			
			$dd = $this->DataDictionary->find ( 'all', array (
																									'conditions' => array (
																											'DataDictionary.company_id' => $user['company_id'],
																											'DataDictionary.proj_id' => $task['Evaluate']['proj_id'],
																											'DataDictionary.dept_id' => $task['TargetUser']['dept_id'],
																									),
																				) );
			//debug ($dd);
			
		} else {
			$this->redirect( array( 'controller' => 'users', 'action' => 'dashboard' ) );
		}
		
		
		$this->set ( 'user', $user );
		$this->set ( 'dd', $dd );
	}
	
}