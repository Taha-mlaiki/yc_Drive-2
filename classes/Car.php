<?php
include "../../config/paths.php";
require_once BASE_PATH . '/classes/Database.php';
class Car
{
    private $id;
    public function __construct(private $name, private $price, private $category, private $description, private bool $available, private $modal) {}

    static private function getDb()
    {
        $db = Database::getInstance();
        $db = $db->getConnection();
        return $db;
    }

    public function getVar(string $varname)
    {
        if (property_exists($this, $varname)) {
            return $this->$varname;
        } else {
            throw new Exception("Property '$varname' does not exist.");
        }
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function update()
    {
        $db = self::getDb();
        $stmt = $db->prepare("
            UPDATE vehicle 
            SET name = :name, 
                description = :description, 
                price = :price, 
                category_id = :category_id, 
                modal = :modal, 
                available = :available 
            WHERE id = :id
        ");
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":category_id", $this->category);
        $stmt->bindParam(":modal", $this->modal);
        $stmt->bindParam(":available", $this->available);
        $stmt->bindParam(":id", $this->id);

        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
    public function save()
    {
        $db = self::getDb();

        if (empty($this->name) || empty($this->price)) {
            throw new Exception("Name and price cannot be empty.");
        }

        $stmt = $db->prepare("
        INSERT INTO vehicle (name, description, price, category_id, modal, available) 
        VALUES (:name, :description, :price, :category_id, :modal, :available)");
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":category_id", $this->category);
        $stmt->bindParam(":modal", $this->modal);
        $stmt->bindParam(":available", $this->available);

        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    static public function getAll()
    {
        $db = self::getDb();
        $stmt = $db->prepare("SELECT v.*, c.name AS category_name FROM vehicle v JOIN category c ON v.category_id = c.id");
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    static public function deleteOne($id)
    {
        $db = self::getDb();
        $stmt = $db->prepare("DELETE FROM vehicle WHERE id = :id");
        $stmt->bindParam(":id", $id);

        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
