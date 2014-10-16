<?php
App::uses( 'AppController', 'Controller' ); 

class CompanyController extends AppController
{
  public $layout = 'default';

  public $uses = array( 'Company', 'User', 'Countries', 'Project' );
	
		
	public function beforeFilter() {
		parent::beforeFilter();
	}	
	
	public function add() {
		$countries = $this->User->Countries->find( 'list', array (
																											'fields' => array( 'country_id', 'name' ),
																											'order'  => array( 'name')
																									) );
																									
		if ( $this->request->is('post') ) {
			$data = $this->request->data;			
			$this->Company->create();
			
			if ( $this->Company->saveAssociated( $data ) ) {
				$this->Session->setFlash( __('The Company has been created'), 'flashSuccess' );
				//$this->redirect( array( 'action' => 'index') );
			} else {
				$this->Session->setFlash( __( 'The Company could not be created. Please, try again.' ), 'flashDanger' );
			}	
		}
	
		$this->set( 'countries', $countries );
	}
	
	
	
	public function edit( $companyID=null ) {
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
	}
	
	
	
	public function viewCompany( $companyID ) {
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
	}
	
	
	public function addProject() {
		$companies = $this->Company->find( 'list', array (
																									'fields' => array( 'company_id', 'company_name' ),
																									'order'  => array( 'company_name')
																			) );

		if ( $this->request->is('post') ) {
			$data = $this->request->data;			
			$this->Project->create();
			
			if ( $this->Project->save( $data ) ) {
				$this->Session->setFlash( __('The Project has been created') );
			} else {
				$this->set( 'errors', array( __( 'The Project could not be created. Please, try again.', true ) ) );
			}	
		}
																			
		$this->set( 'companies', $companies );
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