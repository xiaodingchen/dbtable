<?php 
array (
  'columns' => 
  array (
    'afid' => 
    array (
      'type' => 'int(10) unsigned',
      'autoincrement' => true,
      'notnull' => false,
      'default' => NULL,
      'comment' => '自增ID',
    ),
    'aid' => 
    array (
      'type' => 'int(10) unsigned',
      'notnull' => false,
      'default' => NULL,
      'comment' => '文章ID',
    ),
    'description' => 
    array (
      'type' => 'varchar(255)',
      'notnull' => false,
      'default' => '',
      'comment' => '文章摘要',
    ),
    'tags' => 
    array (
      'type' => 'varchar(100)',
      'notnull' => false,
      'default' => '',
      'comment' => '文章标签',
    ),
    'content' => 
    array (
      'type' => 'text',
      'notnull' => false,
      'default' => NULL,
      'comment' => '文章正文内容',
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
  'primary' => 'afid',
  'index' => 
  array (
    'cid' => 
    array (
      0 => 'aid',
    ),
  ),
  'engine' => 'InnoDB',
  'comment' => '博客文章扩展表',
) 
;