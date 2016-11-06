<?php 
array (
  'columns' => 
  array (
    'aid' => 
    array (
      'type' => 'int(10) unsigned',
      'autoincrement' => true,
      'notnull' => false,
      'default' => NULL,
      'comment' => '自增',
    ),
    'cid' => 
    array (
      'type' => 'int(10) unsigned',
      'notnull' => false,
      'default' => NULL,
      'comment' => '分类ID,来自分类表',
    ),
    'title' => 
    array (
      'type' => 'varchar(100)',
      'notnull' => false,
      'default' => '',
      'comment' => '文章标题',
    ),
    'source' => 
    array (
      'type' => 'varchar(100)',
      'notnull' => false,
      'default' => '',
      'comment' => '文章来源',
    ),
    'sourl' => 
    array (
      'type' => 'varchar(255)',
      'notnull' => false,
      'default' => '',
      'comment' => '文章来源链接',
    ),
    'logo_atid' => 
    array (
      'type' => 'int(10) unsigned',
      'notnull' => false,
      'default' => '0',
      'comment' => '来源LOGO图片id',
    ),
    'face_atid' => 
    array (
      'type' => 'int(10) unsigned',
      'notnull' => false,
      'default' => '0',
      'comment' => '文章封面图片id',
    ),
    'asort' => 
    array (
      'type' => 'int(10) unsigned',
      'notnull' => false,
      'default' => NULL,
      'comment' => '自定义排序',
    ),
    'read_num' => 
    array (
      'type' => 'smallint(5) unsigned',
      'notnull' => false,
      'default' => '0',
      'comment' => '阅读记录数',
    ),
    'is_publish' => 
    array (
      'type' => 'tinyint(1) unsigned',
      'notnull' => false,
      'default' => '1',
      'comment' => '文章状态，1是已发布，2代表草稿，默认为1',
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
  'primary' => 'aid',
  'unique' => 
  array (
    'title' => 
    array (
      0 => 'title',
    ),
    'sourl' => 
    array (
      0 => 'sourl',
    ),
    'face_atid_logo_atid' => 
    array (
      0 => 'face_atid',
      1 => 'logo_atid',
    ),
  ),
  'index' => 
  array (
    'cid' => 
    array (
      0 => 'cid',
    ),
    'aid_cid' => 
    array (
      0 => 'aid',
      1 => 'cid',
    ),
  ),
  'engine' => 'InnoDB',
  'comment' => '博客文章主表',
) 
;