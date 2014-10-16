<?php
App::uses( 'AppController', 'Controller' );

class AdminController extends AppController
{
  public $layout = 'admin';

	public $uses = array( 'Company', 'User', 'Countries', 'Project' );
	
	
  public function beforeFilter()
  {
    parent::beforeFilter();
    $this->isAdmin();
  }

  public function index() {

  }
	
	public function addUser() {
	
	}

	public function addCompany() {
		$countries = $this->User->Countries->find( 'list', array (
																											'fields' => array( 'country_id', 'name' ),
																											'order'  => array( 'name')
																									) );
																									
		if ( $this->request->is('post') ) {
			$data = $this->request->data;			
			$this->Company->create();
			
			if ( $this->Company->save( $data ) ) {
				$this->Session->setFlash( __('The Company has been created') );
				//$this->redirect( array( 'action' => 'index') );
			} else {
				$this->set( 'errors', array( __( 'The Company could not be created. Please, try again.', true ) ) );
				$this->Session->setFlash( __( 'The Company could not be created. Please, try again.' ) );
			}	
		}
		
		//$this->set( 'errors', $errors );
		$this->set( 'countries', $countries );
	}
	
	public function companyList() {
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
	
	// public function admin() {
		// $companies = $this->Company->find( 'all', array (
																											// 'order'  => array( 'company_name')
																									// ) );

		// for ( $i=0; $i<count($companies); $i++ ) {
			// $temp = $this->Countries->find( 'first', array (
																											// 'conditions' => array (
																												// 'country_id' => $companies[$i]['Company']['country_id']
																											// ),
																									// ) );
																									
			// $companies[$i]['Company']['country_name'] = $temp['Countries']['name'];
			
			
			
			// $temp = $this->User->find( 'all', array (
																					// 'conditions' => array (
																						// 'User.company_id' => $companies[$i]['Company']['company_id'],
																						// 'Group.name' => 'Company Admin'
																					// ),
																					// 'order' => 'first_name'
																			// ) );
																			
																			
			// $companies[$i]['Admin'] = $temp;
		// }
		
		// $this->set ( 'companies', $companies );
	// }

}
?>
