<?php
require_once "../../classes/Car.php";

header("Content-Type: application/json");
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    try {
        $data = Car::getAll();
        echo json_encode(["cars" => $data]);
    } catch (\Throwable $th) {
        echo json_encode(["error" => $th->getMessage()]);
    }
}
