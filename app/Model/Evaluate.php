<?php
class Evaluate extends AppModel {

	public $useTable = 'evaluate';
	
	public $primaryKey = 'eval_id';	
	
	public $belongTo = array (
		'User' => array (
			'className' => 'User',
			'foreignKey' => 'source_id'
		),
	);
	
	public $hasOne = array (
		'SourceUser' => array (
			'className' => 'User',
			'foreignKey' => false,
			'conditions' => 'Evaluate.source_id = SourceUser.id',
		),
		'TargetUser' => array (
			'className' => 'User',
			'foreignKey' => false,
			'conditions' => 'Evaluate.target_id = TargetUser.id',
		),
	);	
}