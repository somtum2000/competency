<?php
App::uses( 'AppController', 'Controller' );

class CompanyAdminController extends AppController
{
  public $layout = 'admin'; 

  public $uses = array( 'Company', 'User', 'Countries', 'Project', 'Department', 'Position' );
	
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->isAdmin();
	}	
	
	public function add() {
		$countries = $this->User->Countries->find( 'list', array (
																											'fields' => array( 'country_id', 'name' ),
																											'order'  => array( 'name')
																									) );
																									
		if ( $this->request->is('post') ) {
			$data = $this->request->data;
			
			$data['Company']['token'] = $this->generateRandomString();
			$data['Company']['external_guid'] = $this->generateUUID();
			$data['Company']['pin_code'] = $this->generateRandomPinCode();
			
			$this->Company->create();

			if ( $this->Company->saveAssociated( $data ) ) {
				$this->Session->setFlash( __('The Company has been created'), 'flashSuccess' );
				$this->redirect( array( 'controller' => 'companyAdmin', 'action' => 'index' ) );
			} else {
				$this->Session->setFlash( __( 'The Company could not be created. Please, try again.' ), 'flashDanger' );
			}
			
			$this->redirect( array( 'controller' => 'companyAdmin', 'action' => 'index') );
		}
		
		$this->set ( 'title_for_layout', __('Add New Company') );
		$this->set( 'countries', $countries );
	}
	
	
	
	public function edit( $companyID = null ) {
		$title_for_layout = __('Edit Company');
		$companies = $this->Company->find( 'list', array (
																					'fields' => array ( 'company_id', 'company_name' ),
																					'order'  => array( 'Company.company_name')
																		) );
		if ( isset($companyID) ) {
			$countries = $this->User->Countries->find( 'list', array (
																												'fields' => array( 'country_id', 'name' ),
																												'order'  => array( 'name')
																										) );
			$company = $this->Company->find( 'first', array (
																						'conditions' => array (
																							'Company.company_id' => $companyID
																						),
																						'order'  => array( 'Company.company_name')
																			) );
																										
			if ( $this->request->is('post') ) {
				$data = $this->request->data;
				
				if ( $this->Company->saveAssociated( $data ) ) {
					$this->Session->setFlash( __('Company successful updated'), 'flashSuccess' );
				} else {
					$this->Session->setFlash( __( 'Error, please contact Kobe' ), 'flashDanger' );
				}	
			} else {
				$this->request->data = $this->Company->read();
			}
			
			$this->set( 'countries', $countries );
			$this->set( 'company', $company );
		}
		
		$this->set ( 'title_for_layout', __('Edit') );
		$this->set ( 'companies', $companies );
		$this->set ( 'companyID', $companyID );
	}
	
	
	
	public function viewCompany( $companyID = null ) {
	
		$countries = array();
		$company = array();
		$users = array();
		$projects = array();
		$departments = array();
		$positions = array();
		
		if ( isset($companyID) ) {
		
			$company = $this->Company->find( 'first', array (
																						'conditions' => array (
																							'Company.company_id' => $companyID
																						),
																						'order'  => array( 'Company.company_name')
																			) );
																			
			if ( !empty($company) ) {
			
				$countries = $this->User->Countries->find( 'list', array (
																													'fields' => array( 'country_id', 'name' ),
																													'order'  => array( 'name')
																											) );

				
				$users = $this->User->find( 'all', array (
																							'conditions' => array (
																								'User.company_id' => $companyID,
																								//'User.active' => 1,
																							),
																							'order'  => array( 'User.first_name')
																				) );
				
				$projects = $this->Company->Project->find( 'all', array (
																							'conditions' => array (
																								'Project.company_id' => $companyID
																							),
																							'order'  => array( 'Project.created')
																				) );
																				
				$departments = $this->Department->find( 'all', array (
																							'conditions' => array (
																								'Department.company_id' => $companyID,
																							),
																							'order'  => array( 'Department.dept_name')
																				) );
																				
				$positions = $this->Position->find( 'all', array (
																							'conditions' => array (
																								'Position.company_id' => $companyID,
																							),
																							'order'  => array( 'Position.position_name')
																				) );
			}
		}
		
		
		$this->set ( 'title_for_layout', __('Company') );
		$this->set ( 'companies', $this->Company->getCompanyList() );
		$this->set( 'companyID', $companyID );
		$this->set( 'countries', $countries );
		$this->set( 'company', $company );
		$this->set( 'users', $users );
		$this->set( 'projects' , $projects );
		$this->set( 'departments' , $departments );
		$this->set( 'positions' , $positions );
	}
	
	
	
	public function index() {
		$companies = $this->Company->find( 'all', array (
																											'order'  => array( 'company_name')
																									) );


		for ( $i=0; $i<count($companies); $i++ ) {
			$temp = $this->Countries->find( 'first', array (
																											'conditions' => array (
																												'country_id' => $companies[$i]['Company']['country_id']
																											),
																									) );
																									
			$companies[$i]['Company']['country_name'] = $temp['Countries']['name'];
			
			
			
			$temp = $this->User->find( 'all', array (
																					'conditions' => array (
																						'User.company_id' => $companies[$i]['Company']['company_id'],
																						'Group.name' => 'Company Admin'
																					),
																					'order' => 'first_name'
																			) );
																			
																			
			$companies[$i]['Admin'] = $temp;
		}
		
		$this->set ( 'title_for_layout', __('Company List') );
		$this->set ( 'companies' , $companies );
	}
	
	
	
	public function admin() {
		$companies = $this->Company->find( 'all', array (
																											'order'  => array( 'company_name')
																									) );

		for ( $i=0; $i<count($companies); $i++ ) {
			$temp = $this->Countries->find( 'first', array (
																											'conditions' => array (
																												'country_id' => $companies[$i]['Company']['country_id']
																											),
																									) );
																									
			$companies[$i]['Company']['country_name'] = $temp['Countries']['name'];
			
			
			
			$temp = $this->User->find( 'all', array (
																					'conditions' => array (
																						'User.company_id' => $companies[$i]['Company']['company_id'],
																						'Group.name' => 'Company Admin'
																					),
																					'order' => 'first_name'
																			) );
																			
																			
			$companies[$i]['Admin'] = $temp;
		}
		
		$this->set ( 'companies' , $companies );
	}

}