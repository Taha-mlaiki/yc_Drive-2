<?php

class Database
{
    private $host = "localhost";
    private $dbName = "driveloc";
    private $username = "root";
    private $password = "";
    private static $instance = null;
    private $connection ;

    private function __construct()
    {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbName}";
            $this->connection = new PDO($dsn, $this->username, $this->password);

            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    static function getInstance (){
        if(self::$instance === null){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection (){
        return $this->connection;
    }

}