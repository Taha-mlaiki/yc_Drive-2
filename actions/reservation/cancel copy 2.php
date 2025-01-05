<?php
require_once "../../helpers/validateInput.php";
require_once "../../classes/Reservation.php";

header("Content-Type: application/json");
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    try {
        $data = json_decode(file_get_contents("php://input"), true);

        $reservationId = validateInput($data["reservId"]) ?? '';


        if (empty($reservationId)) {
            echo json_encode(['error' => 'reservationId  is required']);
            exit();
        }

        $isCanceled = Reservation::cancelReservation($reservationId);
        if(!$isCanceled){
            echo json_encode(['error' => 'Reservation not found!']);
            exit();
        }
        echo json_encode(['success' => 'Reservation Canceled']);
        exit();
    } catch (\Throwable $th) {
        echo json_encode(['error' =>  $th->getMessage()]);
    }
}
