<?php 
array (
  'columns' => 
  array (
    'arid' => 
    array (
      'type' => 'int(10) unsigned',
      'autoincrement' => true,
      'notnull' => false,
      'default' => NULL,
      'comment' => '文章阅读自增ID',
    ),
    'aid' => 
    array (
      'type' => 'int(10) unsigned',
      'notnull' => false,
      'default' => NULL,
      'comment' => '文章ID,来自文章表',
    ),
    'fromip' => 
    array (
      'type' => 'char(15)',
      'notnull' => false,
      'default' => '0.0.0.0',
      'comment' => '来源IP',
    ),
    'readtime' => 
    array (
      'type' => 'int(10) unsigned',
      'notnull' => false,
      'default' => '0',
      'comment' => '阅读时间',
    ),
    'created' => 
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
  'primary' => 'arid',
  'index' => 
  array (
    'aid' => 
    array (
      0 => 'aid',
    ),
    'read_index' => 
    array (
      0 => 'aid',
      1 => 'fromip',
    ),
  ),
  'engine' => 'InnoDB',
  'comment' => '博客文章阅读表',
) 
;