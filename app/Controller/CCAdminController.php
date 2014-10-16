<?php
App::uses( 'AppController', 'Controller' ); 

class CCAdminController extends AppController {

  public $layout = 'admin';

  public $uses = array(
		'Company',
		'Project',
		'CC',
	);


	public function beforeFilter() {
		parent::beforeFilter();
		$this->isAdmin();
	}
	
	
	
	
	
	public function add ( $companyID = null, $projID = null ) {
		$companies = array();
		$projects = array();
		$cc_list = array();
		$csrExpect = null;
	
		$companies = $this->Company->getCompanyList();
		
		if (isset($companyID)) {
			$projects = $this->Project->getProjectList ($companyID);
		}
		
		if ( isset ( $companyID, $projID ) ) {
			$cc_list = $this->CC->getCCInfo ($companyID, $projID);
		}
		
		
		if ( $this->request->is('post') ) {
			$data = $this->request->data;			
			$this->CC->create();
						
			if ( $this->CC->save( $data ) ) {
				$this->Session->setFlash( __('Data Dictionary saved'), 'flashSuccess' );
				unset( $this->request->data['CC']);
			} else {
				$this->Session->setFlash( __('Save error'), 'flashDanger' );
			}
			
			if ( isset ($companyID, $projID) ) {
				$cc_list = $this->CC->getCCInfo ($companyID, $projID);
			}
		}


		$this->set ( 'companyID', $companyID );
		$this->set ( 'companies', $companies );
		
		$this->set ( 'projID', $projID );
		$this->set ( 'projects', $projects );
		
		$this->set ( 'cc_list', $cc_list );
		$this->set ( 'csrExpect', $csrExpect );
	}

}