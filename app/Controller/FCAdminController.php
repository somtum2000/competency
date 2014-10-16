<?php
App::uses( 'AppController', 'Controller' ); 

class FCAdminController extends AppController {

  public $layout = 'admin';

  public $uses = array(
		'Company',
		'Project',
		'FC',
	);


	public function beforeFilter() {
		parent::beforeFilter();
		$this->isAdmin();
	}
	
	
	
	
	
	public function add ( $companyID = null, $projID = null, $positionID = null ) {
		$companies = array();
		$projects = array();
		$fc_list = array();
		$csrExpect = null;
	
		$companies = $this->Company->getCompanyList();
		
		if (isset($companyID)) {
			$projects = $this->Project->getProjectList ($companyID);
		}
		
		if ( isset ( $companyID, $projID ) ) {
			$fc_list = $this->FC->getFCInfo ($companyID, $projID);
		}
		
		
		if ( $this->request->is('post') ) {
			$data = $this->request->data;			
			$this->FC->create();
						
			if ( $this->FC->save( $data ) ) {
				$this->Session->setFlash( __('Data Dictionary saved'), 'flashSuccess' );
				unset( $this->request->data['FC']);
			} else {
				$this->Session->setFlash( __('Save error'), 'flashDanger' );
			}
			
			if ( isset ($companyID, $projID) ) {
				$fc_list = $this->FC->getFCInfo ($companyID, $projID, $positionID);
			}
		}


		$this->set ( 'companyID', $companyID );
		$this->set ( 'companies', $companies );
		
		$this->set ( 'projID', $projID );
		$this->set ( 'projects', $projects );
		
		$this->set ( 'fc_list', $fc_list );
		$this->set ( 'csrExpect', $csrExpect );
	}

}