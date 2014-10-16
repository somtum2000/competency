<?php
App::uses( 'AppController', 'Controller' );

class DataDictAdminController extends AppController {
  public $layout = 'admin'; 

  public $uses = array( 'Company', 'Project', 'Department', 'DataDictionary', 'User', 'Project', 'Department' );
	
	public $components = array( 'RequestHandler' );
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->isAdmin();
	}
	
	
	
	public function add ( $companyID = null, $projID = null, $deptID = null ) {
		$companies = array();
		$projects = array();
		$departments = array();
		$dataDicts = array();
	
		$companies = $this->Company->getCompanyList();
		
		if (isset($companyID)) {
			$projects = $this->Project->getProjectList ($companyID);
			$departments = $this->Department->getDepartmentList ($companyID);
		}
		
		if ( isset ($companyID, $projID, $deptID) ) {
			$dataDicts = $this->DataDictionary->getDataDictionaryInfo ($companyID, $projID, $deptID);
		}
		
		
		if ( $this->request->is('post') ) {
			$data = $this->request->data;			
			$this->DataDictionary->create();
						
			if ( $this->DataDictionary->save( $data ) ) {
				$this->Session->setFlash( __('Data Dictionary saved'), 'flashSuccess' );
				unset( $this->request->data['DataDictionary']);
			} else {
				$this->Session->setFlash( __('Save error'), 'flashDanger' );
			}
			
			if ( isset ($companyID, $projID, $deptID) ) {
				$dataDicts = $this->DataDictionary->getDataDictionaryInfo ($companyID, $projID, $deptID);
			}
		}


		$this->set ( 'companyID', $companyID );
		$this->set ( 'companies', $companies );
		
		$this->set ( 'projID', $projID );
		$this->set ( 'projects', $projects );
		
		$this->set ( 'deptID', $deptID );
		$this->set ( 'departments', $departments );
		
		$this->set ( 'dataDicts', $dataDicts );
	}
}