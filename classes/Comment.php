<?php
require_once 'Database.php';

class Comment
{

    public function __construct(
        public string $body,
        public string $user_id,
        public string $blog_id,
    ) {}

    private static function getDb()
    {
        $db = Database::getInstance();
        $db = $db->getConnection();
        return $db;
    }

    public function CreateComment()
    {
        $db = self::getDb();
        $stmt = $db->prepare("INSERT INTO comment (body,user_id,blog_id) VALUES (:body,:user_id,:blog_id)");
        $stmt->bindParam(":body", $this->body, PDO::PARAM_STR); 
        $stmt->bindParam(":user_id", $this->user_id, PDO::PARAM_INT); 
        $stmt->bindParam(":blog_id", $this->blog_id, PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function updateComment($id)
    {
        $db = self::getDb();
        $stmt = $db->prepare("UPDATE comment SET body :body WHERE id = :id");
        $stmt->bindParam(":body", $this->body, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }


}
