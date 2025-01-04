<?php
require_once "../../helpers/validateInput.php";
require_once "../../classes/Reservation.php";

header("Content-Type: application/json");
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    try {
        $data = json_decode(file_get_contents("php://input"), true);

        $date = validateInput($data["date"]) ?? '';
        $place = validateInput($data["place"]) ?? '';
        $userId = validateInput($data["userId"]) ?? '';
        $carId = validateInput($data["carId"]) ?? '';


        if (empty($date)) {
            echo json_encode(['error' => 'date field is required']);
            exit();
        }
        if (empty($place)) {
            echo json_encode(['error' => 'place is required .']);
            exit();
        }

        if (empty($userId)) {
            echo json_encode(['error' => 'User id field is required']);
            exit();
        }

        if (empty($carId)) {
            echo json_encode(['error' => 'car Id field is required']);
            exit();
        }


        $newReservation = new Reservation($place,$date,$userId,$carId);
        if ($newReservation->save()) {
            echo json_encode(['success' => 'Reservation created successfully']);
        }
    } catch (\Throwable $th) {
        echo json_encode(['error' =>  $th->getMessage()]);
    }
}
