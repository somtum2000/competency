<?php
App::uses( 'AppController', 'Controller' ); 

class MCAdminController extends AppController {

  public $layout = 'admin';

  public $uses = array(
		'Company',
		'Project',
		'MC',
	);


	public function beforeFilter() {
		parent::beforeFilter();
		$this->isAdmin();
	}
	
	
	
	
	
	public function add ( $companyID = null, $projID = null ) {
		$companies = array();
		$projects = array();
		$mc_list = array();
		$csrExpect = null;
		
	
		$companies = $this->Company->getCompanyList();
		
		if (isset($companyID)) {
			$projects = $this->Project->getProjectList ($companyID);
		}
		
		if ( isset ( $companyID, $projID ) ) {
			$mc_list = $this->MC->getMCInfo ($companyID, $projID);
		}
		
		
		if ( $this->request->is('post') ) {
			$data = $this->request->data;			
			$this->MC->create();
						
			if ( $this->MC->save( $data ) ) {
				$this->Session->setFlash( __('Data Dictionary saved'), 'flashSuccess' );
				unset( $this->request->data['MC']);
			} else {
				$this->Session->setFlash( __('Save error'), 'flashDanger' );
			}
			
			if ( isset ($companyID, $projID) ) {
				$mc_list = $this->MC->getMCInfo ($companyID, $projID);
			}
		}


		$this->set ( 'companyID', $companyID );
		$this->set ( 'companies', $companies );
		
		$this->set ( 'projID', $projID );
		$this->set ( 'projects', $projects );

		$this->set ( 'mc_list', $mc_list );
		$this->set ( 'csrExpect', $csrExpect );
	}

}