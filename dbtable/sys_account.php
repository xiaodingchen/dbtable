<?php 
array (
  'columns' => 
  array (
    'id' => 
    array (
      'type' => 'int(10) unsigned',
      'autoincrement' => true,
      'notnull' => false,
      'default' => NULL,
      'comment' => '主键自增',
    ),
    'accout_name' => 
    array (
      'type' => 'varchar(150)',
      'notnull' => false,
      'default' => '',
      'comment' => '用户名',
    ),
    'account_pwd' => 
    array (
      'type' => 'varchar(32)',
      'notnull' => false,
      'default' => '',
      'comment' => '用户密码',
    ),
    'login_ip' => 
    array (
      'type' => 'char(15)',
      'notnull' => false,
      'default' => '',
      'comment' => '最后一次登录ip',
    ),
    'last_time' => 
    array (
      'type' => 'int(10) unsigned',
      'notnull' => false,
      'default' => '0',
      'comment' => '最后一次登录时间',
    ),
    'role_id' => 
    array (
      'type' => 'int(10) unsigned',
      'notnull' => false,
      'default' => '0',
      'comment' => '角色id',
    ),
    'created' => 
    array (
      'type' => 'int(10) unsigned',
      'notnull' => false,
      'default' => '0',
      'comment' => '创建时间',
    ),
    'updated' => 
    array (
      'type' => 'int(10) unsigned',
      'notnull' => false,
      'default' => NULL,
      'comment' => '',
    ),
  ),
  'primary' => 'id',
  'unique' => 
  array (
    'accout_name' => 
    array (
      0 => 'accout_name',
    ),
  ),
  'index' => 
  array (
    'role_id' => 
    array (
      0 => 'role_id',
    ),
  ),
  'engine' => 'InnoDB',
  'comment' => 'admin管理表',
) 
;