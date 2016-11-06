<?php 
array (
  'columns' => 
  array (
    'rid' => 
    array (
      'type' => 'int(10) unsigned',
      'autoincrement' => true,
      'notnull' => false,
      'default' => NULL,
      'comment' => '',
    ),
    'routename' => 
    array (
      'type' => 'varchar(255)',
      'notnull' => false,
      'default' => '',
      'comment' => '路由名称',
    ),
    'module' => 
    array (
      'type' => 'varchar(60)',
      'notnull' => false,
      'default' => '',
      'comment' => '模块名',
    ),
    'ctl' => 
    array (
      'type' => 'varchar(255)',
      'notnull' => false,
      'default' => '',
      'comment' => '控制器',
    ),
    'method' => 
    array (
      'type' => 'varchar(60)',
      'notnull' => false,
      'default' => '',
      'comment' => '方法名',
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
  'primary' => 'rid',
  'engine' => 'InnoDB',
  'comment' => '后台管理路由表',
) 
;