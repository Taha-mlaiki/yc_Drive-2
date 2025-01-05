<?php
require_once "../../classes/Car.php";
header("Content-Type: application/json");
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $data = json_decode(file_get_contents("php://input"), true);
        $page = (int) $data["page"] ?? 1;
        $limit = (int) $data["limit"] ?? 10;

        $data = Car::getAvailable($page, $limit);

        echo json_encode($data);
    } catch (\Throwable $th) {
        echo json_encode(["error" => $th->getMessage()]);
    }
}
