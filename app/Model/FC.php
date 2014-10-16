<?php
class FC extends AppModel {

	public $useTable = 'fc';
	
	public $primaryKey = 'fc_id';
	
	public $belongTo = array (
		'Project' => array (
			'className' => 'Project',
			'foreignKey' => 'proj_id'
		),
		
		'Company' => array (
			'className' => 'Company',
			'foreignKey' => 'company_id'
		),
		
		'Position' => array (
			'className' => 'Position',
			'foreignKey' => 'position_id'
		),
	);
	
	
	
	
	public $validate = array(
			'fc_name' => array(
					'nonEmpty'				=> array(
							'rule'				=> array('notEmpty'),
							'allowEmpty'	=> false,
							'message'			=> 'A core competency name is required'
					),
			),
			
			'fc_desc_th' => array(
					'nonEmpty'				=> array(
							'rule'				=> array('notEmpty'),
							'allowEmpty'	=> false,
							'message'			=> 'A core competency description is required'
					),
			),
			
			'fc_desc_en' => array(
					'nonEmpty'				=> array(
							'rule'				=> array('notEmpty'),
							'allowEmpty'	=> false,
							'message'			=> 'A core competency description is required'
					),
			),
			
			'csr_expect' => array(
					'nonEmpty'				=> array(
							'rule'				=> array('notEmpty'),
							'allowEmpty'	=> false,
							'message'			=> 'Expect value is required'
					),
			),
	);
	
	
	
	
	public function getFCInfo( $companyID = null, $projID = null, $positionID ) {
	
		if ( isset ($companyID, $projID, $positionID) ) {
			$fc = $this->find( 'all', array(
																		'conditions' => array (
																				'FC.company_id' => $companyID,
																				'FC.proj_id' => $projID,
																				'FC.position_id' => $positionID,
																		),
																	) );
			return ($fc);
		} else {
			return null;
		}
	}
}
?>