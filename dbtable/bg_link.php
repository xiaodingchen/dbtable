<?php 
array (
  'columns' => 
  array (
    'lid' => 
    array (
      'type' => 'int(10) unsigned',
      'autoincrement' => true,
      'notnull' => false,
      'default' => NULL,
      'comment' => '自增ID',
    ),
    'lsort' => 
    array (
      'type' => 'int(10) unsigned',
      'notnull' => false,
      'default' => '0',
      'comment' => '自定义排序',
    ),
    'linkname' => 
    array (
      'type' => 'varchar(200)',
      'notnull' => false,
      'default' => '',
      'comment' => '链接名称',
    ),
    'companyname' => 
    array (
      'type' => 'varchar(200)',
      'notnull' => false,
      'default' => '',
      'comment' => '企业名称',
    ),
    'linkurl' => 
    array (
      'type' => 'varchar(255)',
      'notnull' => false,
      'default' => '',
      'comment' => '链接地址',
    ),
    'atid' => 
    array (
      'type' => 'int(10) unsigned',
      'notnull' => false,
      'default' => '0',
      'comment' => '链接图片id',
    ),
    'linktype' => 
    array (
      'type' => 'tinyint(1) unsigned',
      'notnull' => false,
      'default' => '1',
      'comment' => '链接类型, 1文字链接，2=图片链接',
    ),
    'is_publish' => 
    array (
      'type' => 'tinyint(1) unsigned',
      'notnull' => false,
      'default' => '1',
      'comment' => '状态，1是已发布，2代表草稿，默认为1',
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
  'primary' => 'lid',
  'engine' => 'InnoDB',
  'comment' => '博客友情链接',
) 
;