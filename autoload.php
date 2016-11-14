<?php

/**
 * 
 * Created by PhpStorm.
 * User: xiao
 * Date: 2016年11月14日
 * Time: 上午9:54:19
 */
class ClassLoader
{
    protected static $_registed = false;
    
    public static function register()
    {
        if(! self::$_registed)
        {
            self::$_registed = spl_autoload_register(['\ClassLoader', 'loadClass']);
        }
    }
    
    
    public static function loadClass($className)
    {
        $fileName = str_replace('\\', '/', $className);
        $filePath = $fileName.'.php';
        $baseDir = __DIR__;
        $path = $baseDir . '/' . $filePath;
        if(file_exists($path))
        {
            require $path;
            return;
        }
        
        throw new \RuntimeException ( 'Don\'t find file: ' . $className );

    }

}