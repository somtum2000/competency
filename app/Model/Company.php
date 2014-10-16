<?php
App::uses( 'AppModel', 'Model' );

class Company extends AppModel {

	public $useTable = 'company';
	
	public $primaryKey = 'company_id';	
	
	public $hasMany = array (
		'User' => array (
			'className' => 'User',
			'foreignKey' => 'company_id'
		),
		
		'Department' => array (
			'className' => 'Department',
			'foreignKey' => 'company_id'
		),
		
		'Countries' => array (
			'className' => 'Countries',
			'foreignKey' => 'country_id'
		),
		
		'Project' => array (
			'className' => 'Project',
			'foreignKey' => 'company_id'
		),

	);		
	
	public $validate = array(
			'company_name' => array(
					'nonEmpty'				=> array(
							'rule'				=> array('notEmpty'),
							'allowEmpty'	=> false,
							'message'			=> 'A Company name is required'
					),
			),
	);
	
	
	
	public function getCompanyInfo( $companyID ) {
		$company = array();
		$company = $this->find( 'first', array( 'conditions' => array ( 'company_id' => $companyID ) ) );
		return ($company);
	}
	
	
	public function getCompanyList() {
		$companies = $this->find( 'list', array (
																							'fields' => array( 'company_id', 'company_name' ),
																							'order'  => array( 'company_name')
																	) );

		return $companies;
	}
	
	
	
	public function getCompanyCountryID( $companyID ) {
		
		$company = null;
		if ( isset( $companyID ) ) {
			$company = $this->find( 'first', array (
																								'conditions' => array ( 'Company.company_id' => $companyID ),
																								'fields' => array( 'Company.country_id' ),
															) );
		}

		return $company[ 'Company' ]['country_id'];
	}
	
}