<?php
class DataDictionary extends AppModel {

	public $useTable = 'data_dictionary';
	
	public $primaryKey = 'dd_id';
	
	public $belongsTo = array (
		'Department' => array (
			'className' => 'Department',
			'foreignKey' => 'dept_id'
		),
	);
	
	
	public $validate = array(
		'company_id' => array(
				'nonEmpty'				=> array(
						'rule'				=> array('notEmpty'),
						'allowEmpty'	=> false,
						'message'			=> 'Please select company'
				),
		),
		
		'proj_id' => array(
				'nonEmpty'				=> array(
						'rule'				=> array('notEmpty'),
						'allowEmpty'	=> false,
						'message'			=> 'Project is required'
				),
		),
		
		'dept_id' => array(
				'nonEmpty'				=> array(
						'rule'				=> array('notEmpty'),
						'allowEmpty'	=> false,
						'message'			=> 'Department is required'
				),
		),
		
		'dd_name' => array(
				'nonEmpty'				=> array(
						'rule'				=> array('notEmpty'),
						'allowEmpty'	=> false,
						'message'			=> 'Data dictionary name is required'
				),
		),
		
	);
	
	public function getDataDictionaryInfo( $companyID = null, $projID = null, $deptID = null ) {
	
		if ( isset ($companyID, $projID, $deptID) ) {
			$dataDictonary = $this->find( 'all', array( 'conditions' => array (
																												'DataDictionary.company_id' => $companyID,
																												'DataDictionary.proj_id' => $projID,
																												'DataDictionary.dept_id' => $deptID) ,
																									'order' => 'DataDictionary.order_number',
																	) );
			return ($dataDictonary);
		} else {
			return null;
		}
		
	}
}