<?php

namespace CRUD\Helper;

use Exception;
use PDO;
use PDOException;

class DBConnector
{

    /** @var mixed $db */
    private \PDO $db;
    private $server;
    private $username;
    private $password;
    private $dbName;

    public function __construct($server, $username, $password, $dbName)
    {
        $this->server = $server;
        $this->username = $username;
        $this->password = $password;
        $this->dbName = $dbName;

    }

    /**
     * @return void
     * @throws Exception
     */
    public function connect(): void
    {
        try {
            $this->db = new \PDO("mysql:host=localhost; ", $this->username, $this->password);
            if ($this->db) {
                echo "Connection successfully";
                echo " <br>";
            }
            $this->db->exec("Create database IF NOT EXISTS  " . $this->dbName)
            or die(print_r($this->db->errorInfo(), true));
            $this->db->query("use $this->dbName;");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @param string $query
     * @return bool
     */
    public function execQuery(string $query): bool
    {
        $this->db->query($query);
        return true;
    }

    public function execQueryWithSol(string $query)
    {
        $result= $this->db->query($query);
        return $result;
    }
    /**
     * @param string $message
     * @return void
     * @throws Exception
     */
    private function exceptionHandler(string $message): void
    {
        echo $message;
    }
}