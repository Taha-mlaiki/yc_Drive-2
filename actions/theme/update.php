<?php
require_once "../../helpers/validateInput.php";
require_once "../../classes/Theme.php";

header("Content-Type: application/json");
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    try {
        $data = json_decode(file_get_contents("php://input"), true);

        $id = (int) validateInput($data["id"]) ?? '';
        $title = validateInput($data["title"]) ?? '';
        $image = validateInput($data["image"]) ?? '';
        $description = validateInput($data["description"]) ?? '';

        if (empty($id)) {
            echo json_encode(['error' => 'id field is required']);
            exit();
        }
        if (empty($title)) {
            echo json_encode(['error' => 'Title field is required']);
            exit();
        }
        if (empty($image)) {
            echo json_encode(['error' => 'imge url is required and must be a valid url.']);
            exit();
        }

        if (empty($description)) {
            echo json_encode(['error' => 'Description field is required']);
            exit();
        }

        $newTheme = new Theme($image, $title, $description);
        if ($newTheme->updateTheme($id)) {
            echo json_encode(['success' => 'Theme updated successfully']);
            exit();
        }
        echo json_encode(['error' => 'Somthing went wrong']);
    } catch (\Throwable $th) {
        echo json_encode(['error' =>  $th->getMessage()]);
    }
}
