<?php
/**
 * 
 * Created by PhpStorm.
 * User: xiao
 * Date: 2016年11月11日
 * Time: 下午6:56:58
 */
$master = ['test2'=>['default'=>'0', 'notnull'=>false, 'comment'=>'test']];
$slave = ['test2'=>['default'=>'0', 'notnull'=>false, 'comment'=>'222']];

var_dump(array_diff($master, $slave));
//var_dump(array_intersect($master, $slave));
