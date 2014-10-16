<?php
App::uses( 'AppModel', 'Model' );

class ProjectUserGroup extends AppModel {

	public $useTable = 'project_user_groups';
	
	public $primaryKey = 'group_id';

	public $belongTo = array (
		'ProjectManageUser' => array (
			'className' => 'ProjectManageUser',
			'foreignKey' => 'role'
		),
	);
}