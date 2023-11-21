<?php


namespace App\Core;


use PDO;


abstract class CoreModel implements ModelInterface
{


    /**
     * @var PDO
     */
    protected static PDO $dbh;

    /**
     * @var string
     */
    protected static string $tableName;

    /**
     * Model constructor.
     */
    public function __construct($tableName)
    {
        self::$dbh = new PDO('mysql:host=localhost;dbname=1135-cms', 'dima05', 'Machtakov05');
        self::$tableName = $tableName;
    }

    /**
     * @param string $sql
     * @param array $params
     * @param bool $all
     * @return mixed
     */
    public static function query(string $sql, array $params = [], bool $all = false): mixed
    {
        // Подготовка запроса
        $stmt = self::$dbh->prepare($sql);
        // Выполняя запрос
        $stmt->execute($params);
        // Возвращаем ответ
        if (!$all) {
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }
    }

    /**
     * @return mixed
     */
    public static function all(): mixed
    {
        // TODO: Implement all() method.
    }

    /**
     * @param int $id
     * @return mixed
     */
    public static function find(int $id): mixed
    {
        // TODO: Implement find() method.
    }

    /**
     * @return int
     */
    public static function count(): int
    {
        $sql = 'SELECT COUNT(*) as count from ' . self::$tableName;
        return self::query($sql);
    }
}