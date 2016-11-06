<?php 
array (
  'columns' => 
  array (
    's_key' => 
    array (
      'type' => 'varchar(255)',
      'notnull' => false,
      'default' => '',
      'comment' => '变量命',
    ),
    's_value' => 
    array (
      'type' => 'text',
      'notnull' => false,
      'default' => NULL,
      'comment' => '变量值',
    ),
    's_type' => 
    array (
      'type' => 'tinyint(1) unsigned',
      'notnull' => false,
      'default' => '0',
      'comment' => '缓存类型, 0:非数组, 1:数组',
    ),
    's_comment' => 
    array (
      'type' => 'text',
      'notnull' => false,
      'default' => NULL,
      'comment' => '说明',
    ),
    'creted' => 
    array (
      'type' => 'int(10) unsigned',
      'notnull' => false,
      'default' => NULL,
      'comment' => '',
    ),
    'updated' => 
    array (
      'type' => 'int(10) unsigned',
      'notnull' => false,
      'default' => '0',
      'comment' => '更新时间',
    ),
  ),
  'primary' => 's_key',
  'engine' => 'InnoDB',
  'comment' => '博客设置表',
) 
;