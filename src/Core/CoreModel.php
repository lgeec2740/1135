<?php


namespace App\Core;


use Opis\Database\Database;
use PDO;


abstract class CoreModel implements ModelInterface
{
    protected  string $tableName;
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public  function setTableName(string $tableName): void
    {
        $this->tableName = $tableName;
    }

    public function all(): mixed
    {
        return $this->db->from($this->tableName)
            ->select()
            ->fetchAssoc()
            ->all();
    }

    public function find(int $id): mixed
    {
        return $this->db->from($this->tableName)
            ->where('id')->is($id)
            ->select()
            ->fetchAssoc()
            ->all();
    }

    public function count(): int
    {
        return  $this->db->from($this->tableName)->count();
    }
}