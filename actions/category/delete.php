<?php
require_once "../../classes/Category.php";
require_once "../../helpers/validateInput.php";

header("Content-Type: application/json");
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"),true);
    $id = validateInput($data["id"]);
    if(empty($id)){
        echo json_encode(["error" => "Invalid id"]);
    }
    $res = Category::deleteOne($id);
    if($res){
        echo json_encode(["success" => "Category deleted!"]);
    }else {
        echo json_encode(["error" => "Somthing went wrong,refresh the page and try again!"]);
    }
}
