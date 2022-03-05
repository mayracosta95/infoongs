<?php 
namespace Repositories;

use Utils\DB;

class Repository
{
    const TABLE = '';

    public static function get(array $where = [])
    {
        $sql = 'SELECT * FROM ' . static::TABLE;
        if(count($where)) $sql .= static::makeWhereStatement($where);
        return DB::statement($sql);
    }

    public static function first(array $where = [])
    {
        $sql = 'SELECT * FROM ' . static::TABLE;
        if(count($where)) $sql .= static::makeWhereStatement($where);
        $sql .=  ' LIMIT 1';
        $results = DB::statement($sql);

        return isset($results[0]) ? $results[0] : null;
    }

    public static function insert(array $params)
    {
        $sql = "INSERT INTO `". static::TABLE ."` (";

        foreach($params as $k => $v) {
            $sql .= "`$k`, ";
        }

        $sql = rtrim($sql, ", ");
        $sql .= ') VALUES (';

        foreach($params as $k => $v) {
            $sql .= "'$v', ";
        }

        $sql = rtrim($sql, ", ");
        $sql .= ");";

        return DB::statement($sql);
    }

    public static function update(array $params, array $where = [])
    {
        $sql = "UPDATE `". static::TABLE ."` SET ";

        foreach($params as $k => $v) {
            $sql .= "`$k` = '$v', ";
        }
        $sql = rtrim($sql, ", ");

        if(count($where)) $sql .= self::makeWhereStatement($where);
        $sql .= ";";

        return DB::statement($sql);
    }

    public static function delete(array $where)
    {
        $sql = "DELETE FROM `". static::TABLE . "`";
        if(count($where)) $sql .= self::makeWhereStatement($where);
        $sql .= ";";
        return DB::statement($sql);
    }

    private static function makeWhereStatement(array $where)
    {
        $sql = " WHERE ";

        foreach($where as $k => $v) {

            if(is_array($v)) {
                $sql .= "`{$v[0]}` {$v[1]} '{$v[2]}' AND ";
            } else {
                $sql .= "`$k` = '$v' AND ";
            }
            
        }
        $sql = rtrim($sql, " AND ");

        return $sql;
    }
}