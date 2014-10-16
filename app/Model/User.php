<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
App::uses('CakeEvent', 'CakeEventListener', 'Event');

class User extends AppModel {

	public $useTable = 'users';
	
	public $primaryKey = 'id';
	
  public $belongsTo = array (
		'Company' => array (
			'className' => 'Company',
			'foreignKey' => 'company_id'
		),
			
		'Countries' => array (
			'className' => 'Countries',
			'foreignKey' => 'country_id'
		),

		'Group' => array (
			'className' => 'Group',
			'foreignKey' => 'group_id'
		),
		
		'Department' => array (
			'className' => 'Department',
			'foreignKey' => 'dept_id'
		),
	);
	
	
	
	public $hasMany = array (
		'Evaluate' => array (
			'className' => 'Evaluate',
			'foreignKey' => 'source_id'
		),

		'UserRelations' => array (
			'className' => 'UserRelations',
			'foreignKey' => 'user_id'
		),

		'ProjectUser' => array (
			'className' => 'ProjectUser',
			'foreignKey' => 'user_id'
		),
		
		'Tasks' => array (
			'className' => 'Evaluate',
			'foreignKey' => 'source_id'
		),
		
		'UserLog' => array (
			'className' => 'UserLog',
			'foreignKey' => 'user_id'
		),
	);

	public function getInternalUserList () {
	}
	
	
	public function getUsersList( $lists ) {
		$i = 0;
		$list = array();
		foreach ( $lists AS $myList ) {
			$user = $this->find( 'first', array( 'conditions' => array ( 'id' => $myList ) ) );
			$list[$i] = $user;
			$i++;
		}
		return ($list);
	}
	
	
	public function getAssignedList( $lists ) {
		$i = 0;
		$list = array();
		foreach ( $lists AS $myList) {
			$user = $this->find( 'first', array( 'conditions' => array ( 'id' => $myList ) ) );
			$list[$i] = $user;
			$i++;
		}
		
		return ($list);
	}
	

	
	
	
	public function getUserInfo( $userID ) {
		$user = array();
		$user = $this->find( 'first', array( 'conditions' => array ( 'id' => $userID ) ) );
		return ($user);
	}


	
	public $validate = array(
			'email' => array(
					'nonEmpty'				=> array(
							'rule'				=> array('notEmpty'),
							'allowEmpty'	=> false,
							'message'			=> 'A email is required'
					),
			)
	);
	
	
	// public $validate = array(
			// 'username' => array(
					// 'nonEmpty'				=> array(
							// 'rule'				=> array('notEmpty'),
							// 'allowEmpty'	=> false,
							// 'message'			=> 'A username is required'
					// ),
					
					// 'between' => array( 
							// 'rule'				=> array('between', 6, 15), 
							// 'required'		=> true, 
							// 'message'			=> 'Username must be between 6 to 15 characters'
					// ),
					
					// 'unique' => array(
							// 'rule'				=> array('isUniqueUsername'),
							// 'message'			=> 'This username is already in use'
					// ),
					
					// 'alphaNumericDashUnderscore' => array(
							// 'rule'				=> array('alphaNumericDashUnderscore'),
							// 'message'			=> 'Username can only be letters, numbers and underscores'
					// ),
			// ),
			
			
			// 'first_name' => array(
					// 'alpha' => array(
						// 'rule'      => 'alphaNumeric',
						// 'required'  => true,
						// 'message'   => 'Only letter is allowed'
					// ),
					
					// 'nonEmpty'				=> array(
							// 'rule'				=> array('notEmpty'),
							// 'allowEmpty'	=> false,
							// 'message'			=> 'First name is required'
					// ),
			// ),
			
			// 'last_name' => array(
					// 'alpha' => array(
						// 'rule'      => 'alphaNumeric',
						// 'required'  => true,
						// 'message'   => 'Only letter is allowed'
					// ),
					
					// 'nonEmpty'				=> array(
							// 'rule'				=> array('notEmpty'),
							// 'allowEmpty'	=> false,
							// 'message'			=> 'First name is required'
					// ),
			// ),

			// 'password' => array(
					// 'required' => array(
							// 'rule' => array('notEmpty'),
							// 'message' => 'A password is required'
					// ),
			
					// 'min_length' => array(
							// 'rule' => array('minLength', '6'),  
							// 'message' => 'Password must have a minimum of 6 characters'
					// )
			// ),
		
			// 'email' => array(
					// 'required' => array(
							// 'rule' => array('email', true),    
							// 'message' => 'Please provide a valid email address.'    
					// ),
					// 'unique' => array(
							// 'rule'    => array('isUniqueEmail'),
							// 'message' => 'This email is already in use',
					// ),
					// 'between' => array( 
							// 'rule' => array('between', 6, 60), 
							// 'message' => 'Username must be between 6 to 60 characters'
					// )
			// ),
			
			
			// 'gender' => array(
					// 'valid' => array(
							// 'rule' => array('inList', array( 'Male', 'Female', 'Prefer not to say' )),
							// 'message' => 'Please enter a valid gender',
							// 'allowEmpty' => false
					// )
			// ),
			
			// 'country_id' => array(
					// 'valid' => array(
							// 'message' => 'Please enter a valid country',
							// 'allowEmpty' => false
					// )
			// ),
			
			// 'company_id' => array(
					// 'valid' => array(
							// 'allowEmpty' => false,
							// 'message' => 'Please enter a valid company code'
					// )
			// ),
			
			// 'group_id' => array(
					// 'nonEmpty'				=> array(
							// 'rule'				=> array('notEmpty'),
							// 'allowEmpty'	=> false,
							// 'message'			=> 'Please select user group'
					// )
			// ),
			
	// );
	

	function isUniqueUsername($check) {
		$username = $this->find(
			'first',
			array(
				'fields' => array(
					'User.id',
					'User.username'
				),
				'conditions' => array(
					'User.username' => $check['username']
				)
			)
		);

		if( !empty($username) ) {
			if ( $this->data[$this->alias]['username'] == $username['User']['username'] ) {
				return true; 
			} else {
				return false; 
			}
		} else {
			return true; 
		}
	}


	function isUniqueEmail($check) {

		$email = $this->find(
			'first',
			array(
				'fields' => array(
					'User.id',
					'User.email',
				),
				'conditions' => array(
					'User.email' => $check['email']
				)
			)
		);

		if(!empty($email)){
			if($this->data[$this->alias]['email'] == $email['User']['email']){
				return true; 
			}else{
				return false; 
			}
		}else{
			return true; 
		}
    }
	
	public function alphaNumericDashUnderscore($check) {
			// $data array is passed using the form field name as the key
			// have to extract the value to make the function generic
			$value = array_values($check);
			$value = $value[0];

			return preg_match('/^[a-zA-Z0-9_ \-]*$/', $value);
	}
	
	public function equaltofield($check,$otherfield) { 
			//get name of field 
			$fname = ''; 
			foreach ($check as $key => $value){ 
					$fname = $key; 
					break; 
			} 
			return $this->data[$this->name][$otherfield] === $this->data[$this->name][$fname]; 
	}


	 public function beforeSave($options = array()) {
		// hash our password
		if (isset($this->data[$this->alias]['password'])) {
			$passwordHasher = new BlowfishPasswordHasher();
			$this->data[$this->alias]['password'] = $passwordHasher->hash($this->data[$this->alias]['password']);
		}
		return true;
	}
	
	// public function afterSave() {
		// $event = new CakeEvent('Model.User.add', $this, array ( 'order' => $id ) );
		
		// if ( $created ) {
			// $this->getEventManager()->dispatch($event);
			// return true;
		// }
	// }

}

?>