<?php
require_once "../../helpers/validateInput.php";
require_once "../../classes/Car.php";

header("Content-Type: application/json");
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    try {
        $data = json_decode(file_get_contents("php://input"), true);

        $userId = (int) validateInput($data["userId"]);
        $carId = (int) validateInput($data["carId"]);
        $star = (float) validateInput($data["star"]);

        if (!is_int($userId) || $userId <= 0) {
            echo json_encode(['error' => 'User id must be a positive integer']);
            exit();
        }

        if (!is_int($carId) || $carId <= 0) {
            echo json_encode(['error' => 'Car id must be a positive integer']);
            exit();
        }

        if (!is_float($star) || $star <= 0 || $star > 5) {
            echo json_encode(['error' => 'Star rating must be a float between 0 and 5']);
            exit();
        }
        
        $isCreated = Car::addReviewStar($carId, $userId, $star);
        if ($isCreated) {
            echo json_encode(['success' => 'Reveiw added successfully']);
        }
    } catch (\Throwable $th) {
        echo json_encode(['error' =>  $th->getMessage()]);
    }
}
