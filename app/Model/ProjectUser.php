<?php
App::uses( 'AppModel', 'Model' );

class ProjectUser extends AppModel {

	public $useTable = 'project_user';
	
	public $primaryKey = 'proj_list_id';	

	public $belongTo = array (
		'Project' => array (
			'className' => 'Project',
			'forignKey' => 'proj_id'
		),

		'User' => array (
			'className' => 'User',
			'forignKey' => 'user_id'
		),
	);
	
	
	public $validate = array(
		// 'company_id' => array(
				// 'nonEmpty'				=> array(
						// 'rule'				=> array('notEmpty'),
						// 'allowEmpty'	=> false,
						// 'message'			=> 'Please select company'
				// ),
		// ),
		
		// 'proj_name' => array(
				// 'nonEmpty'				=> array(
						// 'rule'				=> array('notEmpty'),
						// 'allowEmpty'	=> false,
						// 'message'			=> 'Project name is required'
				// ),
		// ),
	);
}