<?php

class UserGroup extends AppModel {
	public $name = 'UserGroup';
	public $useTable = 'userGroups';
	
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'userId'
		),
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'groupId'
		)
	);
}

?>