<?php
/**
 * 
 * Created by PhpStorm.
 * User: xiao
 * Date: 2016年11月14日
 * Time: 上午10:32:56
 */
namespace DB;
use \mysqli;
class db
{

    protected static $connction = [];

    public function connection($config)
    {
        $key = md5(serialize($config));
        if (! isset(self::$connction[$key])) {
            self::$connction[$key] = new mysqli($config['host'], $config['user'], $config['pwd'], $config['dbname'], $config['port']);
            if(self::$connction[$key]->connect_errno)
            {
                throw new \RuntimeException(self::$connction[$key]->connect_error);
            }
            self::$connction[$key]->set_charset('utf8');
        }
        
        $this->dbname = $config['dbname'];
        
        return self::$connction[$key];
    }

    public static function __callstatic($method, $args)
    {
        return call_user_func_array(array($this,$method), $args);
    }
}
