<?php
/**
 * 
 * Created by PhpStorm.
 * User: xiao
 * Date: 2016年11月14日
 * Time: 上午10:35:24
 */
namespace DB;
use \mysqli;

class dbschema
{

    protected $db;
    protected $dbName;

    public function __construct(mysqli $db)
    {
        $this->db = $db;
    }
    
    public function getDBName()
    {
        $sql = 'select database()';
        $result = $this->db->query($sql);
        if(! $result)
        {
            throw new \RuntimeException("database config must");
            
        }
        $result = $result->fetch_assoc();
        return $result['database()'];
    }

    public function getTables()
    {
        $sql = 'show tables';
        $result = $this->db->query($sql);
        if(!$result)
        {
            return [];
        }
        $rows = array();
        $key = 'Tables_in_'.$this->getDBName();
        
        while ($row = $result->fetch_assoc()) {
            
            $rows[] = $row[$key];
        }

        return $rows;
    }

    public function dbSchme($tableName)
    {
        $tmp['columns'] = $this->getTableColumns($tableName);
        $table = array_merge($tmp, $this->getTableIndex($tableName), $this->getTableStatus($tableName));

        return $table;
    }

    // 获取表状态
    public function getTableStatus($tableName)
    {
        $sql = "SHOW TABLE STATUS like '{$tableName}'";

        $result = $this->db->query($sql);
        if(! $result)
        {
            return [];
        }

        $result = $result->fetch_array();
        $table['engine'] = $result['Engine'];
        $table['comment'] = $result['Comment'];

        return $table;

    }

    // 获取表索引
    public function getTableIndex($tableName)
    {
        $sql = "SHOW index FROM {$tableName}";
        $result = $this->db->query($sql);
        if(!$result)
        {
            return [];
        }
        $tmp = array();
        while ($index = $result->fetch_assoc()) {
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
                $tmp['primary'][] = $index['Column_name'];
            }
        }


        return $tmp;
    }

    // 获取字段
    public function getTableColumns($tableName)
    {
        $sql = "show full columns from {$tableName}";
        $result = $this->db->query($sql);
        if(! $result)
        {
            return [];
        }
        $tmp = [];
        while ($val = $result->fetch_assoc()) {
            $tmp[$val['Field']]['type'] = $val['Type'];
            if ($val['Extra'] == 'auto_increment')
            {
                $tmp[$val['Field']]['autoincrement'] = true;
            }

            $tmp[$val['Field']]['notnull'] = false;
            if (isset($val['NULL']) && $val['NULL'] == 'NO')
            {
                $tmp[$val['Field']]['notnull'] = true;
            }
            if(isset($val['Default']))
            {
                $tmp[$val['Field']]['default'] = $val['Default'];
            }
            
            if(isset($val['Comment']))
            {
                $tmp[$val['Field']]['comment'] = $val['Comment'];
            }
            
        }

        return $tmp;
    }
    
    public function execute($sql)
    {
        $result = $this->db->real_query($sql);
        if(! $result)
        {
            throw new \RuntimeException($this->db->error, $this->db->errno);
        }
        
        return $result;
    }
}

