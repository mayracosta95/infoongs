<?php
namespace Utils;

use PDO;

class DB
{
    public static function connect($connName = "default")
    {
        $connConfig = APP_ENV["db"][$connName];

        return new PDO(
            $connConfig["driver"] .':host='. $connConfig["host"] .':'.
            $connConfig["port"] .';dbname='. $connConfig["database"],
            $connConfig["user"], $connConfig["password"],
        );
    }

    public static function statement(string $statement, array $params = [], $connName = "default")
    {
        $conn = static::connect($connName);
        $stmt = $conn->prepare($statement);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
}
