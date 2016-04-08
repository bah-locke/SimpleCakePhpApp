<?php

class Group extends AppModel {
	public $name = 'Group';
	public $useTable = 'groups';
	
	public $hasMany	= array(
		'GroupPermission' => array(
			'className' => 'GroupPermission',
			'foreignKey' => 'groupId'
		)
	);
}
?>