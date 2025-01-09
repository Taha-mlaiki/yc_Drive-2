<?php
require_once "../../helpers/validateInput.php";
require_once "../../classes/Theme.php";

header("Content-Type: application/json");
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    try {
        $data = json_decode(file_get_contents("php://input"), true);

        $id = (int) validateInput($data["id"]) ?? '';

        if (empty($id)) {
            echo json_encode(['error' => 'Id is required']);
            exit();
        }

        if(Theme::deleteTheme($id)){
            echo json_encode(['success' => 'Theme deleted successfully']);
            exit();
        };
        echo json_encode(['error' => 'Somthing went wrong']);
    } catch (\Throwable $th) {
        echo json_encode(['error' =>  $th->getMessage()]);
    }
}
