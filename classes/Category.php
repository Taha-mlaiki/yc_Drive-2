<?php
    require_once("../classes/Database.php"); 

class Category {
    private $name ;

    public function __construct($name)
    {
        $this->name = $name;
    }
    static private function getDb()
    {
        $db = Database::getInstance();
        $db = $db->getConnection();
        return $db;
    }

    public function checkExist (){
        $db = self::getDb();
        $stmt = $db->prepare("SELECT * FROM category WHERE name = :name");
        $stmt->bindParam(":name",$this->name);
        $stmt->execute();
        if($stmt->rowCount() === 0){
            return false;
        }else {
            return true;
        }
    }
    public function save(){
        $db = self::getDb();
        $stmt = $db->prepare("INSERT INTO category (name) VALUES (:name)");
        $stmt->bindParam(":name",$this->name);
        $res = $stmt->execute();
        
    }
}