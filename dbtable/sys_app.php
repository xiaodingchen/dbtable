<?php 
array (
  'columns' => 
  array (
    'app_id' => 
    array (
      'type' => 'int(10) unsigned',
      'autoincrement' => true,
      'notnull' => false,
      'default' => NULL,
      'comment' => '应用自增id',
    ),
    'app_identifier' => 
    array (
      'type' => 'varchar(60)',
      'notnull' => false,
      'default' => '',
      'comment' => '应用唯一标示，英文',
    ),
    'app_name' => 
    array (
      'type' => 'varchar(60)',
      'notnull' => false,
      'default' => '',
      'comment' => '应用名',
    ),
    'app_dir' => 
    array (
      'type' => 'varchar(60)',
      'notnull' => false,
      'default' => '',
      'comment' => '应用目录',
    ),
    'app_url' => 
    array (
      'type' => 'varchar(255)',
      'notnull' => false,
      'default' => '',
      'comment' => '应用默认地址',
    ),
    'app_icon' => 
    array (
      'type' => 'varchar(255)',
      'notnull' => false,
      'default' => '',
      'comment' => '应用图标',
    ),
    'app_status' => 
    array (
      'type' => 'tinyint(4)',
      'notnull' => false,
      'default' => '1',
      'comment' => '应用状态，1代表激活状态，-1代表禁用状态',
    ),
    'creted' => 
    array (
      'type' => 'int(11)',
      'notnull' => false,
      'default' => NULL,
      'comment' => '应用创建时间',
    ),
    'updated' => 
    array (
      'type' => 'int(11)',
      'notnull' => false,
      'default' => NULL,
      'comment' => '',
    ),
  ),
  'primary' => 'app_id',
  'unique' => 
  array (
    'app_unionid' => 
    array (
      0 => 'app_identifier',
    ),
  ),
  'index' => 
  array (
    'app_status' => 
    array (
      0 => 'app_status',
    ),
  ),
  'engine' => 'InnoDB',
  'comment' => '应用管理表',
) 
;