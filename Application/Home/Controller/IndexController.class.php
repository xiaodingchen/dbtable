<?php
namespace Home\Controller;
use Think\Controller;
use Think\Db\Driver\Mysqli;
class IndexController extends Controller {
    public function index(){
        $config['hostname'] = '127.0.0.1';
        $config['username'] = 'root';
        $config['password'] = 'root';
        $config['database'] = 'blog';
        $config['hostport'] = 3306;
    	$obj = new Mysqli($config);
    	$tables = $obj->getTables();
    	$fields = $obj->getFields('bg_article');
    	$indexs = $obj->query('SHOW index FROM bg_article');
    	$tmp = [];
    	$tmp['columns'] = $fields;
    	foreach ($indexs as $index)
    	{
    	    if($index['Non_unique'] == 0 && $index['Key_name'] != 'PRIMARY')
    	    {
    	        $tmp['unique'][$index['Key_name']][] = $index['Column_name'];
    	    }
    	    
    	    if($index['Non_unique'] == 1)
    	    {
    	        $tmp['index'][$index['Key_name']][] = $index['Column_name'];
    	    }
    	    
    	    if($index['Non_unique'] == 0 && $index['Key_name'] == 'PRIMARY')
    	    {
    	        $tmp['primary'] = $index['Column_name'];
    	    }
    	} 
    	
    	echo '<pre>';
    	print_r($tmp);
    	var_dump($fields);
    	exit;
//     	var_export($expression)
    }

  
}