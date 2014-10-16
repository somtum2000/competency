<?php
App::uses( 'AppController', 'Controller' );

class DepartmentAdminController extends AppController {
  public $layout = 'admin'; 

  public $uses = array( 'Company', 'Department', 'User', 'Project', 'Department' );
	
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->isAdmin();
	}	
	
	public function add( $companyID = null ) {
	
		$companies = $this->Company->getCompanyList();
		$departments = array();
		
		if (isset($companyID)) $departments = $this->Department->getDepartmentInfo($companyID);
		
		if ( $this->request->is('post') ) {
			$data = $this->request->data;
			
			$data['Department']['dept_code'] = $this->generateRandomString(8);
			
			$this->Department->create();

			if ( $this->Department->saveAssociated( $data ) ) {
				$this->Session->setFlash( __('The Department has been created'), 'flashSuccess' );
				unset( $this->request->data['Department']);
			} else {
				$this->Session->setFlash( __( 'The Department could not be created, please contact developer' ), 'flashDanger' );
			}
			
			$departments = $this->Department->getDepartmentInfo($companyID);
		}
		
		$this->set( 'companyID', $companyID );
		$this->set( 'companies', $companies );
		$this->set( 'departments', $departments );
	}

}