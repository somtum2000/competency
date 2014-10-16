<?php
class CC extends AppModel {

	public $useTable = 'cc';
	
	public $primaryKey = 'cc_id';
	
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
			'cc_name' => array(
					'nonEmpty'				=> array(
							'rule'				=> array('notEmpty'),
							'allowEmpty'	=> false,
							'message'			=> 'A core competency name is required'
					),
			),
			
			'cc_desc_th' => array(
					'nonEmpty'				=> array(
							'rule'				=> array('notEmpty'),
							'allowEmpty'	=> false,
							'message'			=> 'A core competency description is required'
					),
			),
			
			'cc_desc_en' => array(
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
	
	
	
	
	public function getCCInfo( $companyID = null, $projID = null ) {
	
		if ( isset ($companyID, $projID) ) {
			$cc = $this->find( 'all', array(
																		'conditions' => array (
																				'CC.company_id' => $companyID,
																				'CC.proj_id' => $projID,
																		),
																	) );
			return ($cc);
		} else {
			return null;
		}
	}
}
?>