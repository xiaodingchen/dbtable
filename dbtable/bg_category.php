<?php 
array (
  'columns' => 
  array (
    'cid' => 
    array (
      'type' => 'int(10) unsigned',
      'autoincrement' => true,
      'notnull' => false,
      'default' => NULL,
      'comment' => '自增ID',
    ),
    'pid' => 
    array (
      'type' => 'int(10) unsigned',
      'notnull' => false,
      'default' => '0',
      'comment' => '父级ID',
    ),
    'cname' => 
    array (
      'type' => 'varchar(100)',
      'notnull' => false,
      'default' => '',
      'comment' => '分类名称',
    ),
    'sort' => 
    array (
      'type' => 'smallint(6)',
      'notnull' => false,
      'default' => '0',
      'comment' => '',
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
      'default' => '0',
      'comment' => '更新时间',
    ),
  ),
  'primary' => 'cid',
  'engine' => 'InnoDB',
  'comment' => '博客分类表',
) 
;