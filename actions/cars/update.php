<?php
require_once "../../helpers/validateInput.php";
require_once "../../classes/Car.php";

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $data = json_decode(file_get_contents("php://input"), true);

        // Validate input
        $id = validateInput($data["id"]);
        $name = validateInput($data["name"]);
        $description = validateInput($data["description"]);
        $category_id = validateInput($data["category"]);
        $available = validateInput($data["available"]);
        $modal = validateInput($data["modal"]);
        $price = validateInput($data["price"]);

        // Validation for each variable
        if (empty($id) || !is_numeric($id)) {
            echo json_encode(['error' => 'ID is required and must be a valid number.']);
            exit();
        }

        if (empty($name) || strlen($name) > 255) {
            echo json_encode(['error' => 'Name is required and must be less than 255 characters.']);
            exit();
        }

        if (empty($description)) {
            echo json_encode(['error' => 'Description is required.']);
            exit();
        }

        if (empty($category_id) || !is_numeric($category_id)) {
            echo json_encode(['error' => 'Category ID is required and must be a valid number.']);
            exit();
        }

        if (!isset($available) || !in_array($available, [0, 1])) {
            echo json_encode(['error' => 'Available status is required and must be 0 or 1.']);
            exit();
        }

        if (empty($modal)) {
            echo json_encode(['error' => 'Modal field is required.']);
            exit();
        }

        if (empty($price) || !is_numeric($price) || $price < 0) {
            echo json_encode(['error' => 'Price is required and must be a positive number.']);
            exit();
        }

        $newCar = new Car($name,$price,$category_id,$description,$available,$modal);
        $newCar->setId($id);
        if(!$newCar->update()){
            echo json_encode(['error' => 'Somthing went wrong']);
            exit();
        }   
        http_response_code(200); // OK
        echo json_encode(['success' => 'Car updated successfully!']);
    } catch (\Throwable $th) {
        http_response_code(500);
        echo json_encode(['error' => $th->getMessage()]);
    }
}
