<?php

class User extends AppModel {
	public $name = 'User';
	public $useTable = 'users';
	
	public $hasMany	= array(
		'UserGroup' => array(
			'className' => 'UserGroup',
			'foreignKey' => 'userId'
		)
	);
}

?>