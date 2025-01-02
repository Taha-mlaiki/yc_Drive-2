<?php
require_once "../classes/User.php";
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the JSON input
    $data = json_decode(file_get_contents('php://input'), true);

    $username = $data['username'] ?? '';
    $email = $data['email'] ?? '';
    $password = $data['password'] ?? '';

    // Validate on server-side as well
    if (empty($username) || empty($email) || empty($password)) {
        echo json_encode(['error' =>  'All fields are required.']);
        exit;
    }
    if(User::checkExist($email)){
        http_response_code(400);
        echo json_encode(['error' => 'User already exist.']);
        exit();
    }
    try {
        $passwordHash = password_hash($password,PASSWORD_DEFAULT);
        $newUser = new User($username,$email,$passwordHash);
        if($newUser->signup()){
            echo json_encode(["success" => "You signed up successfully"]);
        }else {
            echo json_encode(["error" =>  "Something Went wrong"]);
        }
    } catch (\Throwable $th) {
        echo json_encode(["error" => $th]);
    }
} else {
    echo json_encode(['error' => 'Invalid request.']);
}
