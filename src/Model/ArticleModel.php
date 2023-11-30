<?php
declare(strict_types=1);


namespace App\Model;


use App\Core\CoreModel;
use App\Core\ModelInterface;
use Opis\Database\Database;

class ArticleModel extends CoreModel implements ModelInterface
{

    public function __construct(Database $database)
    {
        parent::__construct($database);
        $this->setTableName('article');
    }
}

