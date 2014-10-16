<?php
App::uses( 'AppController', 'Controller' ); 

class ProjectManageUserAdminController extends AppController
{
  public $layout = 'admin';

  public $uses = array( 'ProjectManageUser', 'Project', 'Company', 'User', 'Countries' );


	public function beforeFilter() {
		parent::beforeFilter();
	}	
	
	public function add( $companyID = null, $projID = null ) {
		$projects = array();
		
		if ( isset($companyID) ) $projects = $this->Project->getProjectList($companyID);
		
		$companies = $this->Company->find( 'list', array (
																									'fields' => array( 'company_id', 'company_name' ),
																									'order'  => array( 'company_name')
																			) );

		$users = $this->Company->find( 'list', array (
																									'fields' => array( 'company_id', 'company_name' ),
																									'order'  => array( 'company_name')
																			) );
																			
																			
																			
		if ( $this->request->is('post') ) {
			$data = $this->request->data;
			$this->ProjectManageUser->create();
			
			if ( $this->ProjectManageUser->save( $data ) ) {
				$this->Session->setFlash( __('The Project has been created') );
			} else {
				$this->set( 'errors', array( __( 'The Project could not be created. Please, try again.', true ) ) );
			}	
		}
									
		$this->set( 'companyID', $companyID );
		
		$this->set( 'projID', $projID );
		$this->set( 'projects', $projects );
		
		$this->set( 'companies', $companies );
	}
}