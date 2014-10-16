<?php
App::uses( 'AppController', 'Controller' ); 

class ProjectUserAdminController extends AppController {

  public $layout = 'admin';

  public $uses = array( 'Project', 'Company', 'User', 'Countries', 'ProjectStatus', 'DataDictionary', 'ProjectUser', 'Evaluate' );


	public function beforeFilter() {
		parent::beforeFilter();
		$this->isAdmin();
	}	
	
	public function add( $companyID = null, $projID = null ) {
		$title_for_layout = __('Add Users to Project');
		$evaluators = array();
		$evaluator = array();
		$sourceAssigned = array();
		$availableUsers = array();
		$targetAssigned = array();
		$results['Success'] = array();
		$results['Failed'] = array();
	
	

		if ( isset($_POST['userList'] ) ) {
			if ( is_array( $_POST['userList'] ) ) { // selected more than 1 user.
				foreach($_POST['userList'] as $value){
				}
			} else { // selected just one user
				$value = $_POST['userList'];
			}
			
			// get post data
			$temp = $this->request->data;
			
			
			// prepare data to array before save into table 'project_user'
			for ( $i=0; $i<count($temp['userList']); $i++ ) {
				$data['ProjectUser'][$i]['company_id'] = $companyID;
				$data['ProjectUser'][$i]['proj_id'] = $projID;
				$data['ProjectUser'][$i]['user_id'] = $temp['userList'][$i];
			}
		
			
			$s = 0; // to count number of success;
			$f = 0; // to count number of failed;
			for ( $i=0; $i<count($data['ProjectUser']); $i++ ) {
			
				$this->ProjectUser->create();
				if ( $this->ProjectUser->save($data['ProjectUser'][$i]) ) { // if save success
					$results['Success'][$s] = $data['ProjectUser'][$i]['user_id'];
					$s++;


				} else { // if save failed
					$results['Failed'][$f] = $data['ProjectUser'][$i]['user_id'];
					$f++;
				}
			}

			
			// get list of users that save success to alert on the screen
			if ( count($results['Failed']) >= 0 ) { 
				$temp = $this->User->find ( 'all', array (
																								'conditions' => array ( 'OR' => array (	'User.id' => $results['Success'] ) )
																		) );
				for ( $i=0; $i<count($temp); $i++ ) {
					$results['Success'][$i] = $temp[$i]['User']['first_name'] . ' ' . $temp[$i]['User']['last_name'];
				}
			}
			
			

			// get list of users that failed to save to alert on the screen
			if ( count($results['Failed']) >= 0 ) { 
				$temp = $this->User->find ( 'all', array (
																								'conditions' => array ( 'OR' => array (	'User.id' => $results['Failed'] ) )
																		) );
				for ( $i=0; $i<count($temp); $i++ ) {
					$results['Failed'][$i] = $temp[$i]['User']['first_name'] . ' ' . $temp[$i]['User']['last_name'];
				}
			}
			
			

			
			// Able to save all user?
			if ( count( $results['Failed']) <= 0 ) {
				$message	= __( 'All users are assigned, no error' ) . ' ';
				$evaluatorID = null; // set evaluatorID = null because after save, it will let user select new evaluator
				$this->Session->setFlash( $message, 'flashSuccess' );
				
				
				
				
			// Some error?
			} else {
				$message	= __( 'Able to assign:' ) . ' ';
				for ($i=0; $i<count($results['Success']); $i++) {
					$message .= $results['Success'][$i] . ', ';
				}
				
				$message .= __( 'Failed to assign:' ) . ' ';
				for ($i=0; $i<count($results['Failed']); $i++) {
					$message .= $results['Failed'][$i] . ', ';
				}
				
				$this->Session->setFlash( $message, 'flashDanger' );
			}
		}

	
		if ( isset($companyID) and isset($projID) ) {			
			
			// filter only on selected company and project
			$userAssigned = $this->ProjectUser->find ( 'list', array (
																						'fields' => 'user_id',
																						'conditions' => array (
																							'ProjectUser.company_id' => $companyID,
																							'ProjectUser.proj_id' => $projID,
																						),
																	));

			// filter users on selected company and haven't add to selected project.
			$availableUsers = $this->User->find ( 'all', array (
																						'conditions' => array (
																							'NOT' => array ( 'User.id' => $userAssigned ),
																							'User.company_id' => $companyID
																						),
																	));
		}
		
		$this->set ( 'companyID', $companyID );
		$this->set ( 'projID', $projID );
		
		$this->set ( 'availableUsers', $availableUsers );
		$this->set ( 'userAssigned', $userAssigned );
	}


}