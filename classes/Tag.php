<?php
require_once 'Database.php';

class Tag
{

    public function __construct(
        public string $name
    ) {}

    private static function getDb()
    {
        $db = Database::getInstance();
        $db = $db->getConnection();
        return $db;
    }

    public function CreateTag()
    {
        $db = self::getDb();
        $stmt = $db->prepare("INSERT INTO tag (name) VALUES (:name)");
        $stmt->bindParam(":name", $this->name, PDO::PARAM_STR); 
        $stmt->execute();
        return $stmt->rowCount();
    }



}
