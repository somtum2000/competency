<?php
App::uses( 'AppController', 'Controller' ); 

class ProjectAdminController extends AppController {

  public $layout = 'admin';

  public $uses = array(
			'Project',
			'ProjectUser',
			'Evaluate',
			'Company',
			'Department',
			'Position',
			'User',
			'Countries',
			'ProjectStatus',
			'DataDictionary',
			'CC',
			'MC',
			'FC'
	);


	public function beforeFilter() {
		parent::beforeFilter();
		$this->isAdmin();
	}	
	
	public function add( $companyID = null ) {
	
		$projManagerList = array();
		
		$companies = $this->Company->find( 'list', array (
																									'fields' => array( 'company_id', 'company_name' ),
																									'order'  => array( 'company_name')
																			) );

		$projStatusList = $this->ProjectStatus->find( 'list', array (
																									'fields' => array( 'ProjectStatus.status_id', 'ProjectStatus.status_name' ),
																									'order'  => array( 'ProjectStatus.status_name')
																			) );

																			
		if ( isset($companyID) ) {
			$projManagerList = $this->User->find( 'list', array (
																										'conditions' => array ( 'User.company_id' => 1, 'active' => 1 ),
																										'fields' => array( 'User.id', 'User.first_name' ),
																										'order'  => array( 'User.first_name')
																				) );
		}

		if ( $this->request->is('post') ) {
			$data = $this->request->data;			
			$this->Project->create();
			
			if ( $this->Project->save( $data ) ) {
				$this->Session->setFlash( __('The Project has been created'), 'flashSuccess' );
				$this->redirect( array( 'controller' => 'projectAdmin', 'action' => 'projectList') );
			} else {
				$this->set( 'errors', array( __( 'The Project could not be created. Please, try again.', true ) ) );
			}	
		}

		$this->set ( 'title_for_layout', __('Create New Project') );
		$this->set( 'companyID', $companyID );
		$this->set( 'companies', $companies );
		$this->set( 'projStatusList', $projStatusList );
		$this->set( 'projManagerList', $projManagerList );
	}
	
	
	public function edit( $companyID = null, $projID = null ) {
		$project = $this->Project->find( 'first', array (
																									'conditions' => array (
																											'Project.company_id' => $companyID,
																											'Project.proj_id' => $projID,
																									)
																			) );
	
		$projStatusList = $this->ProjectStatus->find( 'list', array (
																									'fields' => array( 'ProjectStatus.status_id', 'ProjectStatus.status_name' ),
																									'order'  => array( 'ProjectStatus.status_name')
																			) );
		

		// get list of internal users to be project manager
		if ( isset($companyID) ) {
			$projManagerList = $this->User->find( 'list', array (
																										'conditions' => array ( 'User.company_id' => 1, 'active' => 1 ),
																										'fields' => array( 'User.id', 'User.first_name' ),
																										'order'  => array( 'User.first_name')
																				) );
		}
		
		
		if ( $this->request->is('post') ) {
			$data = $this->request->data;
			
			if ( $this->Project->save( $data ) ) {
				$this->Session->setFlash( __('Project is updated'), 'flashSuccess' );
				$this->redirect( array( 'controller' => 'projectAdmin', 'action' => 'projectList') );
			} else {
				$this->set( 'errors', array( __( 'Project can not be update, Please, try again.', true ) ) );
			}	
		}
	
		$this->set ( 'title_for_layout', __('Edit') );
		
		$this->set ( 'companyID', $companyID );
		$this->set ( 'projID', $projID );

		$this->set ( 'project', $project );
		$this->set ( 'projStatusList', $projStatusList );
		$this->set ( 'projManagerList', $projManagerList );
	}
	
	
	public function projectList() {
		$projects = $this->Project->find( 'all', array (
																								'order'  => array( 'proj_name')
																							) );
		
		$this->set ( 'title_for_layout', __('Project List') );
		$this->set( 'projects', $projects );
	}
	
	
	
	public function viewProject( $companyID = null, $projID = null ) {
		$departments = array();
		$project = array();
		$positions = array();
		
		$cc = array();
		$mc = array();
		$fc = array();
		
		$dd = array();
		$userAssigned = array();
		$projectUsers = array();
		
		
		
		if ( isset($companyID) ) $this->set ( 'projects', $this->Project->getProjectList($companyID) );
		
		if ( isset($companyID) and isset($projID) ) {
				$cc = $this->CC->find( 'all', array (
																								'conditions' => array(
																									'CC.company_id' => $companyID,
																									'CC.proj_id' => $projID
																								),
																				) );
																				
				$mc = $this->MC->find( 'all', array (
																								'conditions' => array(
																									'MC.company_id' => $companyID,
																									'MC.proj_id' => $projID
																								),
																				) );
																				
				$project = $this->Project->find( 'first', array (
																								'conditions' => array(
																									'Project.company_id' => $companyID,
																									'Project.proj_id' => $projID
																								),
																								'order'  => array( 'proj_name')
																				) );

																				
																				
				$positions = $this->Position->find( 'all', array (
																								'conditions' => array(
																									'Position.company_id' => $companyID,
																								),
																								'order'  => array( 'position_name')
																				) );
																				
																				
																				
				$departments = $this->Department->getDepartmentList( $companyID );
				
				

				// List of Data Dictionary 
				$dd = $this->DataDictionary->find( 'all', array (
																								'conditions' => array(
																										'DataDictionary.company_id' => $companyID, 'DataDictionary.proj_id' => $projID,
																								),
																								'order'  => array( 'order_number')
																					) );
				
				// List of user in this project
				$projectUsers = $this->ProjectUser->find( 'list', array (
																								'fields' => array ( 'ProjectUser.user_id' ),
																								'conditions' => array(
																										'ProjectUser.company_id' => $companyID,
																										'ProjectUser.proj_id' => $projID,
																								),
																					) );
				$projectUsers = $this->User->find( 'all', array (
																								'conditions' => array(
																										'User.company_id' => $companyID,
																										'User.id' => $projectUsers,
																								),
																					) );
																								
				// LIst of user has been assigned to project
				$userAssigned = $this->Evaluate->find( 'list', array (
																									'fields' => array ( 'Evaluate.source_id' ),
																									'conditions' => array(
																										'Evaluate.company_id' => $companyID,
																										'Evaluate.proj_id' => $projID
																									),
																									'group' => 'Evaluate.source_id'
																								) );
				$userAssigned = $this->User->find( 'all', array (
																								'conditions' => array(
																										'User.id' => $userAssigned,
																								)
																					) );
				
		}
		
		$this->set ( 'title_for_layout', __('Project') );
		
		$this->set ( 'companies', $this->Company->getCompanyList() );
		$this->set ( 'companyID', $companyID );
		
		$this->set ( 'departments', $departments );
		
		$this->set ( 'project', $project );
		$this->set ( 'projID', $projID );
		
		$this->set ( 'projectUsers', $projectUsers );
		$this->set ( 'dd', $dd );
		$this->set ( 'userAssigned', $userAssigned );
		
		$this->set ( 'positions', $positions );
		
		$this->set ( 'cc', $cc );
		$this->set ( 'mc', $mc );
		$this->set ( 'fc', $fc );
		
	}
}