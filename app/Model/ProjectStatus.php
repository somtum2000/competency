<?php
App::uses( 'AppModel', 'Model' );

class ProjectStatus extends AppModel {

	public $useTable = 'project_status';
	
	public $primaryKey = 'status_id';
}
?>