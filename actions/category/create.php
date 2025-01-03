<?php
    require_once "../../helpers/validateInput.php";
    require_once "../../classes/Category.php";

    header("Content-Type: application/json");
    if($_SERVER["REQUEST_METHOD"] === "POST"){

        try {
            $data = json_decode(file_get_contents("php://input"),true);
            $name = validateInput($data["categoryName"]) ?? '';
            if(empty($name)){
               echo json_encode(['error' =>  'Name field is required']);
               exit();
            }
            $newCat = new Category($name);
            if($newCat->checkExist()){
                echo json_encode(['error' =>  'this category is already exist']);
                exit();
            }
            if(!$newCat->save()){
                echo json_encode(['error' =>  'Somthing went wrong']);
            }
            echo json_encode(['success' =>  'Category created successfully!']);
        } catch (\Throwable $th) {
            echo json_encode(['error' =>  'internal server error']);
        }
        
    }
?>