<?php

namespace app;

use PDO;

class DatabaseConnector
{
    private static $_instance = null;

    /** @var PDO|null  */
    private $dbConnection = null;

    public function __construct(array $config)
    {
        $host = $config['HOST'];
        $port = $config['PORT'];
        $db = $config['DATABASE'];
        $user = $config['USERNAME'];
        $pass = $config['PASSWORD'];

        try {
            $this->dbConnection = new \PDO(
                "mysql:host=$host;port=$port;charset=utf8mb4;dbname=$db",
                $user,
                $pass
            );
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public static function init(array $config)
    {
        self::$_instance = new static($config);
    }

    /**
     * @return static
     * @throws \Exception
     */
    public static function getInstance(): self
    {
        if (empty(self::$_instance)) {
            throw new \Exception('Database connection not initialized');
        }

        return self::$_instance;
    }

    /**
     * @return PDO|null
     */
    public function getConnection(): ?PDO
    {
        return $this->dbConnection;
    }
}