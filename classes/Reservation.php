<?php

require_once 'Database.php';
class Reservation
{
    public function __construct(private $place, private $date, private $userId, private $carId) {}
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
        return $stmt->rowCount() > 0;
        $db = self::getDb();
        $stmt = $db->prepare("CALL createReservation(:place,:date,:user_id,:vehicle_id)");
        $stmt->bindParam(":place", $this->place);
        $stmt->bindParam(":date", $this->date);
        $stmt->bindParam(":user_id", $this->userId);
        $stmt->bindParam(":vehicle_id", $this->carId);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    static public function getAllUserReserv($id)
    {
        $db = self::getDb();
        $stmt = $db->prepare("SELECT r.id AS reservation_id, r.place AS reservation_place,
            r.date AS reservation_date,
            r.status AS reservation_status,
            v.name AS car_name,
            v.price AS car_price,
            v.imgUrl AS car_image,
            v.modal AS car_modal,
            c.name AS category
            FROM reservation r JOIN
            vehicle v ON r.vehicle_id = v.id
            JOIN
            category c ON c.id = v.category_id
            WHERE r.user_id = :id
        ");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    static public function getAllReservations()
    {
        $db = self::getDb();
        $stmt = $db->prepare("SELECT r.id AS reservation_id, r.place AS reservation_place,
            r.date AS reservation_date,
            r.status AS reservation_status,
            u.username AS user_name,
            u.email AS user_email,
            v.name AS car_name,
            v.price AS car_price,
            v.imgUrl AS car_image,
            v.modal AS car_modal,
            c.name AS category
            FROM reservation r JOIN
            vehicle v ON r.vehicle_id = v.id
            JOIN
            category c ON c.id = v.category_id
            JOIN 
            users u ON r.user_id = u.id
        ");
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    static public function cancelReservation ($id){
        $db = self::getDb();
        $stmt = $db->prepare("UPDATE reservation SET status = 'Canceled' WHERE id = :id");
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
    static public function acceptReservation ($id){
        $db = self::getDb();
        $stmt = $db->prepare("UPDATE reservation SET status = 'Accepted' WHERE id = :id");
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    static public function reservationStatistiques($status){
        $db = self::getDb();
        $stmt = $db->prepare("SELECT COUNT(*) FROM reservation WHERE status = :status");
        $stmt->bindParam(":status",$status);
        $stmt->execute();
        $res = $stmt->fetchColumn();
        return $res;
    }
}
