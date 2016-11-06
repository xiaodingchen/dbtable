<?php 
array (
  'columns' => 
  array (
    'atid' => 
    array (
      'type' => 'int(10) unsigned',
      'autoincrement' => true,
      'notnull' => false,
      'default' => NULL,
      'comment' => '附件自增ID',
    ),
    'attype' => 
    array (
      'type' => 'tinyint(1) unsigned',
      'notnull' => false,
      'default' => '1',
      'comment' => '附件类型, 0非图片附件，1图片附件',
    ),
    'atname' => 
    array (
      'type' => 'varchar(100)',
      'notnull' => false,
      'default' => '',
      'comment' => '附件名称',
    ),
    'atpath' => 
    array (
      'type' => 'varchar(50)',
      'notnull' => false,
      'default' => '',
      'comment' => '附件路径',
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
  'primary' => 'atid',
  'engine' => 'InnoDB',
  'comment' => '应用附件表',
) 
;