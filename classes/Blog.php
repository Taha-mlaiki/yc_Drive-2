<?php
require_once 'Database.php';

class Blog
{

    public function __construct(
        public string $image = "",
        public string $video = "",
        public string $title,
        public string $body,
        public string $user_id,
        public string $theme_id,
    ) {}

    private static function getDb()
    {
        $db = Database::getInstance();
        $db = $db->getConnection();
        return $db;
    }

    public function CreateBlog()
    {
        $db = self::getDb();
        $stmt = $db->prepare("INSERT INTO blog (image,video,title,body,user_id,theme_id) VALUES (:image,:video,:title,:body,:user_id,:theme_id)");
        $stmt->bindParam(":image", $this->image, PDO::PARAM_STR);
        $stmt->bindParam(":video", $this->image, PDO::PARAM_STR);
        $stmt->bindParam(":title", $this->title, PDO::PARAM_STR);
        $stmt->bindParam(":body", $this->body, PDO::PARAM_STR); 
        $stmt->bindParam(":user_id", $this->body, PDO::PARAM_INT); 
        $stmt->bindParam(":theme_id", $this->body, PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->rowCount();
    }
 
}
