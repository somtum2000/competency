<?php
class Department extends AppModel {

	public $useTable = 'department';
	
	public $primaryKey = 'dept_id';
	
	public $hasMany = array (
		'User' => array (
			'className' => 'User',
			'foreignKey' => 'dept_id'
		),
		
		'Position' => array (
			'className' => 'Position',
			'foreignKey' => 'dept_id'
		),
	);
	
	
	
	public $belongsTo = array (
		'Company' => array (
			'className' => 'Company',
			'foreignKey' => 'company_id'
		),
	);
	
	
	
	
	public $validate = array(
			'company_id' => array(
					'nonEmpty'				=> array(
							'rule'				=> array('notEmpty'),
							'allowEmpty'	=> false,
							'message'			=> 'A Company ID is required'
					),
			),
			
			
			'dept_name' => array(
					'nonEmpty'				=> array(
							'rule'				=> array('notEmpty'),
							'allowEmpty'	=> false,
							'message'			=> 'A department name is required'
					),
			),
	);
	
	
	
	
	public function getDepartmentInfo( $companyID ) {
	
		$departments = array();
		if ( isset($companyID) ) {
			$departments = $this->find( 'all', array (
																							'conditions' => array ( 'Department.company_id' => $companyID ),
																							'order'  => array( 'dept_name')
																	) );
		}
		
		return $departments;
	}

	
	
	public function getDepartmentList( $companyID ) {
	
		$departments = array();
		if ( isset($companyID) ) {
			$departments = $this->find( 'list', array (
																							'fields' => array ( 'dept_id', 'dept_name' ),
																							'conditions' => array ( 'Department.company_id' => $companyID ),
																							'order'  => array( 'dept_name' )
																	) );
		}
		
		
		return $departments;
	}
	
	
}