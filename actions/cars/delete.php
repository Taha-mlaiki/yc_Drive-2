<?php
require_once "../../classes/Car.php";
require_once "../../helpers/validateInput.php";

header("Content-Type: application/json");
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"),true);
    $id = validateInput($data["id"]);
    if(empty($id)){
        echo json_encode(["error" => "Invalid id"]);
    }
    $res = Car::deleteOne($id);
    if($res){
        echo json_encode(["success" => "Car deleted!"]);
    }else {
        echo json_encode(["error" => "Somthing went wrong,refresh the page and try again!"]);
    }
}
