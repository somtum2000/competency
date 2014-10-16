<?php
class MC extends AppModel {

	public $useTable = 'mc';
	
	public $primaryKey = 'mc_id';
	
	public $belongTo = array (
		'Project' => array (
			'className' => 'Project',
			'foreignKey' => 'proj_id'
		),
		
		'Company' => array (
			'className' => 'Company',
			'foreignKey' => 'company_id'
		),
	);
	
	
	
	
	
	public $validate = array(
			'mc_name' => array(
					'nonEmpty'				=> array(
							'rule'				=> array('notEmpty'),
							'allowEmpty'	=> false,
							'message'			=> 'A managerial competencies name is required'
					),
			),
			
			'mc_desc_th' => array(
					'nonEmpty'				=> array(
							'rule'				=> array('notEmpty'),
							'allowEmpty'	=> false,
							'message'			=> 'A managerial competencies description is required'
					),
			),
			
			'mc_desc_en' => array(
					'nonEmpty'				=> array(
							'rule'				=> array('notEmpty'),
							'allowEmpty'	=> false,
							'message'			=> 'A managerial competencies description is required'
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
	
	
	
	
	public function getMCInfo( $companyID = null, $projID = null ) {
	
		if ( isset ($companyID, $projID) ) {
			$mc = $this->find( 'all', array(
																		'conditions' => array (
																				'MC.company_id' => $companyID,
																				'MC.proj_id' => $projID,
																		),
																	) );
			return ($mc);
		} else {
			return null;
		}
	}
}
?>