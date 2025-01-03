<?php
require_once "../../helpers/validateInput.php";
require_once "../../classes/Category.php";

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $data = json_decode(file_get_contents("php://input"), true);

        // Validate input
        $name = validateInput($data["categoryName"]);
        $id = validateInput($data["id"]);
        if (empty($name) || empty($id)) {
            http_response_code(400); // Bad Request
            echo json_encode(['error' => 'Name or ID is required']);
            exit();
        }

        $newCat = new Category($name);
        $newCat->setVar("id",$id);
        // Check if category exists
        if (!$newCat->checkExistById()) {
            http_response_code(404); // Not Found
            echo json_encode(['error' => 'Category does not exist']);
            exit();
        }

        if (!$newCat->update()) {
            http_response_code(500);
            echo json_encode(['error' => 'Something went wrong while updating the category']);
            exit();
        }

        http_response_code(200); // OK
        echo json_encode(['success' => 'Category updated successfully!']);
    } catch (\Throwable $th) {
        http_response_code(500);
        echo json_encode(['error' => $th->getMessage()]);
    }
}
