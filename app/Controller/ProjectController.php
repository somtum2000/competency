<?php
App::uses( 'AppController', 'Controller' ); 

class ProjectController extends AppController
{
  public $layout = 'default';

  public $uses = array( 'Project', 'Company', 'User', 'Countries' );


	public function beforeFilter() {
		parent::beforeFilter();
	}	
	
	public function add() {
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
	
	public function showProject() {
		$this->Company->Project->contain();
		$projects = $this->Project->find( 'all', array (
																				'conditions' => array (
																					
																				)
																								//'order'  => array( 'proj_name')
																		) );
																		
		
		debug ($projects);
																									
		// $company = $this->Company->find( 'first', array (
																					// 'conditions' => array (
																						// 'Company.company_id' => $companyID
																					// ),
																					// 'order'  => array( 'Company.company_name')
																		// ) );
	
		$this->set( 'projects', $projects );
	}

}