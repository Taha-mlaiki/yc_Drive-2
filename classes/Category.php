<?php
require_once  'Database.php';
class Category
{
    private $name;
    private $id;
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

    public function setVar(string $varname, $value)
    {
        if (property_exists($this, $varname)) {
            $this->$varname = $value;
        } else {
            throw new Exception("Property '$varname' does not exist.");
        }
    }
    public function checkExistById()
    {
        $db = self::getDb();
        $stmt = $db->prepare("SELECT * FROM category WHERE id = :id");
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        if (!$this->id) {
            throw new Error("id does not exist");
        }
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function checkExist()
    {
        $db = self::getDb();
        $stmt = $db->prepare("SELECT * FROM category WHERE name = :name");
        $stmt->bindParam(":name", $this->name);
        $stmt->execute();
        if ($stmt->rowCount() === 0) {
            return false;
        } else {
            return true;
        }
    }

    public function update()
    {
        $db = self::getDb();
        $stmt = $db->prepare("UPDATE category SET name = :name WHERE id = :id");
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":id", $this->id);
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
        $stmt = $db->prepare("INSERT INTO category (name) VALUES (:name)");
        $stmt->bindParam(":name", $this->name);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
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
