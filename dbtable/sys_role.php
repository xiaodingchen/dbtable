<?php 
array (
  'columns' => 
  array (
    'role_id' => 
    array (
      'type' => 'int(10) unsigned',
      'autoincrement' => true,
      'notnull' => false,
      'default' => NULL,
      'comment' => '',
    ),
    'role_name' => 
    array (
      'type' => 'varchar(255)',
      'notnull' => false,
      'default' => '',
      'comment' => '角色名',
    ),
    'route_list' => 
    array (
      'type' => 'varchar(255)',
      'notnull' => false,
      'default' => '0',
      'comment' => '路由列表',
    ),
    'creted' => 
    array (
      'type' => 'int(11)',
      'notnull' => false,
      'default' => '0',
      'comment' => '',
    ),
    'updated' => 
    array (
      'type' => 'int(11)',
      'notnull' => false,
      'default' => '0',
      'comment' => '',
    ),
  ),
  'primary' => 'role_id',
  'engine' => 'InnoDB',
  'comment' => '角色表',
) 
;