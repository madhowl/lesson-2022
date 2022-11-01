<?php


namespace App\Core;


use PDO;

abstract class CoreModel implements ModelInterface
{


    /**
     * @var PDO
     */
    protected static PDO $dbh;

    protected static string $tableName;

    /**
     * TodoModel constructor.
     */
    public function __construct($tableName)
    {
        self::$dbh = new PDO('mysql:host=localhost;dbname=todo', 'admin', 'admin');
        self::$tableName = $tableName;
    }

    public static function query(string $sql, array $params = [], bool $all = false): mixed
    {
        // Подготовка запроса
        $stmt = self::$dbh->prepare($sql);
        // Выполняя запрос
        $stmt->execute($params);
        // Возвращаем ответ
        if (!$all){
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }else{
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }
    }

    public static function all(): mixed
    {
        // TODO: Implement all() method.
    }

    public static function find(int $id): mixed
    {
        // TODO: Implement find() method.
    }

    public static function count(): int
    {
        $sql = 'SELECT COUNT(*) as count from '.self::$tableName;
        return self::query($sql);
    }
}