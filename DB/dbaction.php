<?php
/**
 * 
 * Created by PhpStorm.
 * User: xiao
 * Date: 2016年11月14日
 * Time: 上午10:37:01
 */
namespace DB;

use \mysqli;
use \DB\db;
use \DB\dbschema as dbstr;
use \DB\generSql;

class dbaction
{

    protected $master;

    protected $slave;
    protected $slaveConf;
    protected $masterConf;
    protected $sql = [];

    
    public function init()
    {
        $this->gener = new generSql();
        $this->master = db::connection($this->masterConf);
        $this->slave = db::connection($this->slaveConf);
    }
    
    public function run()
    {
        $this->createTable();
        $this->updateTableSchema();
        $this->exce();
    }
    
    public function exce()
    {
        $this->proSqls();
        $sqlArr = $this->sql;
        if($sqlArr)
        {
            foreach ($sqlArr as $sql)
            {
                //echo $sql."\n";
                $rs = $this->getDBStrObj($this->slave)->execute($sql);
                if($rs)
                {
                    echo $sql."\n";
                }
            }
        }
        
        echo "Master slave synchronization.\n";
    }

    public function proSqls()
    {
        $sqls = $this->sql;
        $this->sql = [];
        foreach ($sqls as $key => $sql) {
            if($sql)
            {
                $this->sql[] = $sql;
            }
        }

        return true;
    }

    // 比较表
    public function compareTable()
    {
        $masterTables = $this->getMasterTables();
        $slaveTables = $this->getSlaveTables();
        
        $diff = array_diff($masterTables, $slaveTables);
        $intersect = array_intersect($masterTables, $slaveTables);
        
        return ['diff' => $diff, 'inter'=>$intersect];
    }
    
    public function createTable()
    {
        extract($this->compareTable());
        if(! $diff)
        {
            return;
        }
        
        try {
            foreach ($diff as $name)
            {
                $schema = $this->getTableSchema($name, $this->master);

                $this->sql[] = $this->gener->createTable($name, $schema);
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        
        return true;
    }
    
    // 比较表结构
    public function updateTableSchema()
    {
        extract($this->compareTable());

        if(! $inter)
        {
            return;
        }
        
        foreach ($inter as $name)
        {
            $masterSchema = $this->getTableSchema($name, $this->master);
            $slaveSchema = $this->getTableSchema($name, $this->slave);
            if(! $slaveSchema && $masterSchema)
            {
                    $this->sql[] = $this->gener->createTable($name, $masterSchema);
            }
            if(! $masterSchema && $slaveSchema)
            {
                    $this->sql[] = $this->$this->gener->dropTable($name);
            }

            $this->sql = array_merge($this->sql, $this->gener->updateTableSchema($masterSchema, $slaveSchema, $name));
        }
        
        return true;
    }


    public function getDBStrObj($connect)
    {
        $obj = new dbstr($connect);

        return $obj;
    }

    public function getSlaveTables()
    {
        return $this->getDBStrObj($this->slave)->getTables();
    }

    public function getMasterTables()
    {
        return $this->getDBStrObj($this->master)->getTables();
    }

    public function getTableSchema($tableName, mysqli $db)
    {
        return $this->getDBStrObj($db)->dbSchme($tableName);
    }
    
    public function setMasterConf($config)
    {
        $this->masterConf = $config;
    }
    
    public function setSlaveConf($config)
    {
        $this->slaveConf = $config;
    }
}
