<?php
/**
 * 
 * Created by PhpStorm.
 * User: xiao
 * Date: 2016年11月14日
 * Time: 上午11:56:21
 */
namespace DB;

class generSql
{
    /**
     * 生成创建表结构语句
     * 
     * @param string $tableName
     * @param array $tableSchema
     * @return string
     * */
    public function createTable($tableName, array $tableSchema)
    {
        $sql = 'CREATE TABLE `%s` ( ';
        // 处理字段
        foreach ($tableSchema['columns'] as $key=>$val)
        {
            $str = $this->createColumnSql($key, $val);
            $sql .= $str;
        }
        // 处理索引
        // 主键索引
        if(isset($tableSchema['primary']))
        {
            $sql .= $this->createPrimarySql($tableSchema['primary']);
        }
        
        // 普通索引
        if(isset($tableSchema['index']))
        {
            $str = '';
            foreach ($tableSchema['index'] as $indexKey=>$indexFields)
            {
                $fstr = $this->createIndexSql($indexFields);
                $str = " KEY `{$indexKey}` ({$fstr}),";
                $sql .= $str;
            }
        }
        
        // 唯一索引
        if(isset($tableSchema['unique']))
        {
            $str = '';
            foreach ($tableSchema['unique'] as $uniqueKey=>$uniqueFields)
            {
                $fstr = $this->createIndexSql($uniqueFields);
                $str = " UNIQUE KEY `{$uniqueKey}` ({$fstr}),";
                $sql .= $str;
            }
        }
        
        $sql = rtrim($sql, ',');
        $sql = $sql.')';
        
        // 处理表引擎
        if(isset($tableSchema['engine']))
        {
            $sql .= " ENGINE={$tableSchema['engine']}";
        }
        else
        {
            $sql .= " ENGINE=InnoDB";
        }
        
        // 处理表字符集
        if(isset($tableSchema['charset']))
        {
            $sql .=" DEFAULT CHARSET={$tableSchema['charset']}";
        }
        else
        {
            $sql .=" DEFAULT CHARSET=utf8";
        }
        
        // 处理表注释
        if(isset($tableSchema['comment']))
        {
            $sql .= " COMMENT='{$tableSchema['comment']}'";
        }
        
        $sql = sprintf($sql, $tableName);
        
        return $sql;
    }
    
    // 更新表结构
    public function updateTableSchema($masterSchema, $slaveSchema, $tableName)
    {
        $sqls = [];
        $columnSqls = $this->compareTableColumn($masterSchema, $slaveSchema, $tableName);
        
        $indexSqls = $this->compareTableIndex($masterSchema, $slaveSchema, $tableName);
        $statusSqls = $this->compareTableStatus($masterSchema, $slaveSchema, $tableName);
        $sqls = array_merge($columnSqls, $indexSqls, $statusSqls);
        
        return $sqls;
    }
    
    // 比较表状态
    public function compareTableStatus($masterSchema, $slaveSchema, $tableName)
    {
        $sql = [];
        if($masterSchema['comment'] != $slaveSchema['comment'])
        {
            $sql[] = "ALTER TABLE `{$tableName}` COMMENT='{$masterSchema['comment']}'";
        }
        
        if($masterSchema['engine'] != $slaveSchema['engine'])
        {
            $sql[] = "ALTER TABLE `{$tableName}` ENGINE='{$masterSchema['engine']}'";
        }
        
        return $sql;
    }
    
    // 比较索引
    public function compareTableIndex($masterSchema, $slaveSchema, $tableName)
    {
        $sql = [];
        $sql[] = $this->comparePrimaryIndex($masterSchema, $slaveSchema, $tableName);
        $sql = array_merge($sql, $this->compareIndexIndex($masterSchema, $slaveSchema, $tableName), $this->compareUniqueIndex($masterSchema, $slaveSchema, $tableName));
        
        return $sql;
    }
    
    // 比较主键索引
    public function comparePrimaryIndex($masterSchema, $slaveSchema, $tableName)
    {
        // 比较主键索引
        $sql = '';
        $masterPrimary = $slavePrimary = [];
        if(isset($masterSchema['primary']))
        {
            $masterPrimary = $masterSchema['primary'];
        }
        if(isset($slaveSchema['primary']))
        {
            $slavePrimary = $slaveSchema['primary'];
        }
        
        if(array_diff($masterPrimary, $slavePrimary) || array_diff($slavePrimary, $masterPrimary))
        {
            $str = "ALTER TABLE `{$tableName}` ADD {$this->createPrimarySql($masterPrimary)}";
            $str .= "DROP INDEX `PRIMARY`";
            $sql = $str;
        }
        
        return $sql;
    }
    
    // 比较唯一索引
    public function compareUniqueIndex($masterSchema, $slaveSchema, $tableName)
    {
        $sql = [];
        
        $masterIndex = $slaveIndex = [];
        if(isset($masterSchema['unique']))
        {
            $masterIndex = $masterSchema['unique'];
        }
        if(isset($slaveSchema['unique']))
        {
            $slaveIndex = $slaveSchema['unique'];
        }
        $addIndex = array_diff(array_keys($masterIndex), array_keys($slaveIndex));
        if($addIndex)
        {
            foreach ($addIndex as $index)
            {
                $sql[] = "ALTER TABLE `{$tableName}` ADD UNIQUE `{$index}` ({$this->createIndexSql($masterIndex[$index])})";
            }
        }
        $dropIndex = array_diff(array_keys($slaveIndex), array_keys($masterIndex));
        if($dropIndex)
        {
            foreach ($dropIndex as $dindex)
            {
                $sql[] = "ALTER TABLE `{$tableName}` DROP INDEX `{$dindex}`";
            }
        }
        
        foreach ($slaveIndex as $sIndexKey=>$sIndexVal)
        {
            $alert = $drop = [];
            if(isset($masterIndex[$sIndexKey]))
            {
                $alert = array_diff($masterIndex[$sIndexKey], $sIndexVal);
                $drop = array_diff($sIndexVal, $masterIndex[$sIndexKey]);
            }
            if($alert || $drop)
            {
                $sql[] = "ALTER TABLE `{$tableName}` ADD UNIQUE `{$sIndexKey}` ({$this->createIndexSql($masterIndex[$sIndexKey])}),DROP INDEX `{$sIndexKey}`";
            }
        }
        
        return $sql;
    }
    
    // 比较普通索引
    public function compareIndexIndex($masterSchema, $slaveSchema, $tableName)
    {
        $sql = [];
        // 比较普通索引
        $masterIndex = $slaveIndex = [];
        if(isset($masterSchema['index']))
        {
            $masterIndex = $masterSchema['index'];
        }
        if(isset($slaveSchema['index']))
        {
            $slaveIndex = $slaveSchema['index'];
        }
        
        
        $addIndex = array_diff(array_keys($masterIndex), array_keys($slaveIndex));
        if($addIndex)
        {
            foreach ($addIndex as $index)
            {
                $sql[] = "ALTER TABLE `{$tableName}` ADD INDEX `{$index}` ({$this->createIndexSql($masterIndex[$index])})";
            }
        }
        $dropIndex = array_diff(array_keys($slaveIndex), array_keys($masterIndex));
        if($dropIndex)
        {
            foreach ($dropIndex as $dindex)
            {
                $sql[] = "ALTER TABLE `{$tableName}` DROP INDEX `{$dindex}`";
            }
        }
        
        foreach ($slaveIndex as $sIndexKey=>$sIndexVal)
        {
            $alert = $drop = [];
            if(isset($masterIndex[$sIndexKey]))
            {
                $alert = array_diff($masterIndex[$sIndexKey], $sIndexVal);
                $drop = array_diff($sIndexVal, $masterIndex[$sIndexKey]);
            }
            
            if($alert || $drop)
            {
                $sql[] = "ALTER TABLE `{$tableName}` ADD INDEX `{$sIndexKey}` ({$this->createIndexSql($masterIndex[$sIndexKey])}),DROP INDEX `{$sIndexKey}`";
            }
        }
        
        return $sql;
    }
    
    public function createIndexSql($indexVal)
    {
        $fstr = '';
        foreach ($indexVal as $field)
        {
            $fstr .= "`{$field}`,";
        }
        
        $fstr = rtrim($fstr, ',');
        
        return $fstr;
    }
    
    // 比较字段
    public function compareTableColumn($masterSchema, $slaveSchema, $tableName)
    {
        $slaveColumns = $masterColumns = [];
        if($slaveSchema['columns'])
        {
            $slaveColumns = $slaveSchema['columns'];
        }
        if($masterSchema['columns'])
        {
            $masterColumns = $masterSchema['columns'];
        }
        $diff = [];
        $sql = [];
        foreach ($slaveColumns as $k=>$val)
        {
            $alert = $drop = [];
            if(isset($masterColumns[$k]))
            {
                $alert = array_diff($masterColumns[$k], $val);
                $drop = array_diff($val, $masterColumns[$k]);
            }
            
            if($alert || $drop)
            {
                $str = "ALTER TABLE `{$tableName}` CHANGE `{$k}` ";
                $str .= rtrim($this->createColumnSql($k, $masterColumns[$k]), ',');
                $sql[] = $str;
            }
        }
    
        $slaveFields = array_keys($slaveColumns);
        $masterFields = array_keys($masterColumns);
        $diffFields['alert'] = array_diff($masterFields, $slaveFields);
        $diffFields['drop'] = array_diff($slaveFields, $masterFields);
        if($diffFields['alert'])
        {
            
            foreach ($diffFields['alert'] as $add)
            {
                $str = "ALTER TABLE `{$tableName}` ADD ";
                $str .= $this->createColumnSql($add, $masterColumns[$add]);
                $sql[] = rtrim($str,',');
            }
        }
        
        if($diffFields['drop'])
        {
        
            foreach ($diffFields['drop'] as $drop)
            {
                $str = "ALTER TABLE `{$tableName}` DROP `{$drop}`";
                $sql[] = $str;
            }
        }
        
        
        return $sql;
    
    }
    
    public function createColumnSql($fieldName, $fieldVal)
    {
        $str = "`{$fieldName}` {$fieldVal['type']}";
        if($fieldVal['notnull'])
        {
            $str .=" NOT NULL";
        }
        
        if(isset($fieldVal['autoincrement']) && $fieldVal['autoincrement'])
        {
            $str .=" AUTO_INCREMENT";
        }
        
        if(isset($fieldVal['default']))
        {
            
            $str .=" DEFAULT '{$fieldVal['default']}'";
        }
        
        if(isset($fieldVal['comment']))
        {
            $str .= " COMMENT '{$fieldVal['comment']}',";
        }
        
        return $str;
    }
    
    public function createPrimarySql($primary)
    {
            $str = '';
            foreach ($primary as $val)
            {
                $str .= "`{$val}`,";
            }
            $str = rtrim($str, ',');
        
            $str = " PRIMARY KEY({$str}),";
            
            return $str;
    }

    public function dropTable($tableName)
    {
        return "DROP TABLE `{$tableName}`";
    }
    
    public static function __callstatic($method, $args)
    {
        return call_user_func_array(array($this,$method), $args);
    }
}