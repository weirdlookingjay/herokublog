<?php

class Dashboard
{
    protected $db;
    protected $user;

    public function __construct() {
        $this->db = Database::instance();
        $this->user = new Users;
    }

    public function blogAuth($blogID) {
        $user_id = $this->user->ID();
        $stmt = $this->db->prepare("SELECT * FROM `blogs` `B`, `blogsauth` `A`
                                             LEFT JOIN `users` `U` ON `A`.`userID` = `U`.`userID`
                                             WHERE `B`.`blogID` = `A`.`blogID` AND `B`.`blogID` = :blogID
                                             AND `U`.`userID` = :userID");
        $stmt->bindParam(":blogID", $blogID, PDO::PARAM_INT);
        $stmt->bindParam(":userID", $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}