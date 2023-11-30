<?php

namespace App;

use PDO;

class ModelPDO
{
    public PDO $pdo;
    /**
     * ModelPDO constructor.
     */
    public function __construct()
    {
        $dsn = "mysql:host=localhost;dbname=article;charset=utf8";
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $this->pdo = new PDO($dsn, 'dima05', 'Machtakov05', $opt);
    }

}
