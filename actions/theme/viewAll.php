<?php
require_once "../../classes/Theme.php";

header("Content-Type: application/json");
if ($_SERVER["REQUEST_METHOD"] === "GET") {

    try {
        $data = Theme::getAllThemes();
        echo json_encode(["themes" => $data]);
    } catch (\Throwable $th) {
        echo json_encode(["error" => $th->getMessage()]);
    }
}
