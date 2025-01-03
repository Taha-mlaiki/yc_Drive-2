<?php
require_once "../../helpers/validateInput.php";
require_once "../../classes/Car.php";

header("Content-Type: application/json");
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    try {
        $data = json_decode(file_get_contents("php://input"), true);

        $name = validateInput($data["name"]) ?? '';
        $price = validateInput($data["price"]) ?? '';
        $category = validateInput($data["category"]) ?? '';
        $description = validateInput($data["description"]) ?? '';
        $available = validateInput($data["available"]);
        $modal = validateInput($data["modal"]) ?? '';
        $imgUrl = validateInput($data["imgUrl"]) ?? '';


        if (empty($name)) {
            echo json_encode(['error' => 'Name field is required']);
            exit();
        }
        if (empty($imgUrl)) {
            echo json_encode(['error' => 'imge url is required and must be a valid url.']);
            exit();
        }

        if (empty($price)) {
            echo json_encode(['error' => 'Price field is required']);
            exit();
        }

        if (empty($category)) {
            echo json_encode(['error' => 'Category field is required']);
            exit();
        }

        if (empty($description)) {
            echo json_encode(['error' => 'Description field is required']);
            exit();
        }
        if (empty($modal)) {
            echo json_encode(['error' => 'Modal field is required']);
            exit();
        }

        $newCar = new Car($name, $price, $category, $description, $available, $modal, $imgUrl);
        if ($newCar->save()) {
            echo json_encode(['success' => 'Car created successfully']);
        }
    } catch (\Throwable $th) {
        echo json_encode(['error' =>  $th->getMessage()]);
    }
}
