<?php
class Position extends AppModel {

	public $useTable = 'position';
	
	public $primaryKey = 'position_id';
	
	public $hasMany = array (
		'FC' => array (
			'className' => 'FC',
			'foreignKey' => 'position_id'
		),
		
		'User' => array (
			'className' => 'User',
			'foreignKey' => 'position_id'
		),
	);
	
	public $belongTo = array (
		'Company' => array (
			'className' => 'Company',
			'foreignKey' => 'company_id'
		),
		
		'Department' => array (
			'className' => 'Department',
			'foreignKey' => 'dept_id'
		),
	);
	
	
	public $hasOne = array (
		'Department' => array (
			'className' => 'Department',
			'foreignKey' => false,
			'conditions' => 'Position.dept_id = Department.dept_id',
		),

	);	
	
	
	
	public $validate = array(
			'company_id' => array(
					'nonEmpty'				=> array(
							'rule'				=> array('notEmpty'),
							'allowEmpty'	=> false,
							'message'			=> 'Company name is required'
					),
			),
			
			'dept_id' => array(
					'nonEmpty'				=> array(
							'rule'				=> array('notEmpty'),
							'allowEmpty'	=> false,
							'message'			=> 'Department name is required'
					),
			),
			
			'position_name' => array(
					'nonEmpty'				=> array(
							'rule'				=> array('notEmpty'),
							'allowEmpty'	=> false,
							'message'			=> 'Please enter position name'
					),
			),
	);
	
	
	public function getPositionInfo( $companyID = null, $deptID = null ) {
	
		if ( isset ($companyID, $projID, $deptID) ) {
			$positions = $this->find( 'all', array(
																		'conditions' => array (
																				'Position.company_id' => $companyID,
																				'Position.dept_id' => $deptID,
																		),
																	) );
			return ($positions);
		} else {
			return null;
		}
	}
	
}
?>