<?php
App::uses( 'AppController', 'Controller' );

class EvaluateAdminController extends AppController {
  public $layout = 'admin'; 

  public $uses = array( 'Company', 'Department', 'User', 'Project', 'Department' );
	
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->isAdmin();
	}
	
	
}