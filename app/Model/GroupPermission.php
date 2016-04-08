<?php

class GroupPermission extends AppModel {
	public $name = 'GroupPermission';
	public $useTable = 'groupPermissions';
	
	public $belongsTo = array(
		'Permission' => array(
			'className' => 'Permission',
			'foreignKey' => 'permissionId'
		),
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'groupId'
		)
	);
}

?>