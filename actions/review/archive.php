<?php
require_once "../../helpers/validateInput.php";
require_once "../../classes/Review.php";

header("Content-Type: application/json");
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    try {
        $data = json_decode(file_get_contents("php://input"), true);

        $reviewId = (int) validateInput($data["reviewId"]);

        if (!is_int($reviewId)) {
            echo json_encode(['error' => 'review id must be a positive integer']);
            exit();
        }

        if(Review::archive($reviewId)){
            echo json_encode(['success' => 'Reveiw Archived successfully']);
        }
    } catch (\Throwable $th) {
        echo json_encode(['error' =>  $th->getMessage()]);
    }
}
