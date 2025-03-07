<?php
require_once 'Database.php';
class Car
{
    private $id;
    public function __construct(private $name, private $price, private $category, private $description, private bool $available, private $modal, private $imgUrl) {}

    static private function getDb()
    {
        $db = Database::getInstance();
        $db = $db->getConnection();
        return $db;
    }
    static public function getOneById($id)
    {
        $db = self::getDb();
        $stmt = $db->prepare("
        SELECT 
            v.id AS vehicle_id, 
            v.name AS vehicle_name, 
            v.description AS vehicle_description, 
            v.price AS vehicle_price, 
            v.modal AS vehicle_modal, 
            v.available AS vehicle_available, 
            v.imgUrl AS vehicle_image, 
            c.name AS category, 
            r.id AS review_id,
            r.star AS review_star, 
            u.id AS user_id, 
            u.username AS user_name
        FROM vehicle v
        LEFT JOIN category c ON c.id = v.category_id
        LEFT JOIN review r ON r.vehicle_id = v.id AND r.isArchived = 0
        LEFT JOIN users u ON r.user_id = u.id
        WHERE v.id = :id
    ");
        try {
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $vehicle = [
                    'vehicle_id' => $results[0]['vehicle_id'],
                    'vehicle_name' => $results[0]['vehicle_name'],
                    'vehicle_description' => $results[0]['vehicle_description'],
                    'vehicle_price' => $results[0]['vehicle_price'],
                    'vehicle_modal' => $results[0]['vehicle_modal'],
                    'available' => $results[0]['vehicle_available'],
                    'category' => $results[0]['category'],
                    'vehicle_image' => $results[0]['vehicle_image'],
                    'reviews' => [],
                ];

                foreach ($results as $row) {
                    if ($row['review_id']) {
                        $vehicle['reviews'][] = [
                            'review_id' => $row['review_id'],
                            'stars' => $row['review_star'],
                            'user' => [
                                'user_id' => $row['user_id'],
                                'user_name' => $row['user_name'],
                            ]
                        ];
                    }
                }

                return $vehicle;
            }
        } catch (PDOException $th) {
            throw new Error($th->getMessage());
        }

        return null; // Explicitly return null if no vehicle is found
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
                available = :available ,
                imgUrl = :imgUrl 
            WHERE id = :id
        ");
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":category_id", $this->category);
        $stmt->bindParam(":modal", $this->modal);
        $stmt->bindParam(":available", $this->available);
        $stmt->bindParam(":imgUrl", $this->imgUrl);
        $stmt->bindParam(":id", $this->id);

        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
    public function save()
    {
        $db = self::getDb();

        $stmt = $db->prepare("
        INSERT INTO vehicle (name, description, price, category_id, modal, available,imgUrl) 
        VALUES (:name, :description, :price, :category_id, :modal, :available,:imgUrl)");
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":category_id", $this->category);
        $stmt->bindParam(":modal", $this->modal);
        $stmt->bindParam(":available", $this->available);
        $stmt->bindParam(":imgUrl", $this->imgUrl);

        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
    static public function isUserReservedCard($carId, $userId)
    {
        $db = self::getDb();
        $stmt = $db->prepare("SELECT COUNT(*) FROM users u JOIN reservation r ON r.user_id = u.id JOIN vehicle v ON r.vehicle_id = v.id WHERE v.id = :carId AND u.id = :userId AND r.status = 'Accepted'");
        $stmt->bindParam(":carId", $carId);
        $stmt->bindParam(":userId", $userId);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count > 0;
    }


    static public function getAll()
    {

        $db = self::getDb();
        $stmt = $db->prepare("SELECT v.*, c.name AS category_name FROM vehicle v JOIN category c ON v.category_id = c.id");
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    static public function getAvailable($page, $limit)
    {
        $offset = ($page - 1) * $limit;
        $db = self::getDb();

        $stmt = $db->prepare("SELECT v.*, c.name AS category_name 
        FROM vehicle v 
        JOIN category c ON v.category_id = c.id 
        WHERE v.available = 1 
        LIMIT ?, ?");
        $stmt->bindValue(1, $offset, PDO::PARAM_INT);
        $stmt->bindValue(2, $limit, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $total = $db->prepare("SELECT COUNT(*) FROM vehicle WHERE available = 1 ");
        $total->execute();
        $toatlRecords = $total->fetchColumn();

        $totalPages = ceil($toatlRecords / $limit);

        return ["cars" => $data, "toatlRecords" => $toatlRecords, "totalPages" => $totalPages];
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
