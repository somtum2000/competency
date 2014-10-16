<?php
App::uses('AppModel', 'Model');

class User extends AppModel {
	public $useTable = 'system_setting';
	
	public $primaryKey = 'setting_id';
}