<?php

require_once 'Database.php';
class Reservation
{
    public function __construct(private $place,private $date,private $userId,private $carId)
    {
        
    }
    static private function getDb()
    {
        $db = Database::getInstance();
        $db = $db->getConnection();
        return $db;
    }


    public function update()
    {
        $db = self::getDb();
        $stmt = $db->prepare("UPDATE category SET name = :name WHERE id = :id");
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function save()
    {
        $db = self::getDb();
        $stmt = $db->prepare("INSERT INTO reservation (place,date,user_id,vehicle_id) VALUES (:place,:date,:user_id,:vehicle_id)");
        $stmt->bindParam(":place", $this->place);
        $stmt->bindParam(":date", $this->date);
        $stmt->bindParam(":user_id", $this->userId);
        $stmt->bindParam(":vehicle_id", $this->carId);
        $stmt->execute(); 
        return $stmt->rowCount() > 0 ;
    }

    static public function getAll()
    {
        $db = self::getDb();
        $stmt = $db->prepare("SELECT * FROM category");
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    static public function deleteOne($id)
    {
        $db = self::getDb();
        $stmt = $db->prepare("DELETE FROM category WHERE id = :id");
        $stmt->bindParam(":id", $id);

        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
