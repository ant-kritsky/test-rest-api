<?php

namespace app\Models;

use app\DatabaseConnector as DC,
    PDO;

abstract class ModelBase
{
    /** @var PDO|null */
    protected $_db = null;
    protected $_table = null;

    public function __construct()
    {
        $this->_db = DC::getInstance()->getConnection();

        return $this;
    }

    public function get($id = 0)
    {
        $query = $this->_db->prepare("SELECT {$this->_table}.* FROM {$this->_table} WHERE id=:id");
        $query->bindParam(":id", $id, PDO::PARAM_INT, 11);
        $query->execute();

        return $query->fetch(PDO::FETCH_OBJ);
    }

}