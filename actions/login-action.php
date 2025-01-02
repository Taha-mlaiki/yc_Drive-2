<?php
require_once "../classes/User.php";
require_once "../helpers/validateInput.php";


header("Content-Type: application/json");

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $data = json_decode(file_get_contents("php://input"),true);

    $email = validateInput($data['email'])  ?? '';
    $password =  validateInput($data['password'])?? '';

    if (empty($email) || empty($password)) {
        echo json_encode(['error' =>  'All fields are required.']);
        exit;
    }
    try {
        User::login($email,$password);
        echo json_encode(["success" => "Login successfully!"]);
    } catch (\Throwable $th) {
        echo json_encode(["success" => $th]);
    }
}