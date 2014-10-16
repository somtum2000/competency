<?php
App::uses( 'AppModel', 'Model' );

class ProjectManageUser extends AppModel {

	public $useTable = 'project_manage_users';
	
	public $primaryKey = 'manage_id';

	public $belongTo = array (
		'Project' => array (
			'className' => 'Project',
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
}