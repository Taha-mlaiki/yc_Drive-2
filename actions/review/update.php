<?php
require_once "../../helpers/validateInput.php";
require_once "../../classes/Review.php";

header("Content-Type: application/json");
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    try {
        $data = json_decode(file_get_contents("php://input"), true);

        $reviewId = (int) validateInput($data["reviewId"]);
        $star = (float) validateInput($data["star"]);

        if (!is_int($reviewId)) {
            echo json_encode(['error' => 'review id must be a positive integer']);
            exit();
        }

        if (!is_float($star) || $star <= 0 || $star > 5) {
            echo json_encode(['error' => 'Star rating must be a float between 0 and 5']);
            exit();
        }
        if(Review::update($reviewId,$star)){
            echo json_encode(['success' => 'Reveiw added successfully']);
        }
    } catch (\Throwable $th) {
        echo json_encode(['error' =>  $th->getMessage()]);
    }
}
