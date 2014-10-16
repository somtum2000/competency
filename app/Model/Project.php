<?php
App::uses( 'AppModel', 'Model' );

class Project extends AppModel {

	public $useTable = 'projects';
	
	public $primaryKey = 'proj_id';

	public $belongTo = array (
		'Company' => array (
			'className' => 'Company',
			'foreignKey' => 'company_id'
		),
	);
	
	public $hasMany = array (
		'ProjectUser' => array (
			'className' => 'ProjectUser',
			'foreignKey' => 'proj_id'
		),
		
		'CC' => array (
			'className' => 'CC',
			'foreignKey' => 'proj_id'
		),
		'MC' => array (
			'className' => 'MC',
			'foreignKey' => 'proj_id'
		),
	);

	public $hasOne = array (
		'ProjectStatus' => array (
			'className' => 'ProjectStatus',
			'foreignKey' => false,
			'conditions' => 'Project.proj_status = ProjectStatus.status_id',
		),

		'ProjectManager' => array (
			'className' => 'User',
			'foreignKey' => false,
			'conditions' => 'Project.proj_manager = ProjectManager.id',
		),
		
		'Company' => array (
			'className' => 'Company',
			'foreignKey' => false,
			'conditions' => 'Project.company_id = Company.company_id',
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
		
		'proj_name' => array(
				'nonEmpty'				=> array(
						'rule'				=> array('notEmpty'),
						'allowEmpty'	=> false,
						'message'			=> 'Project name is required'
				),
		),
		
		'proj_manager' => array(
				'nonEmpty'				=> array(
						'rule'				=> array('notEmpty'),
						'allowEmpty'	=> false,
						'message'			=> 'Project manager is required'
				),
		),
	);
	
	
	public function getProjectList ( $companyID ) {
		$company = null;
		if ( isset( $companyID ) ) {
			$projects = $this->find( 'list', array (
																								'conditions' => array ( 'Project.company_id' => $companyID ),
																								'fields' => array( 'proj_id', 'proj_name' ),
															) );
			return $projects;
		} else {
			return null;
		}
	}
}