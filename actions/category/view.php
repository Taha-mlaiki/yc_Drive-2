<?php
require_once "../../classes/Category.php";

header("Content-Type: application/json");
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $data = Category::getAll();
    echo json_encode(["categories" => $data]);
}
