<?php
require_once 'Database.php';

class Theme
{

    public function __construct(public string $image, public string $title, public string $description) {}

    private static function getDb()
    {
        $db = Database::getInstance();
        $db = $db->getConnection();
        return $db;
    }

    public function CreateTheme()
    {
        $db = self::getDb();
        $stmt = $db->prepare("INSERT INTO theme (image,title,description) VALUES (:image,:title,:description)");
        $stmt->bindParam(":image", $this->image, PDO::PARAM_STR);
        $stmt->bindParam(":title", $this->title, PDO::PARAM_STR);
        $stmt->bindParam(":description", $this->description, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->rowCount();
    }
    public function updateTheme($id)
    {
        $db = self::getDb();
        $stmt = $db->prepare("UPDATE theme SET image = :image, title = :title, description :description WHERE id = :id");
        $stmt->bindParam(":image", $this->image, PDO::PARAM_STR);
        $stmt->bindParam(":title", $this->title, PDO::PARAM_STR);
        $stmt->bindParam(":description", $this->description, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }
    public static function deleteTheme($id)
    {
        $db = self::getDb();
        $stmt = $db->prepare("DELETE theme WHERE  id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }
    public static function getAllThemes()
    {
        $db = self::getDb();
        $stmt = $db->prepare("SELECT * FROM theme");
        $stmt->execute();
        if($stmt->rowCount() > 1){
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
    }
}
