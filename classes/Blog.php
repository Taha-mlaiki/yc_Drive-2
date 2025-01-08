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
    public function updateBlog($id)
    {
        $db = self::getDb();
        $stmt = $db->prepare("UPDATE blog SET image = :image, video = :video, title = :title, body :body WHERE id = :id");
        $stmt->bindParam(":image", $this->image, PDO::PARAM_STR);
        $stmt->bindParam(":video", $this->video, PDO::PARAM_STR);
        $stmt->bindParam(":title", $this->title, PDO::PARAM_STR);
        $stmt->bindParam(":body", $this->body, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }
    public static function deleteBlog($id)
    {
        $db = self::getDb();
        $stmt = $db->prepare("DELETE blog WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }
    public static function getBlogById($id)
    {
        $db = self::getDb();
        $stmt = $db->prepare("SELECT * FROM theme WHERE id = :id");
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        if ($stmt->rowCount() > 1) {
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
    }
    
    public static function getAllBlogByThemeId($theme_id)
    {
        $db = self::getDb();
        $stmt = $db->prepare("SELECT * FROM blog where theme_id = :theme_id");
        $stmt->execute();
        if ($stmt->rowCount() > 1) {
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
    }

}
