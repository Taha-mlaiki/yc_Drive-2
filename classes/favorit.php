<?php
require_once 'Database.php';

class Favorit
{

    public function __construct(
        public string $user_id,
        public string $blog_id,
    ) {}

    private static function getDb()
    {
        $db = Database::getInstance();
        $db = $db->getConnection();
        return $db;
    }

    public function AddToFavorit()
    {
        $db = self::getDb();
        $stmt = $db->prepare("INSERT INTO favorit (user_id,blog_id) VALUES (:user_id,:blog_id)");
        $stmt->bindParam(":user_id", $this->user_id, PDO::PARAM_INT); 
        $stmt->bindParam(":blog_id", $this->blog_id, PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->rowCount();
    }

    
    public static function removeFromFavorit($user_id,$blog_id)
    {
        $db = self::getDb();
        $stmt = $db->prepare("DELETE favorit WHERE user_id = :user_id AND blog_id = :blog_id");
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->bindParam(":blog_id", $blog_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }

}
