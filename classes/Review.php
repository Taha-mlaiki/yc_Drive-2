<?php
require_once  'Database.php';

class Review
{

    public function __construct(private $stars, private $userId, private $carId) {}
    static private function getDb()
    {
        $db = Database::getInstance();
        $db = $db->getConnection();
        return $db;
    }


    static  public function update($id, $stars)
    {
        $db = self::getDb();
        $stmt = $db->prepare("UPDATE review SET star = :star WHERE id = :id");
        $stmt->bindParam(":star", $stars);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
    public function save()
    {
        $db = self::getDb();
        $stmt = $db->prepare("INSERT INTO review (vehicle_id,user_id,star) VALUES (:carId,:userId,:star)");
        $stmt->bindParam(":carId", $this->carId);
        $stmt->bindParam(":userId", $this->userId);
        $stmt->bindParam(":star", $this->stars);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    static public function archive($reviewId)
    {
        $db = self::getDb();
        $stmt = $db->prepare("UPDATE review SET isArchived = 1 WHERE id = :reviewId;");
        $stmt->bindParam(":reviewId", $reviewId);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
}
