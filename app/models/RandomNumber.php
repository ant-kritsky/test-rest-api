<?php

namespace app\models;

use PDO;

class RandomNumber extends ModelBase
{
    protected $_table = 'random_number';

    public function add(int $value = null)
    {
        $query = $this->_db->prepare("INSERT INTO {$this->_table}
            (`value`) VALUES (:value)
        ");

        $query->bindParam(":value", $value, PDO::PARAM_INT, 250);
        $query->execute();

        $error = $query->errorInfo();

        if (!empty($error[4])) {
            throw new \Exception($error[4]);
        }

        return $this->_db->lastInsertId();
    }
}
