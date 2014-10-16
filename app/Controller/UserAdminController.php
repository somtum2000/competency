<?php
App::uses( 'AppController', 'Controller', 'CakeEmail', 'Network/Email' );

class UserAdminController extends AppController {

	public $layout = 'admin';
	
	public $uses = array( 'Company', 'Project', 'ProjectUser', 'Evaluate', 'User', 'Department', 'DataDictionary', 'Group' );
	
	public $paginate = array(
		'limit' => 25,
		'conditions' => array('status' => '1'),
		'order' => array('User.username' => 'asc' ) 
	);
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->isAdmin();
	}
	
	
	public function index() {
	}
	
	
	public function add( $companyID = null ) {
		$title_for_layout = __('Add New User');
		$companies = array();
		$departments = array();
		$userGroups = array();
		$data = array();
		
		// Start the page
		$companies = $this->Company->find( 'list', array (
																									'fields' => array( 'company_id', 'company_name' ),
																									'order'  => array( 'company_name')
																			) );

		
		if ( isset($companyID) ) {
			// if CompanyID is not null, get department list
			$departments = $this->Department->getDepartmentList($companyID);
			
			// get group list
			$userGroups = $this->Group->getUserGroup( $companyID );
		}
		
		
		
		
		if ( $this->request->is('post') ) {
			$data = $this->request->data;
			$data['User']['username'] = $data['User']['email'];
			$data['User']['country_id'] = $this->Company->getCompanyCountryID( $companyID );
			$data['User']['email_hash'] = $this->generateRandomHash();
			$data['User']['uuid'] = $this->generateUUID();
			
			$this->User->create();
			
			// remove validator because this information user will be provide when they activate an account.
			$this->User->validator()->remove( 'username' );
			$this->User->validator()->remove( 'password' );
			$this->User->validator()->remove( 'gender' );
			$this->User->validator()->remove( 'cell_phone' );
			
			
			if ( $this->User->save( $data ) ) {
				$this->Session->setFlash( __('User has been created'), 'flashSuccess' );
			} else {
				$this->Session->setFlash( __('Can not create user'), 'flashDanger' );
			}
		}
		
		$this->set ( 'title_for_layout', $title_for_layout );
		
		$this->set ( 'companyID', $companyID );
		$this->set ( 'companies', $companies );
		$this->set ( 'departments', $departments );
		$this->set ( 'userGroups', $userGroups );
		$this->set ( 'data', $data );
	}
	
	
	
	public function userList() {
		$title_for_layout = __('User List');
		
		$users = $this->User->find( 'all', array (
																									'order'  => array( 'first_name' )
																			) );
																			
		$this->set ( 'users', $users );
	}
	
	
	
	public function viewUser() {
		$title_for_layout = __('User Information');
		
		
		$this->set ('users', $users );
	}
	
	
	
	
	public function assignUsers( $companyID = null, $projID = null, $evaluatorID = null ) {
		$title_for_layout = __('Assign Users');
		$companies = array();
		$projects = array();
		$evaluators = array();
		$evaluator = array();
		$sourceAssigned = array();
		$availableUsers = array();
		$targetAssigned = array();
		$results['Success'] = array();
		$results['Failed'] = array();
		
		if ( isset($_POST['userList'] ) ) {
			if ( is_array( $_POST['userList'] ) ) {
				foreach($_POST['userList'] as $value){
				}
			} else { $value = $_POST['userList'];	}
			
			
			if ( is_array( $_POST['userRelation'] ) ) {
				foreach($_POST['userRelation'] as $value){
				}
			} else { $value = $_POST['userRelation'];	}
			
			$temp = $this->request->data;
			
			for ( $i=0; $i<count($temp['userList']); $i++ ) {
				$data['Evaluate'][$i]['company_id'] = $companyID;
				$data['Evaluate'][$i]['proj_id'] = $projID;
				$data['Evaluate'][$i]['source_id'] = $evaluatorID;
				$data['Evaluate'][$i]['target_id'] = $temp['userList'][$i];
				$data['Evaluate'][$i]['user_relation'] = $temp['userRelation'][$i];
				$data['Evaluate'][$i]['token'] = $this->generateRandomString(16);
			}
		
			
			$s = 0; //number of success;
			$f = 0; // number of failed;
			for ( $i=0; $i<count($data['Evaluate']); $i++ ) {
				$this->Evaluate->create();
				if ( $this->Evaluate->save($data['Evaluate'][$i]) ) {
					$results['Success'][$s] = $data['Evaluate'][$i]['target_id'];
					$s++;
					
				} else {
					$results['Failed'][$f] = $data['Evaluate'][$i]['target_id'];
					$f++;
				}
			}

			
			// get list of users that success to assign
			if ( count($results['Failed']) >= 0 ) { 
				$temp = $this->User->find ( 'all', array (
																								'conditions' => array ( 'OR' => array (	'User.id' => $results['Success'] ) )
																		) );
				for ( $i=0; $i<count($temp); $i++ ) {
					$results['Success'][$i] = $temp[$i]['User']['first_name'] . ' ' . $temp[$i]['User']['last_name'];
				}
			}
			
			

			// get list of users that failed to assign
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
		
		
		
		
		// Start the page
		$companies = $this->Company->find( 'list', array (
																									'fields' => array( 'company_id', 'company_name' ),
																									'order'  => array( 'company_name')
																			) );
																			
		if ( isset($companyID) ) {
			$projects = $this->Project->find( 'list', array (
																										'conditions' => array( 'Project.company_id' => $companyID ),
																										'fields' => array( 'Project.proj_id', 'Project.proj_name' ),
																										'order'  => array( 'proj_name')
																				) );
			
			if ( isset($projID) ) {
				$evaluators = $this->ProjectUser->find( 'list', array (
																										'fields' => array ('user_id'),
																										'conditions' => array (
																												'ProjectUser.company_id' => $companyID,
																												'ProjectUser.proj_id' => $projID
																										)
																			) );
																			
				$sourceAssigned = $this->Evaluate->find( 'list', array (
																										'fields' => array ( 'Evaluate.source_id' ),
																										'conditions' => array (
																												'Evaluate.company_id' => $companyID,
																												'Evaluate.proj_id' => $projID,
																										),
																										'group' => 'source_id'
																			) );
																			
				$evaluators = $this->User->getUsersList( $evaluators );
				$sourceAssigned = $this->User->getAssignedList( $sourceAssigned );

				
				
				
				// $log = $this->User->getDataSource()->getLog(false, false);
				// debug($log);
			}
			
			if ( isset($evaluatorID) ) {
				$evaluator = $this->User->find( 'first', array (
																										'conditions' => array (
																												'User.id' => $evaluatorID,
																												'User.company_id' => $companyID,
																										)
																			) );

				// list of user that has been assigned to source
				$targetAssigned = $this->Evaluate->find( 'list', array (
																										'fields' => array ('Evaluate.target_id'),
																										'conditions' => array (
																												'Evaluate.company_id' => $companyID,
																												'Evaluate.proj_id' => $projID,
																												'Evaluate.source_id' => $evaluator['User']['id'],
																										),
																										'group' => 'target_id'
																			) );

				// get list of user that have NOT been assign
				$availableUsers = $this->ProjectUser->find( 'list', array (
																										'fields' => array ('user_id'),
																										'conditions' => array (
																												'ProjectUser.company_id' => $companyID,
																												'ProjectUser.proj_id' => $projID,
																												'NOT' => array(
																														'ProjectUser.user_id' => $targetAssigned,
																												),
																										)
																			) );
																			
																			
				$targetAssigned = $this->Evaluate->find( 'all', array (
																										'conditions' => array (
																												'Evaluate.company_id' => $companyID,
																												'Evaluate.proj_id' => $projID,
																												'Evaluate.source_id' => $evaluator['User']['id'],
																										),
																										'group' => 'target_id'
																			) );
				//debug ($targetAssigned);
				//$targetAssigned = $this->User->getAssignedList( $targetAssigned );
				$availableUsers = $this->User->getUsersList( $availableUsers );
			}
		}
		
		$this->set ( 'title_for_layout', $title_for_layout );
		
		$this->set ( 'companies', $companies ); // list of companies
		$this->set ( 'companyID', $companyID );

		$this->set ( 'projects', $projects ); // list of projects
		$this->set ( 'projID', $projID );
		
		$this->set ( 'evaluators', $evaluators ); // list of evaluators
		$this->set ( 'sourceAssigned', $sourceAssigned ); // list of evaluators has been assigned

		$this->set ( 'evaluator', $evaluator ); // selected evaluator
		$this->set ( 'evaluatorID', $evaluatorID );
		
		$this->set ( 'availableUsers', $availableUsers ); // list of users hasn't been assign to evaluator
		$this->set ( 'targetAssigned', $targetAssigned ); // list of users that assigned to evaluator
	}
	

  public function activateUsers( $id = null ) {
		$title_for_layout = __('Activate Users');
		$errors = array();
		$data = array();
		$user = $this->Auth->user();

	
		// find active users, but not logged in user
		// logged in user can not de activate itself
		$users = $this->User->find ( 'all', array (
																							'conditions' => array (
																									'active' => 0,
																									'NOT' => array( 'User.id' => $user['id'] )
																							)
															));
		
		if ( isset($id) ) {
			$selectedUser = $this->User->find ( 'first', array (
																							'conditions' => array ( 'id' => $id )
															));
			if ( !empty($selectedUser) ) {
				$data['User']['id']= $selectedUser['User']['id'];
				$data['User']['active'] = 1;
				$this->User->set($data);
				if ($this->User->save()) {
					$this->Session->setFlash( __('User is now active'), 'flashSuccess' );
					$users = $this->User->find ( 'all', array (
																							'conditions' => array ( 'active' => 0 )
															));
				} else {
					$this->Session->setFlash( __('Error'), 'flashDanger' );
				}
			}

		}


		$this->set( 'title_for_layout', $title_for_layout );
		$this->set( 'users', $users );
		$this->set( 'errors', $errors );
		$this->set( 'data', $data );
  }
	
	
	
	
  public function deactivateUsers( $id = null ) {
		$title_for_layout = __('Deactivate Users');
		$errors = array();
		$data = array();
		
		$user = $this->Auth->user();
		
		// find non active users, but not logged in user
		// logged in user can not activate itself
		$users = $this->User->find ( 'all', array (
																							'conditions' => array (
																									'active' => 1,
																									'NOT' => array( 'User.id' => $user['id'] )
																							)
															));
		
		if ( isset($id) ) {
			$selectedUser = $this->User->find ( 'first', array (
																							'conditions' => array ( 'id' => $id )
															));
			if ( !empty($selectedUser) ) {
				$data['User']['id']= $selectedUser['User']['id'];
				$data['User']['active'] = 0;
				$this->User->set($data);
				if ($this->User->save()) {
					$this->Session->setFlash( __('User is now deactive'), 'flashSuccess' );
					$users = $this->User->find ( 'all', array (
																							'conditions' => array ( 'active' => 1 )
															));
				} else {
					$this->Session->setFlash( __('Error'), 'flashDanger' );
				}
			}

		}

		

		$this->set( 'title_for_layout', $title_for_layout );
		$this->set( 'users', $users );
		$this->set( 'errors', $errors );
		$this->set( 'data', $data );
  }

}