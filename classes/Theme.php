<?php
require_once 'Database.php';

class Theme
{

    public function __construct(public string $image, public string $title, public string $description) {}

    private static function getDb(){
        $db = Database::getInstance();
        $db = $db->getConnection();
        return $db;
    }

    public function CreateTheme (){
        $db = self::getDb();
        $stmt = $db->prepare("INSERT INTO theme (image,title,description) VALUES (:image,:title,:description)");
        $stmt->bindParam(":image",$this->image,PDO::PARAM_STR);
        $stmt->bindParam(":title",$this->title,PDO::PARAM_STR);
        $stmt->bindParam(":description",$this->description,PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->rowCount();
    }
}
