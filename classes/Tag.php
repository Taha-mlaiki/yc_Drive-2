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


    public function editTag($id)
    {
        $db = self::getDb();
        $stmt = $db->prepare("UPDATE tag SET name = :name  WHERE id = :id");
        $stmt->bindParam(":name", $this->name, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }
    public static function deleteTag($id)
    {
        $db = self::getDb();
        $stmt = $db->prepare("DELETE tag WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
     }

}
