<?php
namespace Home\Controller;

use Think\Controller;
use Think\Db\Driver\Mysqli;

class IndexController extends Controller {

    protected $obj;

    public function __construct()
    {
        parent::__construct();
        $config['hostname'] = '127.0.0.1';
        $config['username'] = 'root';
        $config['password'] = 'root';
        $config['database'] = 'blog';
        $config['hostport'] = 3306;
        $config['charset'] = 'utf8';
        $this->obj = new Mysqli($config);
    }

    public function index()
    {
        foreach ($this->getTables() as $tableName)
        {
            $tmp['columns'] = $this->getTableColumns($tableName);
            $table = array_merge($tmp, $this->getTableIndex($tableName), $this->getTableStatus($tableName));
            $tStr = var_export($table, 1);
            $str = "<?php \n";
            $str .= $tStr. " \n";
            $str .= ';';
            
            file_put_contents(DBTABLE_PATH . $tableName.'.php', $str);
        }
        
    }
    
    public function getTables()
    {
        return $this->obj->getTables();
    }

    public function getTableStatus($tableName)
    {
        $sql = "SHOW TABLE STATUS like '{$tableName}'";
        $result = $this->obj->query($sql);
        if(! $result)
        {
            return false;
        }
        
        $table = [];
        foreach ($result as $val)
        {
            if ($val['Name'] == $tableName)
            {
                $table['engine'] = $val['Engine'];
                $table['comment'] = $val['Comment'];
                break;
            }
        }
        
        return $table;
    
    }

    public function getTableColumns($tableName)
    {
        $sql = "show full columns from {$tableName}";
        $result = $this->obj->query($sql);
        if(! $result)
        {
            return false;
        }
        $tmp = [];
        foreach ($result as $val)
        {
            $tmp[$val['Field']]['type'] = $val['Type'];
            if ($val['Extra'] == 'auto_increment')
            {
                $tmp[$val['Field']]['autoincrement'] = true;
            }
            
            $tmp[$val['Field']]['notnull'] = false;
            if ($val['NULL'] == 'NO')
            {
                $tmp[$val['Field']]['notnull'] = true;
            }
            
            $tmp[$val['Field']]['default'] = $val['Default'];
            $tmp[$val['Field']]['comment'] = $val['Comment'];
        
        }
        
        return $tmp;
    }

    public function getTableIndex($tableName)
    {
        $sql = "SHOW index FROM {$tableName}";
        $result = $this->obj->query($sql);
        if(! $result)
        {
            return false;
        }
        $tmp = [];
        foreach ($result as $index)
        {
            if ($index['Non_unique'] == 0 && $index['Key_name'] != 'PRIMARY')
            {
                $tmp['unique'][$index['Key_name']][] = $index['Column_name'];
            }
            
            if ($index['Non_unique'] == 1)
            {
                $tmp['index'][$index['Key_name']][] = $index['Column_name'];
            }
            
            if ($index['Non_unique'] == 0 && $index['Key_name'] == 'PRIMARY')
            {
                $tmp['primary'] = $index['Column_name'];
            }
        }
        
        return $tmp;
        
    }

}