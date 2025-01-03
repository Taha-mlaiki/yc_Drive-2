<?php

    require_once("../classes/Database.php"); 
class User
{
    private $id;
    private $username;
    private $email;
    private $password;
    private $role;
    public function __construct($username, $email, $password)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }
    public function getVar($varname)
    {
        $this->$varname = $varname;
    }
    static private function getDb()
    {
        $db = Database::getInstance();
        $db = $db->getConnection();
        return $db;
    }
    static function checkExist($email)
    {
        $db = self::getDb();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function signup()
    {
        $db = self::getDb();
        $stmt = $db->prepare("INSERT INTO users (username,email,password) VALUES (:username,:email,:password)");
        $stmt->bindParam(":username", $this->username, PDO::PARAM_STR);
        $stmt->bindParam(":email", $this->email, PDO::PARAM_STR);
        $stmt->bindParam(":password", $this->password, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    static public function login($email, $password)
    {
        $db = self::getDb();
        $stmt = $db->prepare("SELECT u.* , role.name AS role_name FROM users u JOIN role ON role.id = u.role_id WHERE u.email = :email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        if ($stmt->rowCount() === 0) {
            throw new Error("Email or password invalid", 404);
            exit();
        }
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        if (!password_verify($password, $res->password)) {
            throw new Error("Email or password invalid", 404);
            exit();
        }
        session_start();
        $_SESSION["id"] = $res->id;
        $_SESSION["username"] = $res->username;
        $_SESSION["email"] = $res->email;
        $_SESSION["role"] = $res->role_name;
    }
}
