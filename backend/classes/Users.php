<?php

class Users
{
    protected $db;

    public function __construct() {
        $this->db = Database::instance();
    }

    public function emailExist($email) {
        $stmt = $this->db->prepare("SELECT * FROM `users` WHERE `email` = :email");
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function hash($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function isLogged()
    {
        return ((isset($_SESSION['user_id'])) ? true : false);
    }
}