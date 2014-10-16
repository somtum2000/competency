<?php
App::uses( 'AppController', 'Controller' ); 

class PositionAdminController extends AppController {

  public $layout = 'admin';

  public $uses = array(
		'Company',
		'Department',
		'Project',
		'Position',
	);


	public function beforeFilter() {
		parent::beforeFilter();
		$this->isAdmin();
	}
	
	
	
	
	public function add ( $companyID = null, $projID = null, $deptID = null ) {
		$companies = array();
		$projects = array();
		$departments = array();
		$positions = array();
	
		$companies = $this->Company->getCompanyList();
		
		if ( isset($companyID) ) {
			$projects = $this->Project->getProjectList ($companyID);
			$departments = $this->Department->getDepartmentList ($companyID);
		}
		
		if ( isset ( $companyID, $projID, $deptID ) ) {
			$positions = $this->Position->getPositionInfo ($companyID, $projID, $deptID);
		}
		
		
		if ( $this->request->is('post') ) {
			$data = $this->request->data;			
			$this->Position->create();
						
			if ( $this->Position->save( $data ) ) {
				$this->Session->setFlash( __('Position saved'), 'flashSuccess' );
				unset( $this->request->data['Position']);
			} else {
				$this->Session->setFlash( __('Save error'), 'flashDanger' );
			}
			
			if ( isset ( $companyID, $projID, $deptID ) ) {
				$positions = $this->Position->getPositionInfo ($companyID, $projID, $deptID);
			}
		}


		$this->set ( 'companyID', $companyID );
		$this->set ( 'companies', $companies );
		
		$this->set ( 'projID', $projID );
		$this->set ( 'projects', $projects );
		
		$this->set ( 'deptID', $deptID );
		$this->set ( 'departments', $departments );
		
		$this->set ( 'positions', $positions );
	}

}