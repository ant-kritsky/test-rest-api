<?php

namespace app;

use PDO;

class DatabaseConnector
{
    private static $_instance = null;

    /** @var PDO|null */
    private $dbConnection = null;

    public function __construct(DbConf $config)
    {
        try {
            $this->dbConnection = new \PDO(
                "mysql:host=" . $config::HOST . ";port=" . $config::PORT . ";charset=utf8mb4;dbname=" . $config::DATABASE,
                $config::USERNAME,
                $config::PASSWORD
            );
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    /**
     * @return PDO|null
     */
    public function getConnection(): ?PDO
    {
        return $this->dbConnection;
    }
}
